document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menghitung bobot berdasarkan jumlah kriteria dalam setiap kategori
    function calculateWeights() {
        // Mencari semua tabel
        const tables = document.querySelectorAll('table.hidden-table');
        const combinedTable = document.querySelector('table:not(.hidden-table)');
        const combinedRows = combinedTable.querySelectorAll('tbody tr');

        let rowIndex = 0;
        let currentRow = combinedRows[rowIndex];

        tables.forEach(table => {
            // Mencari semua baris tabel
            const rows = table.querySelectorAll('tbody tr');
            const numCriteria = rows.length;

            // Menghitung bobot
            const weight = 1 / numCriteria;

            // Menampilkan data di console
            console.log(`Bobot kriteria: Wj = 1/${numCriteria} = ${weight.toFixed(2)}`);

            // Memasukkan hasil bobot ke kolom bobot
            rows.forEach(row => {
                const weightCell = row.querySelector('td:nth-child(4)');
                if (weightCell) {
                    weightCell.textContent = weight.toFixed(2);
                }
            });

            // Menghitung skor akhir
            let totalScore = 0;
            rows.forEach(row => {
                const scoreCell = row.querySelector('td:nth-child(3)');
                const score = parseFloat(scoreCell.textContent);
                totalScore += weight * score;
            });

            // Menampilkan skor akhir di console
            console.log(`Skor akhir: Vi = ∑_(j=1)^n (Wj × rij) = ${totalScore.toFixed(2)}`);

            // Menambahkan skor akhir ke tabel gabungan
            if (table.previousElementSibling.textContent.includes('Gaming')) {
                currentRow.querySelector('.gaming-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Fotografi')) {
                currentRow.querySelector('.fotografi-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Konten Kreator')) {
                currentRow.querySelector('.konten-kreator-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Sehari-hari')) {
                currentRow.querySelector('.sehari-hari-score').textContent = totalScore.toFixed(2);
                rowIndex++;
                currentRow = combinedRows[rowIndex];
            }
        });
    }

    // Memanggil fungsi calculateWeights setelah dokumen selesai dimuat
    calculateWeights();
});
