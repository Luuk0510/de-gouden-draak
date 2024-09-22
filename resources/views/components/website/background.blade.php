<div class="background-container">
    <table id="main_table" class="w-full border-collapse p-1.25">
        <tr class="h-12.5 bg-customRed">
            <td class="text-center w-3/10 text-yellow text-3xl font-chinese">
                <img src="/images/dragon-small.png" alt="Golden Dragon" class="inline h-12.5 align-middle">
                <span>{{ __('website.golden_dragon') }}</span>
                <img src="/images/dragon-small-flipped.png" alt="Golden Dragon" class="inline h-12.5 align-middle">
            </td>
            <td>
                <a href="paginas/aanbiedingen.html" class="text-yellow font-bold no-underline">
                    <div class="scrolling-container">
                        <div class="scrolling-text">
                            {{ __('website.welcome_message') }}
                        </div>
                    </div>
                </a>
            </td>
            <td class="text-center w-3/10 text-yellow text-3xl font-chinese">
                <img src="/images/dragon-small.png" alt="Golden Dragon" class="inline h-12.5 align-middle">
                <span>{{ __('website.golden_dragon') }}</span>
                <img src="/images/dragon-small-flipped.png" alt="Golden Dragon" class="inline h-12.5 align-middle">
            </td>
            <td id="language-dropdown">
                <language-dropdown></language-dropdown>
            </td>
        </tr>
    </table>
    <table id="main_table" class="w-full border-collapse p-1.25">
        <tr class="h-1.75 bg-customRed">
            <td colspan="9"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-l-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-b-4 border-yellow box-revert"></td>
            <td class="border-t-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-l-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-l-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-l-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-r-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5"></td>
            <td></td>
            <td class="w-6.5 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-b-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-r-4 border-l-4 border-yellow box-revert"></td>
            <td class="w-6.5"></td>
            <td class="w-6.5"></td>
            <td class="text-center">
                <table class="w-full">
                    <tr>
                        <td colspan="3">
                            <div class="relative flex justify-between items-center">
                                <img src="/images/dragon-small.png" class="h-52 float-left" alt="Golden Dragon">
                                <div class="absolute left-1/2 transform -translate-x-1/2 text-center font-bold">
                                    <span class="block text-4xl font-bold text-yellow">{{ __('website.chineese_specialties') }}</span>
                                    <span class="block text-5xl font-bold text-yellow">{{ __('website.golden_dragon') }}</span>
                                        <div class="text-lg mt-4">
                                            <x-website.button route="menu" name="website.menu" />
                                            <x-website.button route="news" name="website.news" />
                                            <x-website.button route="contact" name="website.contact" />
                                        </div>
                                </div>
                                <img src="/images/dragon-small-flipped.png" class="h-52 float-right" alt="Golden Dragon">
                            </div>
                        </td>
                    </tr>
                </table>
                
                {{ $slot }}

                <br>
                <div class="text-center"><a href="{{ route('contact') }}">{{ __('website.navigation_contact') }}</a></div>
            </td>
            <td class="w-6.5"></td>
            <td class="w-6.5"></td>
            <td class="w-6.5 border-r-4 border-l-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-r-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-yellow box-revert"></td>
            <td></td>
            <td class="w-6.5 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-t-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-l-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-t-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="bg-customRed h-6.5">
            <td class="w-1.75"></td>
            <td class="w-6.5 border-l-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-yellow box-revert"></td>
            <td class="border-t-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-l-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-l-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-6.5 border-r-4 border-b-4 border-yellow box-revert"></td>
            <td class="w-1.75"></td>
        </tr>
        <tr class="h-1.75 bg-customRed">
            <td colspan="9"></td>
        </tr>
    </table>
</div>
