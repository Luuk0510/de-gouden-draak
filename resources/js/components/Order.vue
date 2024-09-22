<template>
    <div class="bg-white">
        <slot></slot>
        <h2 class="text-2xl font-bold text-center">Bestelling</h2>
        <table class="w-full bg-white">
            <tbody>
                <tr v-for="item in orderItems" :key="item.id">
                    <td class="px-4 py-1">
                        <!-- Gerecht -->
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <span>{{ item.nummer }}. {{ item.naam }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span>&euro;{{ (item.prijs * item.quantity).toFixed(2) }}</span>
                                <div class="flex items-center gap-x-1.5">
                                    <button type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50"
                                        @click="decrementQuantity(item)" tabindex="-1" aria-label="Decrease">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                        </svg>
                                    </button>
                                    <input class="p-0 w-6 bg-transparent border-0 text-center focus:ring-0"
                                        style="-moz-appearance: textfield;" type="number"
                                        v-model.number="item.quantity" @change="updateQuantity(item)"
                                        aria-roledescription="Number field" min="0" />
                                    <button type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50"
                                        @click="incrementQuantity(item)" tabindex="-1" aria-label="Increase">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Opmerking -->
                        <div class="mt-2">
                            <select v-model="item.selectedOpmerking"
                                class="border border-gray-300 rounded-lg w-full text-sm">
                                <option v-for="opmerking in (item.eerdereOpmerkingen || [])" :key="opmerking"
                                    :value="opmerking">
                                    {{ opmerking }}
                                </option>
                                <option value="new">Nieuwe opmerking toevoegen</option>
                            </select>

                            <div v-if="item.selectedOpmerking === 'new'" class="mt-2">
                                <input v-model="item.newOpmerking"
                                    class="border border-gray-300 rounded-lg w-full text-sm"
                                    placeholder="Nieuwe opmerking">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
export default {
    props: {
        orderItems: Array
    },
    mounted() {
        this.orderItems.forEach(this.processItemOpmerkingen);
    },
    methods: {
        processItemOpmerkingen(item) {
            if (!item.eerdereOpmerkingen || !Array.isArray(item.eerdereOpmerkingen)) {
                const opmerkingFrequentie = item.opmerkingen?.reduce((acc, opmerking) => {
                    acc[opmerking.opmerkingen] = (acc[opmerking.opmerkingen] || 0) + 1;
                    return acc;
                }, {}) || {};

                item.eerdereOpmerkingen = Object.keys(opmerkingFrequentie).sort((a, b) => opmerkingFrequentie[b] - opmerkingFrequentie[a]);
                if (!item.eerdereOpmerkingen.includes('Geen opmerking')) {
                    item.eerdereOpmerkingen.unshift('Geen opmerking');
                }
            }

            if (!item.selectedOpmerking) {
                item.selectedOpmerking = 'Geen opmerking';
            }
        },
        updateQuantity(item) {
            if (item.quantity < 1) this.removeItem(item);
            this.calculateTotal();
        },
        incrementQuantity(item) {
            item.quantity++;
            this.calculateTotal();
        },
        decrementQuantity(item) {
            item.quantity--;
            this.updateQuantity(item);
        },
        calculateTotal() {
            const total = this.orderItems.reduce((sum, item) => sum + (parseFloat(item.prijs) * item.quantity), 0);
            this.$emit('update-total', total.toFixed(2));
        },
        removeItem(item) {
            const index = this.orderItems.indexOf(item);
            if (index > -1) this.orderItems.splice(index, 1);
            this.calculateTotal();
        }
    },
    watch: {
        orderItems: {
            handler(newValue) {
                newValue.forEach(item => {
                    if (!item.eerdereOpmerkingen || !Array.isArray(item.eerdereOpmerkingen) || !item.selectedOpmerking) {
                        this.processItemOpmerkingen(item);
                    }
                });
            },
            immediate: true,
            deep: true
        }
    }
};

</script>
