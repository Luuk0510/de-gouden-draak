<template>
    <div class="m-2">
        <div class="flex">
            <div class="bg-white border-2 border-blue-500 rounded-2xl shadow-xl m-2">
                <DatePicker @fetch-sales-data="handleFetchSalesData"/>
            </div>
            <div class="bg-white border-2 border-blue-500 rounded-2xl shadow-xl m-2 w-full">
                <SaleTotal :sales-data="salesData"/>
            </div>
        </div>
        <div class="bg-white border-2 border-blue-500 overflow-auto h-[calc(100vh-400px)] rounded-2xl shadow-xl m-2">
            <SaleItem :sales-data="salesData"/>
        </div>  
    </div>
</template>

<script>
import DatePicker from './DatePicker.vue';
import SaleItem from './SaleItem.vue';
import SaleTotal from './SaleTotal.vue';

export default {
    components: {
        DatePicker,
        SaleTotal,
        SaleItem,
    },
    data() {
        return {
            salesData: []
        };
    },
    methods: {
        async handleFetchSalesData(dates) {
            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement.getAttribute('content');

            try {
                const response = await fetch('/api/sales', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(dates)
                });

                if (response.ok) {
                    const data = await response.json();
                    this.salesData = data;
                } else {
                    console.error('Server responded with an error:', response.statusText);
                }
            } catch (error) {
                console.error('Error fetching sales data:', error);
            }
        }
    }
}
</script>
