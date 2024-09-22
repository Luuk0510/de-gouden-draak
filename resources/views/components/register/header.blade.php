<header>
<div class="flex items-center h-20">
    <div class="flex-shrink-0">
        <img src="/images/goodpay.png" class="h-20" alt="goodpay logo">
    </div>

    <div class="flex-grow flex justify-center space-x-4">
        <x-header-button routeName="register-index" buttonName="register.register"/>
        <x-header-button routeName="register-dishes" buttonName="register.dishes"/>
        <x-header-button routeName="register-sales" buttonName="register.sales"/>
    </div>

    <div class="flex-shrink-0">
        <x-header-button routeName="logout" buttonName="register.log_out"/>
    </div>
</div>
<hr class="mt-1 border-blue-500 border-2 rounded">
</header>