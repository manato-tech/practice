const puppeteer = require('puppeteer');

(async () => {
    
    const url = 'https://u.gg/lol/ja_jp/champions/garen/build';
    const browser = await puppeteer.launch({ headless: false });

    const page = await browser.newPage();

    await page.setUserAgent('Mozilla/5.0');

    // ページにアクセス
    await page.goto(url, { waitUntil: 'networkidle2' });

    // 🎯 確実に存在しそうな要素を指定（例: `.champion-profile` など）
    await page.waitForSelector('h1, h2, p, div', { timeout: 5000 });

    // タイトルを取得
    const title = await page.evaluate(() => document.title);

    // 最初に見つかった `h1, h2, p, div` のテキストを取得
    const header = await page.evaluate(() => {
        const element = document.querySelector('h1, h2, p, div');
        return element ? element.innerText.trim() : 'データなし';
    });

    console.log({ title, header });

    await browser.close();
})();
