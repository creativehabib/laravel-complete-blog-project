<div>
    <x-input-label for="meta_title" :value="__('Meta Title')"/>
    <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" placeholder="Meta title here..." :value="old('meta_title', $meta->meta_title ?? '')"/>
    <x-input-error class="mt-2" :messages="$errors->get('meta_title')" />
</div>
<div class="mt-5">
    <x-input-label for="meta_description" :value="__('Meta Description')" />
    <x-textarea-input id="meta_description" name="meta_description" rows="4" placeholder="Write your text here..." >{{old('meta_description', $meta->meta_description ?? '')}}</x-textarea-input>
    <x-input-error class="mt-2" :messages="$errors->get('meta_description')" />
</div>
<div class="mt-5">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="meta_image">Image Upload</label>
    <input value="{{old('meta_image', $meta?->meta_image)}}" name="meta_image" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="meta_image" type="file">
</div>
