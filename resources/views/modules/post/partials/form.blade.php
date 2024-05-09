<div>
    <x-input-label for="post_title" :value="__('Post Title')"/>
    <x-text-input id="post_title" name="post_title" type="text" placeholder="Post title here..." class="mt-1 block w-full" :value="old('post_title', $post->post_title ?? '')" required autofocus autocomplete="post_title" />
    <x-input-error class="mt-2" :messages="$errors->get('post_title')" />
</div>

<div class="mt-5">
    <x-input-label for="post_slug" :value="__('Post Slug')"/>
    <x-text-input id="post_slug" name="post_slug" type="text" placeholder="Post slug here..." class="mt-1 block w-full" :value="old('post_slug', $post->post_slug ?? '')"/>
    <x-input-error class="mt-2" :messages="$errors->get('post_slug')" />
</div>

<div class="mt-5">
    <x-input-label for="description" :value="__('Post Description')" />
    <x-textarea-input id="description" name="post_description" rows="4" placeholder="Write your text here..." >{{old('post_description', $post->post_description ?? '')}}</x-textarea-input>
    <x-input-error class="mt-2" :messages="$errors->get('post_description')" />
</div>

<div class="mt-5">
    <x-input-label for="is_publish" :value="__('Select Status')" />
    <select id="is_publish" name="is_publish" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Choose post status</option>
        @foreach(\App\Models\Post::PUBLISH_STATUS as $key => $value)
            <option value="{{$key}}" @selected( old('is_publish', $key == $post->is_publish ?? null))>{{$value}}</option>
        @endforeach
    </select>
</div>
{{--<label class="inline-flex items-center mt-5 cursor-pointer">--}}
{{--    <input type="checkbox" name="is_publish" value="{{old('is_publish', $post->is_publish ?? '')}}" class="sr-only peer" {{ array_keys(\App\Models\Post::PUBLISH_STATUS) == $post->is_publish ? 'checked' : '' }}>--}}
{{--    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>--}}
{{--    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Default toggle</span>--}}
{{--</label>--}}

<div class="mt-5">
    <x-input-label for="category_id" :value="__('Select Category')" />
    <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Choose a category</option>
        @foreach($categories as $key => $value)
            <option value="{{$key}}" @selected( old('category_id', $key == $post->category_id ?? null))>{{$value}}</option>
        @endforeach
    </select>
</div>
<div class="mt-5">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="post_image">Image Upload</label>
    <input value="{{old('post_image', $post->post_image)}}" name="post_image" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="post_image" type="file">
</div>

