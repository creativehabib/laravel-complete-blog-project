<x-app-layout>
    <p class="dark:text-gray-300">{{ $category->name }} ({{ $category->post->count() }})</p>
    <p class="dark:text-gray-300">
        @foreach($category->post as $post)
            {{ $post->post_title }}<br>
            <img src="{{ asset('uploads/media/'.$post->post_image) }}" class="w-20">
        @endforeach
    </p>
</x-app-layout>
