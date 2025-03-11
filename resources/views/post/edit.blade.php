<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           フォーム
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        
        <form method="post" action="{{ route('post.update',$post) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input type="text" name="title" class="w-full py-2 px-3 border border-gray-300 rounded-md" id="title" placeholder="件名を入力してください"
                    value="{{old('title',$post->title)}}">
                </div>
            </div>

            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')"class="mt-2"/>
                <textarea name="body" class="w-full py-2 px-3 border border-gray-300 rounded-md" id="body" cols="30" rows="5" placeholder="本文を入力してください">
                    {{old('body',$post->body)}}
                </textarea>
            </div>

             <!-- 🖼 既存の画像を表示 -->
             @if($post->image)
                <div class="mt-4">
                    <p class="font-semibold">現在の画像:</p>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像" class="w-40 h-40 object-cover mt-2">
                </div>
            @endif

            <!-- 📤 画像アップロードフォーム -->
            <div class="mt-4">
                <label for="image" class="font-semibold">画像を変更</label>
                <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                <input type="file" name="image" class="w-full py-2 px-3 border border-gray-300 rounded-md" id="image">
            </div>

            <x-primary-button type="submit" class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
