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
                        <a href="" class="dark:text-gray-400">Category</a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="w-6 h-full mx-4 text-gray-300 dark:text-gray-400" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true"><path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path></svg>
                        <a href="" class="dark:text-gray-400">Category list</a>
                    </div>
                </li>
            </ul>
            <button type="button" class="font-semibold text-gray-500 dark:text-gray-400"><a href="{{route('category.create')}}">Create</a></button>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Serial</th>
                <th scope="col" class="px-6 py-3">Category Name</th>
                <th scope="col" class="px-6 py-3">Post Count</th>
                <th scope="col" class="px-6 py-3">Updated by</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4">{{$loop->iteration}}</th>
                    <td class="px-6 py-4 flex items-center">
                        <img src="{{asset('uploads/media/'.$category->cat_image)}}" alt="" class="w-10 h-10 rounded-md">
                        <div class="ml-3">
                            <div class="text-base font-semibold dark:text-gray-100">{{$category->name}}</div>
                            <div class="font-normal text-gray-500 dark:text-zinc-100/80">{{$category->created_at->toDayDateTimeString()}}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $category->post->count() }}</td>
                    <td class="px-6 py-4">{{$category->updated_at->toDayDateTimeString()}}</td>
                    <td class="px-6 py-4">
                        <form method="post" action="{{route('category.destroy',$category->id)}}">
                            <div class="text-center">
                                <a href="{{route('category.show',$category->id)}}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-[#FF9119] rounded-lg hover:bg-[#FF9119]/80 focus:outline-none dark:bg-[#FF9119] dark:hover:bg-[#FF9119]/80">View</a>
                                <a href="{{route('category.edit',$category->id)}}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">Edit</a>
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure delete it?');" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:outline-none dark:bg-red-600 dark:hover:bg-red-700">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="5" class="text-danger">No Data found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="p-2">
            {{$categories->links('pagination::tailwind')}}
        </div>
    </div>
</x-app-layout>
