<template>
    <div>
        <div class="p-4 flex items-center">
            <div class="flex flex-col gap-y-2">
                <div class="flex items-center">
                    <p class="w-32">Begin Datum: </p>
                    <input type="date" v-model="startDate"
                        class="py-2 px-3 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition">
                </div>
                <div class="flex items-center">
                    <p class="w-32">Eind Datum: </p>
                    <input type="date" v-model="endDate"
                        class="py-2 px-3 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition">
                </div>
            </div>
            <button @click="fetchSalesData"
                class="ml-4 w-56 py-6 inline-flex items-center justify-center gap-x-2 text-xl font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">
                Maak overzicht
            </button>
        </div>

        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-4 shadow-lg w-96">
                <div class="flex justify-end items-center pt-2 px-2">
                    <button @click="closeModal"  class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-200 text-gray-800 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none transition">
                        <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                    </button>
                </div>
                <div class="px-4 pb-8 overflow-y-auto">
                    <p>Begindatum of einddatum niet ingevuld!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            startDate: '',
            endDate: '',
            showModal: false,
        };
    },
    methods: {
        fetchSalesData() {
            if (!this.startDate || !this.endDate) {
                this.showModal = true;l
            } else {
                this.showModal = false; 
                this.$emit('fetch-sales-data', { startDate: this.startDate, endDate: this.endDate });
            }
        },
        closeModal() {
            this.showModal = false;
        }
    }
}
</script>
