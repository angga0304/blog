<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {!! $post->body !!}
                </div>
            </div>
            
        </div>
    </div>

    <div class="py-12">
        <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="form-group">
                {{ html()->label('Comments('. $post->comments->count() .')', 'body') }}
                @foreach($post->listcomment as $key => $comment)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-3 items-center">
                        <img src="https://www.rattanhospital.in/wp-content/uploads/2020/03/user-dummy-pic.png" class="object-cover w-8 h-8 rounded-full 
                                border-2 border-emerald-400  shadow-emerald-400
                                ">
                        {!! $comment->user->name !!}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {!! $comment->body !!}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100"> 
                    </div>
                    @if(Auth::id() == 1) 
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a class="btn px-2.5 py-1.5 rounded-md text-white text-sm bg-red-500" onclick="confirm('want to delete this comment?')" href="{{ route('comment.delete', $comment->id ) }}">remove</a>
                        </div>
                    @endif
                    <div id="accordion-collapse" data-accordion="collapse">
                    @if($comment->replies->count())
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $key }}" aria-expanded="true" aria-controls="accordion-collapse-body-{{ $key }}">
                                <span>Replies({{ $comment->replies->count() }})</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </div>
                        <div id="accordion-collapse-body-{{ $key }}" class="" aria-labelledby="accordion-collapse-heading-{{ $key }}">
                        @foreach($comment->replies as $reply)
                        <div class="p-4 text-gray-900 dark:text-gray-100 bg-gray-200 border m-4">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {!! $reply->user->name !!}
                            </div>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {!! $reply->created_at->format('d/m/y h:s') !!}
                            </div>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {!! $reply->body !!}
                            </div>
                            @if(Auth::id() == 1) 
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <a class="btn px-2.5 py-1.5 rounded-md text-white text-sm bg-red-500" onclick="confirm('want to delete this comment?')" href="{{ route('comment.delete', $reply->id ) }}">remove</a>
                                </div>
                            @endif
                        </div>
                        <hr>
                        @endforeach
                        </div>
                    @endif
                    </div>
                    @if(Auth::user())
                    <div class="py-12">
                        {{ html()->form('POST', route('post.comment', $post->slug))->class('form-horizontal')->id('form-question')->open() }}
                            <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="form-group flex gap-3 items-center">
                                    <img src="https://www.rattanhospital.in/wp-content/uploads/2020/03/user-dummy-pic.png" class="object-cover w-8 h-8 rounded-full 
                                    border-2 border-emerald-400  shadow-emerald-400
                                    ">
                                    <h3 class="font-bold">reply as {{ Auth::user()->name }}</h3>
                                </div>
                            </div>
                            <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="form-group flex items-center justify-center">
                                    {{ html()->textarea('body', old('body'))->class('bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white')->id('body') }}
                                    {{ html()->hidden('comment_id', $comment->id)->id('cid') }}
                                    @if( $errors->has('body') )
                                        <span class="text-danger tooltip-field"><span>{{ $errors->first('body') }}</span>
                                    @endif
                                </div>
                                <div class="w-full flex justify-end px-3">
                                {{ html()->submit('Submit')->class('px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500') }} 
                                </div>
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                    @endif
                </div>
                <br>
                @endforeach
            </div>
        </div>
    </div>
    @if(Auth::user())
    <div class="py-12">
        {{ html()->form('POST', route('post.comment', $post->slug))->class('form-horizontal')->id('form-question')->open() }}
            <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group flex gap-3 items-center">
                    <img src="https://www.rattanhospital.in/wp-content/uploads/2020/03/user-dummy-pic.png" class="object-cover w-8 h-8 rounded-full 
                                border-2 border-emerald-400  shadow-emerald-400
                                ">
                    <h3 class="font-bold">{{ Auth::user()->name }}</h3>
                </div>
            </div>
            <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group flex items-center justify-center">
                    {{ html()->textarea('body', old('body'))->class('bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white')->id('body') }}
                    {{ html()->hidden('comment_id', old('comment_id'))->id('cid') }}
                    @if( $errors->has('body') )
                        <span class="text-danger tooltip-field"><span>{{ $errors->first('body') }}</span>
                    @endif
                </div>
                <div class="w-full flex justify-end px-3">
                  {{ html()->submit('Submit')->class('px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500') }} 
                </div>
            </div>
        {{ html()->form()->close() }}
    </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        you must to login for comment
                    </div>
                    <div class="p-6">
                        <a class="btn px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
<script>
    function reply(that) {
        console.log(that.dataset);
        document.getElementById("cid").value = that.dataset.cid;
        document.getElementById("body").focus();

    }
</script>