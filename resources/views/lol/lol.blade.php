<x-app-layout>
    <!--header -->
    <x-slot name="title">
        lolのサイト
    </x-slot>

    <!-- 検索フォームをスタイリング -->
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <form action="{{ route('post.search') }}" method="GET" class="flex gap-2 mb-6">
            <input type="text" name="query" placeholder="チャンピオン名を入力"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                検索
            </button>
        </form>
    </div>

    <!-- タイトル -->
    <h1 class="text-4xl font-bold text-center text-gray-800 my-6">チャンピオンの勝率</h1>

    <!-- 表を作る -->
    <div class="max-w-7xl mx-auto overflow-x-auto">
        <table class="table-auto border-collapse border border-gray-400 w-full text-left" style="table-layout: fixed;">

            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-400 px-4 py-2 w-24 text-blue-600 font-bold"> </th>
                    <th class="border border-gray-400 px-4 py-2 w-2/5 text-blue-600 font-bold">Iron</th>
                    <th class="border border-gray-400 px-4 py-2 w-1/5 text-[#cd7f32] font-bold ">Bronze</th>
                    <th class="border border-gray-400 px-4 py-2 w-1/5 text-gray-500 font-bold ">Silver</th>
                    <th class="border border-gray-400 px-4 py-2 w-1/5 text-yellow-600 font-bold ">Gold</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="border border-gray-400 px-4 py-2">
                        <img src="/img/opgg.png" class="w-12 h-12 object-cover mx-auto">
                    </td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2">1</td>
                    <td class="border border-gray-400 px-4 py-2">テスト記事</td>
                    <td class="border border-gray-400 px-4 py-2">2025-03-21</td>
                </tr>
            </tbody>

            <tbody>
                <tr>
                    <td class="border border-gray-400 px-4 py-2">
                        <img src="/img/ugg.png" class="w-12 h-12 object-cover mx-auto">
                    </td>
                    <td class="border border-gray-400 px-4 py-2">1</td>
                    <td class="border border-gray-400 px-4 py-2">1</td>
                    <td class="border border-gray-400 px-4 py-2">テスト記事</td>
                    <td class="border border-gray-400 px-4 py-2">2025-03-21</td>
                </tr>
            </tbody>

            <tbody>
                <tr>
                    <td class="border border-gray-400 px-4 py-2">
                        <img src="/img/lolalytics.png" class="w-12 h-12 object-cover mx-auto">
                    </td>
                    <td class="border border-gray-400 px-4 py-2">1</td>
                    <td class="border border-gray-400 px-4 py-2">1</td>
                    <td class="border border-gray-400 px-4 py-2">2025-03-21</td>
                </tr>
            </tbody>

        </table>
    </div>

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData');

    fetch("{{ route('scrape.data') }}")
        .then(response => {
            if (!response.ok) {
                throw new Error('サーバーからのレスポンスが正常ではありません: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            
            // 取得したデータ
            const text = `${data.title} ${data.description}`;

            // 正規表現で最初に現れる `数字 + %` を取得
            const match = text.match(/(\d+(\.\d+)?)%/);

            if (match) {
                // `match[0]` は `45.90%` のような値
                scrapedDataElement.innerText = match[0];
            } else {
                scrapedDataElement.innerText = "データなし";
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
        });
        
});

</script>
