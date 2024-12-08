<?php
include 'koneksi.php';

$query = "
    SELECT
        sp.id,
        sp.Brand,
        sp.`Tahun Rilis`,
        sp.`Nama Produk`,
        sp.Jaringan,
        sp.Material,
        sp.`SIM Slots`,
        sp.Technology,
        sp.`Ukuran Layar`,
        sp.`Screen Resolution`,
        sp.`OS Version & Version Detail`,
        s.`antutu_10` AS Skor_AnTuTu,
        sp.`RAM (GB)`,
        sp.`Memori Internal (GB)`,
        sp.NFC,
        sp.USB,
        sp.`Kapasitas Baterai`,
        sp.`Daya Fast Charging`,
        sp.Waterproof,
        sp.Sensor,
        sp.`3.5mm Jack`,
        sp.`Resolusi Kamera Belakang`,
        sp.`Resolusi Kamera Utama Lainnya`,
        sp.`Dual Kamera Belakang`,
        sp.`Jumlah Kamera Belakang`,
        sp.`Resolusi Kamera Depan`,
        sp.`Dual Kamera Depan`,
        sp.Flash,
        sp.`Dual Flash`,
        sp.Video,
        sp.Harga
    FROM
        spek_hp sp
    JOIN
        soc s ON sp.Prosesor LIKE CONCAT('%', s.processor, '%')
";

$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
?>
