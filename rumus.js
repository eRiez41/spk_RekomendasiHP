document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menghitung bobot berdasarkan jumlah kriteria dalam setiap kategori
    function calculateWeights() {
        // Mencari semua tabel
        const tables = document.querySelectorAll('table');

        tables.forEach(table => {
            // Mencari semua baris tabel
            const rows = table.querySelectorAll('tbody tr');
            const numCriteria = rows.length;

            // Menghitung bobot
            const weight = 1 / numCriteria;

            // Menampilkan proses perhitungan bobot di bawah tabel
            const weightCalculation = document.createElement('div');
            weightCalculation.textContent = `Bobot kriteria: Wj = 1/${numCriteria} = ${weight.toFixed(2)}`;
            table.parentNode.insertBefore(weightCalculation, table.nextSibling);

            // Memasukkan hasil bobot ke kolom bobot
            rows.forEach(row => {
                const weightCell = row.querySelector('td:nth-child(4)');
                if (weightCell) {
                    weightCell.textContent = weight.toFixed(2);
                }
            });

            // Menghitung skor akhir
            let totalScore = 0;
            let scoreDetails = [];
            rows.forEach(row => {
                const scoreCell = row.querySelector('td:nth-child(3)');
                const score = parseFloat(scoreCell.textContent);
                const criteria = row.querySelector('td:nth-child(1)').textContent.trim();
                const weightedScore = weight * score;
                totalScore += weightedScore;
                scoreDetails.push(`(${weight.toFixed(2)} × ${score}) = ${weightedScore.toFixed(2)}`);
            });

            // Menampilkan perhitungan skor akhir di bawah perhitungan bobot
            const scoreCalculation = document.createElement('div');
            scoreCalculation.textContent = `Perhitungan Kriteria: ${scoreDetails.join(' + ')}`;
            table.parentNode.insertBefore(scoreCalculation, weightCalculation.nextSibling);

            // Menampilkan total skor akhir
            const totalScoreCalculation = document.createElement('div');
            totalScoreCalculation.textContent = `${totalScore.toFixed(2)} = ${totalScore.toFixed(2)}`;
            table.parentNode.insertBefore(totalScoreCalculation, scoreCalculation.nextSibling);

            // Menampilkan skor akhir
            const finalScoreCalculation = document.createElement('div');
            finalScoreCalculation.textContent = `Skor akhir: Vi = ∑_(j=1)^n (Wj × rij) = ${totalScore.toFixed(2)}`;
            table.parentNode.insertBefore(finalScoreCalculation, totalScoreCalculation.nextSibling);
        });
    }

    // Memanggil fungsi calculateWeights setelah dokumen selesai dimuat
    calculateWeights();
});
