import "preline/preline";
import { createApp } from 'vue';
import Register from './components/Register.vue';
import LanguageDropdown from './components/LanguageDropdown.vue';
import DishItem from './components/DishItem.vue';
import Order from './components/Order.vue';
import Sales from './components/sales/SalesOverview.vue';
import PersonForm from "./components/restaurant/PersonForm.vue";
import CustomerOrderComponent from "./components/restaurant/CustomerOrder.vue";

const RegisterElement = document.getElementById('register');
const SalesElement = document.getElementById('sales');
const languageDropdownElement = document.getElementById('language-dropdown');
const RegisterCustomer = document.getElementById('registerCustomer');
const CustomerOrderElement = document.getElementById('customer-order');

const planningElement = document.getElementById('planning-form');

if (RegisterElement) {
    const dishes = JSON.parse(RegisterElement.dataset.dishes);

    const app = createApp(Register, {
        dishes: dishes
    });

    app.component('DishItem', DishItem);
    app.component('Order', Order);

    app.mount('#register');
}

if (SalesElement) {
    const app = createApp(Sales, {});
    app.mount('#sales');
}

if (languageDropdownElement) {
    const languageApp = createApp({
        components: {
            'language-dropdown': LanguageDropdown
        }
    });

    languageApp.mount('#language-dropdown');
}

if (RegisterCustomer) {
    const app = createApp({
        components: {
            'person-form': PersonForm
        }
    });

    app.mount('#registerCustomer');
}


if (CustomerOrderElement) {
    const dishes = JSON.parse(CustomerOrderElement.dataset.dishes);
    const currentRound = JSON.parse(CustomerOrderElement.dataset.round);
    const roundStartTime = JSON.parse(CustomerOrderElement.dataset.roundStartTime)
    const table = JSON.parse(CustomerOrderElement.dataset.table);

    const app = createApp(CustomerOrderComponent, {
        dishes: dishes,
        currentRound: currentRound,
        roundStartTime: roundStartTime,
        table: table,
    });

    app.mount('#customer-order');

}
