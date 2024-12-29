const puppeteer = require('puppeteer');
const fs = require('fs');

(async () => {
    try {
        // Validasi argumen input
        if (process.argv.length < 4) {
            throw new Error("Usage: node render-pdf.js '<html_content>' '<file_name>'");
        }

        const html = process.argv[2];
        const fileName = process.argv[3];

        // Validasi nama file
        if (!fileName.endsWith('.pdf')) {
            throw new Error("File name must end with .pdf");
        }

        // Launch browser Puppeteer
        const browser = await puppeteer.launch();
        const page = await browser.newPage();

        // Set HTML konten
        await page.setContent(html, { waitUntil: 'networkidle0' });

        // Render ke PDF
        const outputPath = `./public/${fileName}`;
        await page.pdf({
            path: outputPath,
            format: 'A4',
            printBackground: true
        });

        console.log(`PDF berhasil dibuat di ${outputPath}`);
        await browser.close();
    } catch (error) {
        console.error("Terjadi kesalahan:", error.message);
        process.exit(1);
    }
})();

