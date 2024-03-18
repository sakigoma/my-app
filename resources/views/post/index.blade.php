<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォーム
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif
        @foreach($posts as $post)
            <div class="mt-4 p-8 bg-white w-full rounded-sxl">
                <h1 class="p-4 text-lg font-semibold">
                    件名:
                    <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                        {{ $post->title }}
                    </a>
                </h1>
                <hr class="w-full">
                <p class="mt-4 p-4">
                    {{ $post->body }}
                </p>
                <div class="p-4 text-sm font-semibold">
                    <p>
                        {{ $post->created_at }} / {{ $post->user->name??'' }}
                    </p>
                </div>

                <span>
                    <img src="{{asset('img/nicebutton.png')}}" width="30px">

                    <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                    @if($like)
                    <!-- 「いいね」取消用ボタンを表示 -->
                        <a href="{{ route('unnice', $post) }}" class="btn btn-success btn-sm">
                            いいね
                            <!-- 「いいね」の数を表示 -->
                            <span class="badge">
                                {{ $post->likes->count() }}
                            </span>
                        </a>
                    @else
                    <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                        <a href="{{ route('like', $post) }}" class="btn btn-secondary btn-sm">
                            いいね
                            <!-- 「いいね」の数を表示 -->
                            <span class="badge">
                                {{ $post->likes->count() }}
                            </span>
                        </a>
                    @endif
                </span>
                
            </div>
        @endforeach
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
