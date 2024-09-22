<template>
    <div class="relative inline-block text-left">
        <div>
            <button @click="toggleDropdown" type="button" class="inline-flex justify-center rounded-md border border-gray-400 shadow-sm px-2 py-2 bg-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                <img :src="currentFlag" alt="Language" class="h-6">
            </button>
        </div>
        <div v-if="isOpen" class="origin-top-right absolute right-0 mt-1 rounded-md shadow-lg bg-gray-200 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a @click.prevent="setLocale('en')" href="#" class="block px-2 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem">
                    <img src="/images/flags/en.png" alt="English" class="h-6 inline">
                </a>
                <a @click.prevent="setLocale('nl')" href="#" class="block px-2 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem">
                    <img src="/images/flags/nl.png" alt="Nederlands" class="h-6 inline">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            isOpen: false,
        };
    },
    computed: {
        currentFlag() {
            return `/images/flags/${document.documentElement.lang}.png`;
        },
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        setLocale(locale) {
            console.log(`Setting locale to: ${locale}`);
            axios.get(`/setlocale/${locale}`)
                .then(response => {
                    console.log('Locale set response:', response);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error setting locale:', error);
                });
        },
    },
};
</script>

<style scoped>
/* Optional styling */
</style>
