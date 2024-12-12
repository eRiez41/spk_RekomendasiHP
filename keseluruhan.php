<?php
include 'sql/sqlkeseluruhan.php';
include 'component/navbar.php';


function getResolutionCategory($resolution) {
    // Menggunakan ekspresi reguler untuk memisahkan lebar dan tinggi
    if (preg_match('/(\d+)\D+(\d+)/', $resolution, $matches)) {
        $width = intval($matches[1]);
        $height = intval($matches[2]);

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
    } else {
        return 'Unknown';
    }
}


// Fungsi untuk membuat tabel berdasarkan kriteria
function createTable($title, $criteria, $data) {
    echo "<h2 class='hidden-element'>$title</h2>";
    echo "<table border='1' class='hidden-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='hidden-column'>Kriteria</th>";
    echo "<th class='hidden-column'>Spesifikasi</th>";
    echo "<th class='hidden-column'>Skor</th>";
    echo "<th class='hidden-column'>Bobot</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($criteria as $criterion) {
        echo "<tr>";
        echo "<td class='hidden-column'>$criterion</td>";
        if ($criterion === 'Screen Resolution') {
            $resolution = $data[$criterion];
            $category = getResolutionCategory($resolution);
            echo "<td class='hidden-column'>$resolution ($category)</td>";
        } else {
            echo "<td class='hidden-column'>" . (isset($data[$criterion]) ? $data[$criterion] : '') . "</td>";
        }
        echo "<td class='hidden-column'></td>";
        echo "<td class='hidden-column'></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

// Fungsi untuk membuat tabel gabungan
function createCombinedTable($data) {
    echo "<h2>Tabel Gabungan</h2>";
    echo "<table border='1' id='combined-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID HP</th>";
    echo "<th>Brand dan Nama Produk</th>";
    echo "<th>Gaming</th>";
    echo "<th>Fotografi</th>";
    echo "<th>Konten Kreator</th>";
    echo "<th>Sehari-hari</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($data as $hp) {
        echo "<tr>";
        echo "<td>{$hp['id']}</td>";
        echo "<td>{$hp['Brand']} {$hp['Nama Produk']}</td>";
        echo "<td class='gaming-score'></td>";
        echo "<td class='fotografi-score'></td>";
        echo "<td class='konten-kreator-score'></td>";
        echo "<td class='sehari-hari-score'></td>";
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
    <style>
        .hidden-column {
            display: none;
        }
        .hidden-table {
            display: none;
        }
        .hidden-element {
            display: none;
        }
    </style>
    <script src="js/skoringkeseluruhan.js" defer></script>
    <script src="js/rumuskeseluruhan.js" defer></script>
    <script src="js/convert.js" defer></script>
</head>
<body>
    <h1 class="hidden-element">Skoring HP</h1>

    <?php
    foreach ($data as $hp) {
        echo "<h2 class='hidden-element'>ID: {$hp['id']}</h2>";
        echo "<h2 class='hidden-element'>Brand: {$hp['Brand']}</h2>";
        echo "<h2 class='hidden-element'>Nama Produk: {$hp['Nama Produk']}</h2>";

        // Membuat tabel Gaming
        createTable("Tabel Gaming", $gamingCriteria, $hp);

        // Membuat tabel Fotografi
        createTable("Tabel Fotografi", $fotografiCriteria, $hp);

        // Membuat tabel Konten Kreator
        createTable("Tabel Konten Kreator", $kontenKreatorCriteria, $hp);

        // Membuat tabel Sehari-hari
        createTable("Tabel Sehari-hari", $sehariHariCriteria, $hp);
    }

    // Membuat tabel gabungan
    createCombinedTable($data);
    ?>

    <button id="export-btn">Import ke JSON</button>
</body>
</html>
