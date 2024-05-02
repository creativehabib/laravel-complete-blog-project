<x-app-layout>
    <p class="text-gray-300">Post Title: {{ $post->post_title }}</p>
    <p class="text-gray-300">Meta Title: {{ $post->meta?->meta_title }}</p>
    <p class="text-gray-300">{{ $post->category->name }}</p>
    <p class="text-gray-300">{{ $post->created_by->name }}</p>
</x-app-layout>
