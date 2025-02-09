<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Latest post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($posts as $post)
                <a href="{{ route('post.detail', $post->slug) }}">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $post->title }}
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-right">
                            {{ $post->user->name }}
                        </div>
                    </div>
                </a>
                <br>
            @endforeach
            
        </div>
    </div>
</x-app-layout>