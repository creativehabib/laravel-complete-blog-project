<x-app-layout>

        <div class="max-w-7xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }} - {{ Auth::user()->name }}
                </div>
            </div>
        </div>

</x-app-layout>
