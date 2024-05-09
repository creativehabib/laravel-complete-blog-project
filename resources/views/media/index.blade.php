<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <ul class="flex">
                <li class="flex">
                    <div class="flex items-center">
                        <a href="{{route('dashboard')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-6 w-6 text-gray-400 dark:text-gray-400"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="w-6 h-full mx-4 text-gray-300 dark:text-gray-400" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true"><path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path></svg>
                        <a href="" class="dark:text-gray-400">Media</a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="w-6 h-full mx-4 text-gray-300 dark:text-gray-400" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true"><path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path></svg>
                        <a href="" class="dark:text-gray-400">Media list</a>
                    </div>
                </li>
            </ul>
            <button type="button" onClick="onFormPanel()" class="font-semibold text-gray-500 dark:text-gray-400 btn-form float-right">{{ __('Add New') }}</button>
            <button type="button" onClick="onListPanel()" class="font-semibold text-gray-500 dark:text-gray-400 btn-list float-right hidden">{{ __('Back') }}</button>
        </div>
    </x-slot>

    <div class="max-w-full mx-auto space-y-6 mt-3">
        <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

            <!--Upload Form-->
            <div id="form-panel" class="hidden items-center mb-5">
                <div class="text-center relative">
                    <input type="file" name="load_attachment" id="load_attachment" class="hidden opacity-0">
                    <label for="load_attachment" class="w-full h-full p-14 cursor-pointer inline-block border-4 border-dashed rounded-md border-gray-600 text-center items-center m-0" id="file-uploader">
                        <span class="text-purple-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 inline-block">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                        </span>
                        <div class="text-purple-700 font-medium text-center">{{ __('Select File') }}</div>
                    </label>
                    <div id="upload-loader" class="upload-loader hidden">
                        <div class="tp-loader"></div>
                    </div>
                </div>
            </div>
            <!--/Upload Form-->


            <div class="grid grid-cols-2 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($media_datalist as $row)
                    <div class="cursor-pointer" id="media_item_{{ $row->id }}">
                        <a onClick="onMediaDelete({{ $row->id }})" class="absolute" title="{{ __('Delete') }}" href="javascript:void(0);">X</a>
                        <a onClick="onMediaModalView({{ $row->id }})" href="javascript:void(0);" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example"><img class="h-fit shadow border rounded-lg dark:border-gray-400" src="{{ asset('media/'.$row->media_file) }}" alt="{{ $row->media_alt }}"></a>
                    </div>
                @endforeach
            </div>
            {{ $media_datalist->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- drawer component -->
    <div id="drawer-right-example" class="fixed top-0 right-0 shadow-md z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Image Details</h5>
        <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div id="media_preview_img" class="mb-4"></div>
        <form action="#" id="DataEntry_formId">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Media Title</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Media Alt Text</label>
                    <input type="text" name="alternative_text" id="alternative_text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                </div>
                <div>
                    <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Copy Image Link</label>
                    <input type="text" name="thumbnail" id="thumbnail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                </div>

                <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4">
                    <button type="submit" id="submit-form" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update
                    </button>
                    <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Cancel
                    </button>
                </div>
            </div>
            <input type="hidden" name="RecordId" id="RecordId" />
        </form>
    </div>

</x-app-layout>
