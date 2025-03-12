<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white bg-gradient-to-r from-indigo-500 to-purple-600 p-4 rounded-md shadow-md">
            フォームです
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-8 bg-white shadow-lg rounded-lg">
        @if(session('message'))
            <div class="text-white bg-red-500 p-3 rounded-md font-bold text-center mb-4">
                {{ session('message') }}
            </div>
        @endif
        
        <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="flex flex-col">
                <label for="title" class="font-semibold text-lg text-gray-700">件名</label>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <input type="text" name="title" id="title" placeholder="件名を入力してください"
                       class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                       value="{{ old('title') }}">
            </div>

            <div class="flex flex-col">
                <label for="body" class="font-semibold text-lg text-gray-700">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <textarea name="body" id="body" cols="30" rows="5" placeholder="本文を入力してください"
                          class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                    {{ old('body') }}
                </textarea>
            </div>
            
            <div class="flex flex-col">
                <label for="image" class="font-semibold text-lg text-gray-700">画像</label>
                <input id="image" type="file" name="image"
                       class="mt-2 file:bg-indigo-500 file:text-white file:py-2 file:px-4 file:rounded-md file:border-none file:cursor-pointer hover:file:bg-indigo-600 transition duration-300">
            </div>
            
            <x-primary-button type="submit" class="w-full py-3 text-lg font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-md hover:opacity-90 transition duration-300">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
