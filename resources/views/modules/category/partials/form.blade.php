<div>
    <x-input-label for="name" :value="__('Category Name:')"/>
    <x-text-input id="name" name="name" type="text" placeholder="Category name here..." class="mt-1 block w-full" :value="old('name', $category->name ?? '')" required autofocus autocomplete="name" />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div class="mt-5">
    <x-input-label for="slug" :value="__('Category Slug')"/>
    <x-text-input id="slug" name="slug" type="text" placeholder="Category slug here..." class="mt-1 block w-full" :value="old('slug', $category->slug ?? '')"/>
    <x-input-error class="mt-2" :messages="$errors->get('slug')" />
</div>

<div class="mt-5">
    <x-input-label for="description" :value="__('Description')" />
    <x-textarea-input id="description" name="description" rows="4" placeholder="Write your text here..." >{{old('description', $category->description ?? '')}}</x-textarea-input>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div class="mt-5">
    <x-input-label for="status" :value="__('Select Status')" />
    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Select status</option>
        @foreach(\App\Models\Category::STATUS_LIST as $key => $value)
            <option value="{{$key}}" @selected( old('status', $key == $category->status ?? null))>{{$value}}</option>
        @endforeach
    </select>
</div>
<div class="mt-5">
    <label for="cat_image">Image Upload</label>
    <input type="file" name="cat_image" class="w-full">
</div>

