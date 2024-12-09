document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('export-btn').addEventListener('click', function() {
        // Mengambil data dari tabel gabungan
        const table = document.getElementById('combined-table');
        const rows = table.querySelectorAll('tbody tr');
        const data = [];

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = {
                id: cells[0].textContent,
                brand_nama_produk: cells[1].textContent,
                gaming: cells[2].textContent,
                fotografi: cells[3].textContent,
                konten_kreator: cells[4].textContent,
                sehari_hari: cells[5].textContent
            };
            data.push(rowData);
        });

        // Mengonversi data ke JSON
        const jsonData = JSON.stringify(data, null, 2);

        // Membuat elemen <a> untuk mengunduh file JSON
        const a = document.createElement('a');
        a.href = 'data:text/json;charset=utf-8,' + encodeURIComponent(jsonData);
        a.download = 'data.json';
        a.click();
    });
});
