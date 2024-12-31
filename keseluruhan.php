<?php
include 'sql/sqlkeseluruhan.php';
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
    echo "<h2 class='text-center'>Tabel Skor Keseluruhan HP</h2>";
    echo "<table border='1' id='combined-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Brand dan Nama Produk</th>";
    echo "<th onclick='sortTable(2)'><span>Gaming</span><span class='sort-icon'></span></th>";
    echo "<th onclick='sortTable(3)'><span>Fotografi</span><span class='sort-icon'></span></th>";
    echo "<th onclick='sortTable(4)'><span>Konten Kreator</span><span class='sort-icon'></span></th>";
    echo "<th onclick='sortTable(5)'><span>Sehari-hari</span><span class='sort-icon'></span></th>";
    echo "<th onclick='sortTable(6)'><span>Harga</span><span class='sort-icon'></span></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($data as $hp) {
        $harga = str_replace(['Rp ', '.'], '', $hp['Harga']);
        $hpData = json_encode([
            'Brand' => $hp['Brand'],
            'NamaProduk' => $hp['Nama Produk'],
            'TahunRilis' => $hp['Tahun Rilis'],
            'Jaringan' => $hp['Jaringan'],
            'Material' => $hp['Material'],
            'SIMSlots' => $hp['SIM Slots'],
            'Technology' => $hp['Technology'],
            'UkuranLayar' => $hp['Ukuran Layar'],
            'ScreenResolution' => $hp['Screen Resolution'],
            'OSVersionVersionDetail' => $hp['OS Version & Version Detail'],
            'Skor_AnTuTu' => $hp['Skor_AnTuTu'],
            'Prosesor' => $hp['Prosesor'],
            'RAMGB' => $hp['RAM (GB)'],
            'MemoriInternalGB' => $hp['Memori Internal (GB)'],
            'NFC' => $hp['NFC'],
            'USB' => $hp['USB'],
            'KapasitasBaterai' => $hp['Kapasitas Baterai'],
            'DayaFastCharging' => $hp['Daya Fast Charging'],
            'Waterproof' => $hp['Waterproof'],
            'Sensor' => $hp['Sensor'],
            'Jack35mm' => $hp['3.5mm Jack'],
            'ResolusiKameraBelakang' => $hp['Resolusi Kamera Belakang'],
            'ResolusiKameraUtamaLainnya' => $hp['Resolusi Kamera Utama Lainnya'],
            'DualKameraBelakang' => $hp['Dual Kamera Belakang'],
            'JumlahKameraBelakang' => $hp['Jumlah Kamera Belakang'],
            'ResolusiKameraDepan' => $hp['Resolusi Kamera Depan'],
            'DualKameraDepan' => $hp['Dual Kamera Depan'],
            'Flash' => $hp['Flash'],
            'DualFlash' => $hp['Dual Flash'],
            'Video' => $hp['Video'],
            'Harga' => $hp['Harga'],
            'ImageURL' => isset($hp['Image URL']) ? $hp['Image URL'] : '' // Tambahkan URL gambar
        ]);
        echo "<tr data-hp='$hpData'>";
        echo "<td>{$hp['Brand']} - {$hp['Nama Produk']} {$hp['RAM (GB)']}/{$hp['Memori Internal (GB)']}</td>";
        echo "<td class='gaming-score'></td>";
        echo "<td class='fotografi-score'></td>";
        echo "<td class='konten-kreator-score'></td>";
        echo "<td class='sehari-hari-score'></td>";
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
    <link rel="stylesheet" href="style/keseluruhan.css">
    <script src="js/modulKeseluruhan/nampiltabel.js" defer></script>
    <script src="js/modulKeseluruhan/skoringkeseluruhan.js" defer></script>
    <script src="js/modulKeseluruhan/rumuskeseluruhan.js" defer></script>
    <script src="js/convert.js" defer></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="hidden-element">Skoring HP</h1>

        <?php
        foreach ($data as $hp) {
            echo "<h2 class='hidden-element'>ID: {$hp['id']}</h2>";
            echo "<h2 class='hidden-element'>Brand: {$hp['Brand']}</h2>";
            echo "<h2 class='hidden-element'>Nama Produk: {$hp['Nama Produk']}</h2>";

            createTable("Tabel Gaming", $gamingCriteria, $hp);
            createTable("Tabel Fotografi", $fotografiCriteria, $hp);
            createTable("Tabel Konten Kreator", $kontenKreatorCriteria, $hp);
            createTable("Tabel Sehari-hari", $sehariHariCriteria, $hp);
        }

        createCombinedTable($data);
        ?>

        <button id="export-btn" class="btn">Import ke JSON</button>
    </div>

    <!-- Pop-up structure -->
    <div id="popup" class="popup">
        <div id="popup-content" class="popup-content"></div>
    </div>
</body>
</html>
