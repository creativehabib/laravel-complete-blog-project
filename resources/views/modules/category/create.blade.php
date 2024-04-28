<x-app-layout>
    <div class="max-w-full mx-auto space-y-6">
        <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-y-4 lg:gap-4">
                    <div class="col-span-2 border p-4 rounded-md dark:border-gray-700"> <!-- Column 1 -->
                        <!-- Content for column 1 -->
                        @include('modules.category.partials.form')
                    </div>
                    <div class="border p-4 rounded-md dark:border-gray-700"> <!-- Column 2 -->
                        @include('modules.global.meta',['meta' => $category->meta ?? null])
                    </div>
                </div>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
