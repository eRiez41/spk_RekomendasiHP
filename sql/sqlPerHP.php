<?php
include __DIR__ . '/../koneksi/koneksi.php';

// Fungsi untuk mendapatkan data smartphone berdasarkan ID
function getSmartphoneData($conn, $selectedId) {
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
        LEFT JOIN
            soc s ON INSTR(REPLACE(sp.Prosesor, ',', ''), s.processor) > 0
        WHERE
            sp.id = ?
        LIMIT 1;
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $selectedId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }

    $stmt->close();
    return $data;
}

// Fungsi untuk mendapatkan daftar ID smartphone dengan informasi tambahan
function getSmartphoneList($conn) {
    $query = "SELECT id, Brand, `Nama Produk`, `RAM (GB)`, `Memori Internal (GB)` FROM spek_hp";
    $result = $conn->query($query);

    $smartphones = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $smartphones[] = $row;
        }
    }

    return $smartphones;
}
?>
