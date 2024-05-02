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
            <button type="button" onClick="onFormPanel()" href="javascript:void(0);" class="font-semibold text-gray-500 dark:text-gray-400 btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</button>
            <button type="button" onClick="onListPanel()" href="javascript:void(0);" class="font-semibold text-gray-500 dark:text-gray-400 btn-list float-right hidden"><i class="fa fa-reply"></i> {{ __('Back') }}</button>
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
                        <a onClick="onMediaModalView({{ $row->id }})" href="javascript:void(0);"><img class="h-auto max-w-full shadow border rounded-lg" src="{{ asset('media/'.$row->media_file) }}" alt="{{ $row->media_alt }}"></a>
                    </div>
                @endforeach
            </div>



            <!--media modal view-->
            <div class="modal"  id="media_modal_view">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Attachment Details') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form novalidate="" data-validate="parsley" id="DataEntry_formId">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="media_preview_img" class="media-preview-img"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alternative_text">{{ __('Alternative Text') }}</label>
                                                <input type="text" name="alternative_text" id="alternative_text" class="form-control parsley-validated" data-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">{{ __('Title') }}</label>
                                                <input type="text" name="title" id="title" class="form-control parsley-validated" data-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="thumbnail">{{ __('Copy Link Thumbnail Image') }}</label>
                                                <input type="text" name="thumbnail" id="thumbnail" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="RecordId" id="RecordId" />
                            <div class="modal-footer">
                                <a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/media modal view/-->


            <div class="col-span-12 lg:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                        <h6 class="mb-1 text-gray-700 dark:text-gray-100">Form element modal</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="text-white btn bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600" data-tw-toggle="modal" data-tw-target="#modal-id_form">Form element</button>

                        <div class="relative z-50 hidden modal" id="modal-id_form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="fixed inset-0 z-50 overflow-y-auto">
                                <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay"></div>
                                <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                                    <div class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                                        <div class="bg-white dark:bg-zinc-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
                                                <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                                            </button>
                                            <div class="p-5">
                                                <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">Sign in to minia</h3>
                                                <form class="space-y-4" action="#">
                                                    <div>
                                                        <label for="media_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">Your email</label>
                                                        <input type="text" name="media_title" id="media_title" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0" required>
                                                    </div>
                                                    <div>
                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">Your password</label>
                                                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0" required>
                                                    </div>
                                                    <div class="flex justify-between mt-5">
                                                        <div class="flex items-start">
                                                            <div class="flex items-center h-5">
                                                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500" required>
                                                            </div>
                                                            <label for="remember" class="text-sm font-medium text-gray-900 ltr:ml-2 rtl:mr-2 dark:text-gray-100">Remember me</label>
                                                        </div>
                                                        <a href="#" class="text-sm font-medium text-violet-500 hover:text-violet-600 ">Forgot Password ?</a>
                                                    </div>
                                                    <div class="mt-6">
                                                        <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">Don't have an account ?</button>
                                                    </div>
                                                    <div class="mt-4 text-sm font-medium text-gray-500 dark:text-zinc-100/60 dark:text-gray-300">
                                                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Signup now</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
</x-app-layout>
