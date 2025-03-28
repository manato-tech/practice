<x-app-layout>
    <!--header -->
    <html lang="ja">
<head>

<style>
        /* 背景画像 */
        body {
            background-image: url('/img/background.png'); /* 画像のパスを適宜変更 */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* タイトルの中央配置 & 半透明背景 */
        .title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        #championName {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(5px);
            padding: 10px 20px;
            border-radius: 10px;
            text-align: center;
        }

        /* 表の背景をコンパクトに調整 */
        /* 表のコンテナの余白を調整 */
.table-container {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
    padding: 10px;  /* 余白を減らす */
    border-radius: 10px;
    max-width: 800px; /* 表の最大幅を制限 */
    margin: 20px auto 5px auto; /* 下の余白を減らす */
}

/* 表の下の次のセクションとの間隔を縮める */
.next-section {
    margin-top: 10px; /* これでガイドとの距離を詰める */
}


        /* 表のスタイル調整 */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px; /* 余白を少し減らす */
            text-align: center;
        }

        th {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600" rel="stylesheet">
</head>
    <x-slot name="title">
        lolのサイト
    </x-slot>

    <!-- 検索フォームをスタイリング -->
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <form id="championSearchForm" class="flex gap-2 mb-6">
            <input type="text" id="championInput" name="query" placeholder="チャンピオン名を入力"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                検索
            </button>
        </form>
    </div>

    <!-- タイトル -->
    <h1 class="text-4xl font-bold text-center text-gray-800 my-6" id="championName">チャンピオンの勝率</h1>

    <!-- 表を作る -->
    <div class="max-w-3xl mx-auto overflow-x-auto">
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
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_opgg_iron">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_opgg_blonze">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_opgg_silver">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_opgg_gold">Loading...</td>
                </tr>
            </tbody>
<!--
            <tbody>
                <tr>
                    <td class="border border-gray-400 px-4 py-2">
                        <img src="/img/ugg.png" class="w-12 h-12 object-cover mx-auto">
                    </td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_ugg_iron">Coming Soon...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_ugg_blonze">Coming Soon...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_ugg_silver">Coming Soon...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_ugg_gold">Coming Soon...</td>
                </tr>
            </tbody>
-->
            <tbody>
                <tr>
                    <td class="border border-gray-400 px-4 py-2">
                        <img src="/img/lolalytics.png" class="w-12 h-12 object-cover mx-auto">
                    </td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_lola_iron">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_lola_blonze">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_lola_silver">Loading...</td>
                    <td class="border border-gray-400 px-4 py-2 break-words" id="scrapedData_lola_gold">Loading...</td>
                </tr>
            </tbody>

        </table>
    </div>



</x-app-layout>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_opgg_iron');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;//連結多分

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);
                // match 配列の内容をログに表示
                console.log(match);  // match配列の内容をログに出力

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_opgg_blonze');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_blonze') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_opgg_silver');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_silver') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_opgg_gold');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_gold') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_lola_iron');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_lola_iron') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_lola_blonze');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_lola_blonze') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_lola_silver');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_lola_silver') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrapedDataElement = document.getElementById('scrapedData_lola_gold');
    const championNameElement = document.getElementById('championName');
    const championSearchForm = document.getElementById('championSearchForm');
    const championInput = document.getElementById('championInput');
    
    // デフォルトのチャンピオン名
    let currentChampion = 'garen';
    
    // チャンピオンデータを取得する関数
    function fetchChampionData(champion) {
        // ローディング表示
        scrapedDataElement.innerText = "Loading...";
        
        fetch("{{ route('scrape.data_lola_gold') }}?champion=" + encodeURIComponent(champion))
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
                
                // Update page title with champion name
                if (data.champion) {
                    const capitalizedChampion = data.champion.charAt(0).toUpperCase() + data.champion.slice(1);
                    championNameElement.innerText = capitalizedChampion + 'の勝率';
                }
                
                // 取得したデータ
                const text = `${data.title} ${data.description}`;

                // 正規表現で最初に現れる `数字 + %` を取得
                const match = text.match(/(\d+(\.\d+)?)%/);

                if (match) {
                    const percentage = parseFloat(match[1]); // 数値として取得
                    scrapedDataElement.innerText = match[0];

                    // 48.5% 以下なら青、51.5%以上なら赤
                    if (percentage <= 48.5) {
                        scrapedDataElement.style.color = 'blue';
                    } else if (percentage >= 51.5) {
                        scrapedDataElement.style.color = 'red';
                    } else {
                        scrapedDataElement.style.color = 'black'; // それ以外は黒
                    }
                } else {
                    scrapedDataElement.innerText = "データなし";
                    scrapedDataElement.style.color = 'black';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                scrapedDataElement.innerText = 'データ取得エラー: ' + error.message;
                scrapedDataElement.style.color = 'black';
            });
    }
    
    // 検索フォームの送信イベント
    championSearchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ページ遷移を防止
        
        const champion = championInput.value.trim().toLowerCase();
        
        if (champion) {
            currentChampion = champion;
            fetchChampionData(champion);
        }
    });
    
    // 初期データ取得
    fetchChampionData(currentChampion);
});
</script>

<!-- 既存のテーブルの下に追加 -->
<!-- DeepSeek APIによるチャンピオンガイド -->
<!-- 既存のテーブルの下に追加 -->
<div class="max-w-6xl mx-auto px-14 mt-40 mb-20">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4" id="guideTitle">ガレンの戦い方ガイド</h2>
        <div id="championGuide" class="prose max-w-none">
            <p class="text-gray-500">チャンピオンを検索するとガイドが表示されます</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const guideElement = document.getElementById('championGuide');
    const searchForm = document.getElementById('championSearchForm');
    const guideTitle = document.getElementById('guideTitle');

    searchForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const champion = document.getElementById('championInput').value.trim();
        
        if (!champion) return;

        guideElement.innerHTML = '<p class="text-blue-500">読み込み中...</p>';
        guideTitle.textContent = `${champion}の戦い方ガイド`;
        
        try {
            const response = await fetch(`/champion-guide?champion=${encodeURIComponent(champion)}`);
            const guide = await response.text();
            
            // 改行を<br>タグに変換して表示
            guideElement.innerHTML = guide.split('\n')
                .map(line => `<p>${line}</p>`)
                .join('');
        } catch (error) {
            guideElement.innerHTML = `<p class="text-red-500">エラー: ${error.message}</p>`;
        }
    });
});
</script>