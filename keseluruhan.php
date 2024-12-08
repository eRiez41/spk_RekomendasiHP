<?php
include 'sqlkeseluruhan.php';

// Fungsi untuk menentukan kategori resolusi layar
function getResolutionCategory($resolution) {
    $resolutionParts = explode(' x ', $resolution);
    $width = intval($resolutionParts[0]);
    $height = intval($resolutionParts[1]);

    if ($width >= 720 && $height < 1080) {
        return 'HD';
    } elseif ($height >= 1080 && $height < 1440) {
        return 'FHD';
    } elseif ($height >= 1440 && $height < 2160) {
        return '2K';
    } elseif ($height >= 2160) {
        return '4K';
    } else {
        return 'Unknown';
    }
}

// Fungsi untuk membuat tabel berdasarkan kriteria
function createTable($title, $criteria, $data) {
    echo "<h2>$title</h2>";
    echo "<table border='1'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Kriteria</th>";
    echo "<th>Spesifikasi</th>";
    echo "<th>Skor</th>";
    echo "<th>Bobot</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($criteria as $criterion) {
        echo "<tr>";
        echo "<td>$criterion</td>";
        if ($criterion === 'Screen Resolution') {
            $resolution = $data[$criterion];
            $category = getResolutionCategory($resolution);
            echo "<td>$resolution ($category)</td>";
        } else {
            echo "<td>" . (isset($data[$criterion]) ? $data[$criterion] : '') . "</td>";
        }
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

// Data kriteria untuk setiap tabel
$gamingCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Technology", "Daya Fast Charging"];
$fotografiCriteria = ["Resolusi Kamera Belakang", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Technology", "Screen Resolution"];
$kontenKreatorCriteria = ["Resolusi Kamera Belakang", "Resolusi Kamera Depan", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Daya Fast Charging"];
$sehariHariCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Technology", "Daya Fast Charging"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skoring HP</title>
    <script src="skoringkeseluruhan.js" defer></script>
    <script src="rumuskeseluruhan.js" defer></script>
</head>
<body>
    <h1>Skoring HP</h1>

    <?php
    foreach ($data as $hp) {
        echo "<h2>ID: {$hp['id']}</h2>";
        echo "<h2>Brand: {$hp['Brand']}</h2>";
        echo "<h2>Nama Produk: {$hp['Nama Produk']}</h2>";

        // Membuat tabel Gaming
        createTable("Tabel Gaming", $gamingCriteria, $hp);

        // Membuat tabel Fotografi
        createTable("Tabel Fotografi", $fotografiCriteria, $hp);

        // Membuat tabel Konten Kreator
        createTable("Tabel Konten Kreator", $kontenKreatorCriteria, $hp);

        // Membuat tabel Sehari-hari
        createTable("Tabel Sehari-hari", $sehariHariCriteria, $hp);
    }
    ?>
</body>
</html>
