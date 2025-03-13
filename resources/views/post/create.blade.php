<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           フォームですよ
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input type="text" name="title" class="w-full py-2 px-3 border border-gray-300 rounded-md" id="title" placeholder="件名を入力してください"
                    value="{{old('title')}}">
                </div>
            </div>

            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')"class="mt-2"/>
                <textarea name="body" class="w-full py-2 px-3 border border-gray-300 rounded-md" id="body" cols="30" rows="5" placeholder="本文を入力してください">
                    {{old('body')}}
                </textarea>
            </div>

            <label for="image">画像:</label>
            <input id="image" type="file" name="image">

            <x-primary-button type="submit" class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
