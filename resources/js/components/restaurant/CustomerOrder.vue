<template>
    <div class="m-2">
        <div class="flex">
            <div class="w-3/5 border-4 overflow-auto h-[calc(100vh-100px)] rounded-2xl m-2 relative shadow-lg bg-white">
                <div v-for="categorie in dishes" :key="categorie.id" class="px-4">
                    <h2 class="text-2xl font-bold mt-2 text-center">{{ categorie.naam }}</h2>
                    <table class="w-full">
                        <tbody>
                            <DishItem v-for="gerecht in categorie.gerechten" 
                                :key="gerecht.id" 
                                :item="gerecht" 
                                :buttonClasses="'py-2 px-2 inline-flex items-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition'" 
                                @add-to-order="addToOrder" />

                        </tbody>
                    </table>
                    <hr class="border-2 rounded-full mt-2">
                </div>
            </div>

            <div class="flex flex-col w-2/5 m-2">
                <div class="px-4">
                    <div class="overflow-auto mb-4 h-[calc(100vh-225px)] border-4 rounded-2xl shadow-lg bg-white">
                        <Order 
                            :order-items="orderItems" 
                            :total-price="totalPrice" 
                            :current-round="currentRound"
                            @update-total="handleTotalUpdate"
                            @clear-order="clearOrder" 
                            @calculate-total="calculateTotal" 
                            @checkout="checkout">
                            <div v-if="isWaiting" class="text-center mt-4">
                                <p class="font-bold">
                                    Wacht {{ minutes }}:{{ seconds }} minuten voordat je de volgende ronde kunt starten.
                                </p>
                            </div>
                            <div v-else-if="currentRound >= maxRounds" class="text-center mt-4">
                                <p class="text-green-500 font-bold">Je hebt alle rondes voltooid!</p>
                            </div>
                            <div class="text-center p-3 font-bold border-b-2 rounded-t-lg">
                                <h2 class="text-lg">Huidige Ronde: {{ currentRound }} van {{ maxRounds }} | Tafel nummer:{{ table }}</h2>
                            </div>
                        </Order>

                    </div>
                    <div class="border-4 rounded-2xl shadow-lg p-2 bg-white">
                        <OrderSummary 
                            :totalPrice="totalPrice" 
                            :checkoutRoute="'/restaurant/order/registerRound'" 
                            :clearButtonClasses="'py-2 px-4 inline-flex items-center gap-x-2 text-lg font-bold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:bg-red-600 transition'"
                            :checkoutButtonClasses="'py-2 px-4 inline-flex items-center gap-x-2 text-white text-lg font-bold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none transition'"
                            :defaultModalMessage="'Bestelling succusvol doorgegeven'"
                            :orderItems="orderItems"
                            :isWaiting="isWaiting"
                            :buttonText="'Plaats Bestelling'"
                            :useOverlay="false"
                            @clear-order="clearOrder" 
                            @update-round-and-timer="handleRoundAndTimerUpdate"
                            @checkout="checkout" />
                    </div>
                </div>  

            </div>
        </div>
    </div>
</template>

<script>
import DishItem from '../DishItem.vue';
import Order from '../Order.vue';
import OrderSummary from '../OrderSummary.vue';
export default {
    props: {
        dishes: Array,
        table: String,
        currentRound: {
            type: Number,
            required: true
        },
        roundStartTime: {
            type: String,
            required: true
        }
    },
    components: {
        DishItem,
        Order,
        OrderSummary
    },
    data() {
        return {
            orderItems: [],
            totalPrice: 0.00,
            currentRound: this.currentRound,
            maxRounds: 5,
            isWaiting: false,
            timer: null,
            waitingTime: 600,
            roundStartTime: new Date(this.roundStartTime),
            minutes: 0,
            seconds: 0
        };
    },
    methods: {
        startTimer() {
            if (this.waitingTime > 0) {
                this.isWaiting = true;
            
                if (this.timer) {
                    clearInterval(this.timer);
                }
            
                this.timer = setInterval(() => {
                    if (this.waitingTime > 0) {
                        this.waitingTime -= 1;
                        this.updateTimerDisplay();
                    } else {
                        this.isWaiting = false;
                        clearInterval(this.timer);
                    }
                }, 1000);
            }
        },
        handleRoundAndTimerUpdate({ currentRound, roundStartTime }) {
            this.currentRound = currentRound;
            this.roundStartTime = roundStartTime;
            this.waitingTime = 600;
            this.startTimer();
        },
        updateTimerDisplay() {
            this.minutes = Math.floor(this.waitingTime / 60);
            this.seconds = Math.floor(this.waitingTime % 60).toString().padStart(2, '0');
        },
        addToOrder(dish) {
            const existingItem = this.orderItems.find(item => item.id === dish.id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                this.orderItems.push({ ...dish, quantity: 1 });
            }
            this.calculateTotal();
        },
        clearOrder() {
            this.orderItems = [];
            this.totalPrice = '0.00';
        },
        handleTotalUpdate(newTotal) {
            this.totalPrice = newTotal; 
        },
        checkout() {
        this.clearOrder();
        this.currentRound += 1;
        this.waitingTime = 600;
        this.startTimer();
        },
        calculateTotal() {
            const total = this.orderItems.reduce((sum, item) => {
                return sum + (parseFloat(item.prijs) * item.quantity);
            }, 0);
            this.totalPrice = total.toFixed(2);
        }
    },
    mounted() {
        const roundStartTime = new Date(this.roundStartTime);

        if (!isNaN(roundStartTime.getTime())) {
            if (this.currentRound === 1) {
                this.isWaiting = false; 
            } else {
                const now = new Date();
                const elapsedMilliseconds = now - roundStartTime;
                const elapsedSeconds = Math.floor(elapsedMilliseconds / 1000);

                if (elapsedSeconds < 600) {
                    this.isWaiting = true;
                    this.waitingTime = 600 - elapsedSeconds; 
                    this.startTimer();
                } else {
                    this.isWaiting = false;
                }
            }

            console.log('isWaiting:', this.isWaiting);

            const minutes = roundStartTime.getMinutes();
            const seconds = roundStartTime.getSeconds();
            const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            console.log('Formatted time (for display):', formattedTime);
        } else {
            console.error('Invalid date:', roundStartTime);
        }
    },
    beforeDestroy() {
        if (this.timer) {
            clearInterval(this.timer);
        }
    }
};
</script>