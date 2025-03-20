<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            個別表示
        </h2>
    </x-slot>
    
    <div class="max-w-3xl mx-auto px-4 py-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <!-- Post Header Area -->
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                    {{$post->title}}
                </h1>
                <div class="flex space-x-2">
                    <a href="{{route('post.edit',$post)}}">
                        <x-primary-button class="text-sm">
                            編集
                        </x-primary-button>
                    </a>
                    <form method="post" action="{{route('post.destroy',$post)}}">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-600 hover:bg-red-700 text-sm">
                            削除
                        </x-primary-button>
                    </form>
                </div>
            </div>
            
            <!-- Post Content Area -->
            <div class="space-y-4">
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                    {{$post->body}}
                </p>
                
                <!-- Image Display -->
                @if($post->image)
                <div class="mt-4">
                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank" class="text-blue-600 dark:text-blue-400 text-sm hover:underline mb-2 inline-block">
                        画像リンク
                    </a>
                    <div class="mt-2">
                        <img id="dis" src="{{ asset('storage/' . $post->image) }}" alt="投稿画像" class="max-w-full max-h-60 rounded-md">
                    </div>
                </div>
                @endif
                
                <div class="text-sm text-gray-500 dark:text-gray-400 text-right">
                    投稿日時: {{$post->created_at}}
                </div>
            </div>
            
            <!-- Image Analysis Section -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold mb-3">画像分析</h3>
                
                @if($post->image)
                <form id="imageAnalysisForm" data-analyze-url="{{ route('image.analyze') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="image_path" value="{{ $post->image }}">
                    
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm font-medium transition-colors">
                        この画像を分析する
                    </button>
                </form>
                @else
                <div class="text-gray-500 dark:text-gray-400 text-sm">
                    画像が添付されていないため、分析できません。
                </div>
                @endif
                
                <div id="analysisResult" class="mt-6 p-4 border border-gray-200 dark:border-gray-700 rounded-md hidden bg-gray-50 dark:bg-gray-900">
                    <h4 class="font-medium text-lg mb-2">分析結果</h4>
                    <div id="resultContent" class="text-sm"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TensorFlow.jsのライブラリを読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.18.0"></script>
    <!-- 修正した画像分析スクリプトを読み込み -->
    <script src="{{ asset('js/tensorflow-classifier.js') }}"></script>
</x-app-layout>