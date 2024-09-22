<template>
    <tr>
        <td class="px-4 py-2">{{ item.nummer }}.</td>
        <td class="px-4 py-2">
            {{ item.naam }}
            <span v-if="item.beschrijving">(<i>{{ item.beschrijving }}</i>)</span>
        </td>
        <td class="px-4 py-2 text-right">
            <div class="flex items-center justify-end space-x-2">
                <span>&euro;{{ item.prijs }}</span>
                <button @click="addToOrder" :class="buttonClasses" class="ml-4 py-1 px-3 inline-flex items-center gap-x-2 font-bold rounded-lg shadow-sm">
                    Toevoegen
                </button>
            </div>
        </td>
    </tr>

</template>

<script>
export default {
    props: {
        item: Object,
        buttonClasses: {
            type: String,
            default: 'border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50'
        }
    },
    methods: {
        addToOrder() {
            this.$emit('add-to-order', this.item);
        }
    }
};
</script>
