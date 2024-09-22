<template>
    <div class="p-4 w-full flex justify-around text-3xl">
        <div><strong>Omzet:</strong> € {{ formatPrice(total) }}</div>
        <div><strong>BTW:</strong> € {{ formatPrice(btw) }}</div>
        <div><strong>Excl. BTW:</strong> € {{ formatPrice(exclBtw) }}</div>
    </div>
</template>

<script>
export default {
    props: {
        salesData: Array
    },
    computed: {
        total() {
            return this.salesData.reduce((sum, item) => sum + item.totaal, 0);
        },
        btw() {
            const btwPercentage = 0.21;
            return this.total * btwPercentage;
        },
        exclBtw() {
            return this.total - this.btw;
        }
    },
    methods: {
        formatPrice(value) {
            let number = parseFloat(value).toFixed(2);
            return number.replace('.', ',');
        }
    }
}
</script>
