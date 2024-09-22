<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GoodPay Kassa</title>
    @vite('resources/css/register.css')
    @vite('resources/js/app.js')
</head>

<body class="m-2">
    <header class="mb-20">
        <div class="flex items-center h-20">
            <div class="flex-shrink-0">
                <img src="/images/goodpay.png" class="h-20" alt="goodpay logo">
            </div>
        </div>
        <hr class="mt-1 border-blue-500 border-2 rounded">
    </header>
    <main>
        <div class="flex justify-center items-center">
            <form action="{{ route('login') }}" method="POST" class="w-80 p-8 border border-gray-800 rounded-3xl">
                @csrf
                <div class="mb-2">
                    <x-register.input 
                        label="Medewerker Nummer" 
                        type="number" 
                        id="gebruikersnaam" 
                        name="gebruikersnaam"
                        placeholder="gebruikersnaam" 
                        value="{{ old('username') }}" />
                </div>
                <div class="mb-2">
                    <x-register.input 
                        label="Wachtwoord" 
                        type="text" 
                        id="wachtwoord" 
                        name="wachtwoord"
                        placeholder="Wachtwoord" 
                        value="{{ old('username') }}" />
                </div>
                <div class="flex justify-center items-center">
                    <input 
                        type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition"
                        value="Inloggen">
                </div>
            </form>
            @if (session('login_error'))
                <div class="errorMessage">{{ session('login_error') }}</div>
            @endif
        </div>
    </main>
</body>

</html>
