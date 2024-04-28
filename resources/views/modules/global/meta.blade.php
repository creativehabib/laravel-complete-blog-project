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
    <input type="file" name="meta_image" class="w-full" value="{{old('meta_image', $meta?->meta_image)}}">
</div>
