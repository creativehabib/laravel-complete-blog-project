<x-app-layout>
    <div class="max-w-full mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="col-span-2 border p-4 rounded-md dark:border-gray-700"> <!-- Column 1 -->
                        <!-- Content for column 1 -->
                        @include('modules.post.partials.form')
                    </div>
                    <div class="border p-4 rounded-md dark:border-gray-700"> <!-- Column 2 -->
                        @include('modules.global.meta',['meta' => $post->meta ?? null])
                    </div>
                </div>
                <div class="flex items-center mt-3">
                    <x-primary-button>{{__('Save')}}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
