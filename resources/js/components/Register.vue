<template>
    <div class="m-2 ">
        <div class="flex">
            <!-- Gerechten -->
            <div class="w-3/5 border-2 border-blue-500 overflow-auto h-[calc(100vh-200px)] rounded-2xl m-2 shadow-xl bg-white">
                <!-- Zoekfunctie en filter -->
                <div class="sticky top-0 z-10 bg-white flex items-center justify-between py-2 px-4 border-b">
                    <select v-model="selectedCategory" class="py-3 px-4 block w-72 bg-white border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 transition">
                        <option value="">Alle categorieën</option>
                        <option v-for="categorie in dishes" :key="categorie.id" :value="categorie.naam">
                            {{ categorie.naam }}
                        </option>
                    </select>
                    <div class="w-72">
                        <input type="text" v-model="searchQuery" class="peer py-3 px-4 block w-full bg-gray-50 border-gray-300 rounded-2xl focus:border-blue-500 focus:ring-blue-500 transition" placeholder="Zoek op gerecht naam of nummer">
                    </div>
                </div>

                <!-- Gerechten tabel -->
                <div v-for="categorie in filteredDishes" :key="categorie.id" class="px-4">
                    <h2 class="text-2xl font-bold mt-2 text-center">{{ categorie.naam }}</h2>
                    <table class="w-full bg-white">
                        <tbody>
                            <DishItem v-for="gerecht in categorie.gerechten" :key="gerecht.id" :item="gerecht" @add-to-order="addToOrder" />
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order en OrderSummary -->
            <div class="flex flex-col w-2/5 m-2">
                <div class="px-4">
                    <div class="overflow-auto mb-4 h-[calc(100vh-322px)] bg-white border-2 border-blue-500 rounded-2xl shadow-xl">
                        <Order :order-items="orderItems" @clear-order="clearOrder" @update-total="handleTotalUpdate" />
                    </div>
                </div>

                <div class="px-4">
                    <div class="py-3 border-2 bg-white border-blue-500 rounded-2xl shadow-xl z-50">
                        <OrderSummary :totalPrice="totalPrice" :orderItems="orderItems" @clear-order="clearOrder" @checkout="checkout" :checkoutRoute="'/register'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DishItem from './DishItem.vue';
import Order from './Order.vue';
import OrderSummary from './OrderSummary.vue';

export default {
    props: {
        dishes: Array
    },
    components: {
        DishItem,
        Order,
        OrderSummary
    },
    data() {
        return {
            orderItems: [],
            totalPrice: 0,
            searchQuery: '', 
            selectedCategory: ''
        };
    },
    computed: {
        filteredDishes() {
            let filteredDishes = this.dishes;

            if (this.selectedCategory) {
                filteredDishes = filteredDishes.filter(categorie => categorie.naam === this.selectedCategory);
            }

            if (this.searchQuery) {
                const searchQueryLower = this.searchQuery.toLowerCase();
                filteredDishes = filteredDishes.map(categorie => {
                    const filteredGerechten = categorie.gerechten.filter(gerecht =>
                        gerecht.naam.toLowerCase().includes(searchQueryLower) || 
                        gerecht.nummer && gerecht.nummer.toString().includes(searchQueryLower)
                    );

                    if (filteredGerechten.length) {
                        return {
                            ...categorie,
                            gerechten: filteredGerechten
                        };
                    }

                    return null;
                }).filter(categorie => categorie !== null);
            }

            return filteredDishes;
        }
    },
    methods: {
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
            this.calculateTotal();
        },
        handleTotalUpdate(newTotal) {
            this.totalPrice = newTotal;
        },
        calculateTotal() {
            const total = this.orderItems.reduce((total, item) => {
                return total + (parseFloat(item.prijs) * item.quantity);
            }, 0);
            this.totalPrice = total.toFixed(2);
        }
    }
};
</script>
