<template>
    <div>
        <p class="text-xl font-bold text-center">Totaal: &euro;{{ totalPrice }}</p>
        <div class="flex justify-center m-2">
            <!-- Verwijderen button -->
            <button @click="$emit('clear-order')" :class="clearButtonClasses" class="py-1 px-4 inline-flex items-center gap-x-2 font-bold rounded-lg shadow-sm disabled:opacity-50 disabled:pointer-events-none mr-2">
                Verwijderen
            </button>

            <!-- Afrekenen button -->
            <button @click="checkout" 
                    :class="checkoutButtonClasses" 
                    :disabled="isWaiting" 
                    aria-haspopup="dialog" 
                    aria-expanded="false" 
                    aria-controls="hs-scale-animation-modal" 
                    v-bind="useOverlay ? {'data-hs-overlay': '#hs-scale-animation-modal'} : {}">
                {{ buttonText }}
            </button>
        </div>

        <!-- Modal -->
        <div id="hs-scale-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
            <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-end items-center pt-2 px-2">
                        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                          </svg>
                        </button>
                    </div>
                    <div class="px-4 pb-8 overflow-y-auto">
                        <p>{{ modalMessage }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        totalPrice: Number,
        checkoutRoute: {
            type: String,
            required: true
        },
        clearButtonClasses: {
            type: String,
            default: 'border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50'
        },
        checkoutButtonClasses: {
            type: String,
            default: 'py-1 px-4 inline-flex items-center gap-x-2 font-bold rounded-lg shadow-sm border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50'
        },
        defaultModalMessage: {
            type: String,
            default: 'Verkoop succesvol!'
        },
        buttonText: { 
            type: String,
            default: 'Afrekenen'
        },
        orderItems: Array,
        isWaiting: Boolean,
        useOverlay: {
            type: Boolean,
            default: true
        },
    },
    data() {
        return {
            modalMessage: '',
            isLoading: false
        };
    },
    methods: {
        async checkout() {
            if (this.orderItems.length === 0) {
                this.modalMessage = "Geen gerechten geselecteerd";
                return;
            }

            this.isLoading = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(this.checkoutRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ orderItems: this.orderItems })
                });

                if (response.ok) {
                    const contentType = response.headers.get("content-type");

                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        const data = await response.json();
                        this.modalMessage = 'Bestelling succesvol!';
                        this.$emit('clear-order');
                        if (this.checkoutRoute == '/restaurant/order/registerRound') {
                            this.$emit('update-round-and-timer', {
                                currentRound: data.current_round,
                                roundStartTime: new Date(data.round_start_time)
                            });
                        }
                } else {
                    const textResponse = await response.text();
                    console.log('Non-JSON response received:', textResponse);
                    this.modalMessage = 'Ronde voltooid! De bestelling is afgerond.';
                    window.location.href = response.url;
                }
            } else {
                    this.modalMessage = 'Er is iets misgegaan, probeer opnieuw.';
                }
            } catch (error) {
                console.error('Error:', error);
                this.modalMessage = 'Er is een fout opgetreden, probeer het opnieuw.';
            }

            this.isLoading = false;
        }
    }
};
</script>
