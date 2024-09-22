<template>
    <div class="py-2 flex justify-center">
        <table class="table-auto align-middle">
            <thead>
                <tr class="border-b-2 border-blue-500">
                    <th class="px-2 text-center">Datum</th>
                    <th class="px-2 w-[30rem] text-center border-x-2 border-blue-500">Gerechten</th>
                    <th class="px-2 text-center border-x-2 border-blue-500">Prijs</th>
                    <th class="px-2 text-center border-x-2 border-blue-500">Aantal</th>
                    <th class="px-2 text-center">Subtotaal</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in salesData" :key="item.datum">
                    <td class="px-1 text-center align-top">
                        <div v-for="gerecht in item.gerechten" :key="gerecht.naam">
                            {{ item.datum }}
                        </div>
                    </td>
                    <td class="text-left align-top">
                        <div v-for="gerecht in item.gerechten" :key="gerecht.naam">
                            {{ gerecht.naam }}
                        </div>
                    </td>
                    <td class="text-center align-top">
                        <div v-for="gerecht in item.gerechten" :key="gerecht.naam">
                            € {{ formatPrice(gerecht.prijs) }}
                        </div>
                    </td>
                    <td class="text-center align-top">
                        <div v-for="gerecht in item.gerechten" :key="gerecht.naam">
                            {{ gerecht.aantal }}
                        </div>
                    </td>
                    <td class="text-center align-top">
                        <div v-for="gerecht in item.gerechten" :key="gerecht.naam">
                            € {{ formatPrice(gerecht.subtotaal) }}
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
        salesData: Array
    },
    methods: {
        formatPrice(value) {
            let number = parseFloat(value).toFixed(2);
            return number.replace('.', ',');
        }
    }
}
</script>
