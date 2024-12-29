<?php
include 'sql/sqlpemilihan.php';
include 'component/navbar.php';

function getResolutionCategory($resolution) {
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

function createCombinedTable($data) {
    echo "<table border='1' id='combined-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID HP</th>";
    echo "<th>Brand dan Nama Produk</th>";
    echo "<th>Gaming</th>";
    echo "<th>Fotografi</th>";
    echo "<th>Konten Kreator</th>";
    echo "<th>Sehari-hari</th>";
    echo "<th>NFC</th>";
    echo "<th>Waterproof</th>";
    echo "<th>3.5mm Jack</th>";
    echo "<th>Harga</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($data as $hp) {
        $harga = str_replace(['Rp ', '.'], '', $hp['Harga']);
        echo "<tr>";
        echo "<td>{$hp['id']}</td>";
        echo "<td>{$hp['Brand']} - {$hp['Nama Produk']} {$hp['RAM (GB)']}/{$hp['Memori Internal (GB)']}</td>";
        echo "<td class='gaming-score'></td>";
        echo "<td class='fotografi-score'></td>";
        echo "<td class='konten-kreator-score'></td>";
        echo "<td class='sehari-hari-score'></td>";
        echo "<td>{$hp['NFC']}</td>";
        echo "<td>{$hp['Waterproof']}</td>";
        echo "<td>{$hp['3.5mm Jack']}</td>";
        echo "<td>" . number_format($harga, 0, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

$gamingCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Technology"];
$fotografiCriteria = ["Resolusi Kamera Belakang", "Resolusi Kamera Depan", "Memori Internal (GB)", "Screen Resolution", "Technology"];
$kontenKreatorCriteria = ["Resolusi Kamera Belakang", "Resolusi Kamera Depan", "Memori Internal (GB)", "Kapasitas Baterai", "Daya Fast Charging"];
$sehariHariCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Screen Resolution"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skoring HP</title>
    <link rel="stylesheet" href="style/pemilihan.css">

    <script src="js/modulPemilihan/skoringpemilihan.js" defer></script>
    <script src="js/modulPemilihan/rumuspemilihan.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="content-box">
        <h1>Pemilihan HP</h1>

        <!-- Container untuk menampung semua elemen filter -->
        <div id="filter-container">
            <!-- Elemen untuk menampung combo box baru -->
            <div id="result-combo-box-container"></div>

            <!-- Elemen untuk menampung combo box harga -->
            <div id="price-combo-box-container"></div>

            <!-- Elemen untuk menampung combo box kategori -->
            <div id="category-combo-box-container"></div>

            <!-- Elemen untuk menampung checkbox fitur -->
            <div id="feature-checkbox-container"></div>
        </div>

        <!-- Elemen untuk menampung tabel lengkap -->
        <div id="result-table-container"></div>

        <!-- Elemen untuk menampung tabel lengkap yang difilter -->
        <div id="filtered-result-table-container"></div>

        <!-- Elemen untuk menampung tabel gabungan yang disembunyikan -->
        <div id="combined-table-container" style="display: none;">
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
        </div>
    </div>
</body>
</html>
