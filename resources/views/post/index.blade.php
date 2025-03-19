<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           一覧表示
        </h2>
    </x-slot>

    <!-- 検索フォームをスタイリング -->
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <form action="{{ route('post.search') }}" method="GET" class="flex gap-2 mb-6">
            <input type="text" name="query" placeholder="検索キーワードを入力"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                検索
            </button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <h1 class="p-4 text-lg font-semibold">
                件名：
                <a href="{{route('post.show',$post)}}"
                class="text-blue-600">
                {{$post->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{$post->body}}
            </p>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像" style="max-width:200px;">
            @endif

            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}} / {{ optional($post->user)->name ?? 'ゲスト' }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>