<template>
  <div>
    <div class="mb-4">
      <input type="number" v-model="numPersons" min="0" class="py-2 px-4 border border-gray-300 rounded-lg w-20" />
    </div>

    <div v-if="numPersons > 0">
      <div class="mb-6">
        <div v-for="i in numPersons" :key="i" class="mb-4">
          <label :for="'birthday_' + i" class="block text-sm font-medium mb-2">
            Geboortedatum
          </label>
          <input type="date" :id="'birthday_' + (i)" :name="'birthday[' + (i) + ']'"
            class="py-2 px-4 block w-full border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 transition" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      numPersons: 0
    };
  }
};
</script>


<style scoped></style>