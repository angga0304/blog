<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Latest post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <form class="max-w-sm" id="filter">
                <div class="flex justify-start px-3">
                    <label for="order" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order by:</label>
                    <select name="order" onchange="filter()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="latest">latest</option>
                        <option @if($param['order'] == 'oldest') selected @endif value="oldest">oldest</option>
                    </select>
                </div>
                
                <div class="flex justify-end px-3">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search:</label>
                    <input type="text" value="{{ $param['search'] }}" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="search a title">
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($posts as $post)
                <a href="{{ route('post.detail', $post->slug) }}">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $post->title }}
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-right" style="text-align: right; font-size: 10px;">
                            {{ $post->user->name }}
                        </div>
                    </div>
                </a>
                <br>
            @endforeach
            
        </div>
    </div>
</x-app-layout>
<script>
    function filter() {
        document.getElementById('filter').submit();
    }
</script>