function calculateBobot(tableId) {
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tr');
    const n = rows.length - 1; // Jumlah kriteria (excluding header row)
    const bobot = 1 / n;

    // Set bobot untuk setiap kriteria
    for (let i = 1; i < rows.length; i++) {
        const bobotCell = rows[i].querySelector('td:nth-child(4)');
        bobotCell.innerText = bobot.toFixed(2);
    }

    // Perbarui keterangan bobot di bawah tabel
    const explanation = table.nextElementSibling;
    explanation.innerHTML = `Bobot kriteria: W<sub>j</sub> = 1/${n} = ${bobot.toFixed(2)}`;

    // Hitung perhitungan kriteria
    let totalScore = 0;
    for (let i = 1; i < rows.length; i++) {
        const scoreCell = rows[i].querySelector('td:nth-child(3)');
        const score = parseFloat(scoreCell.innerText);
        const weightedScore = bobot * score;
        totalScore += weightedScore;
        explanation.innerHTML += `<br>Perhitungan Kriteria: (${bobot.toFixed(2)} × ${score}) = ${weightedScore.toFixed(2)}`;
    }

    // Tambahkan skor akhir
    explanation.innerHTML += `<br>Skor akhir: V<sub>i</sub> = ∑<sub>j=1</sub><sup>${n}</sup> (W<sub>j</sub> × r<sub>ij</sub>) = ${totalScore.toFixed(2)}`;
}

// Panggil fungsi calculateBobot saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    calculateBobot('gamingTable');
    calculateBobot('fotografiTable');
    calculateBobot('kontenKreatorTable');
    calculateBobot('sehariHariTable');
});
