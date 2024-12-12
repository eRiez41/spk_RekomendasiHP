<?php
include 'sql/sql1.php';
include 'component/navbar.php';

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
$gamingCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Technology"];
$fotografiCriteria = ["Resolusi Kamera Belakang", "Resolusi Kamera Depan", "Memori Internal (GB)", "Screen Resolution", "Technology"];
$kontenKreatorCriteria = ["Resolusi Kamera Belakang", "Resolusi Kamera Depan", "Memori Internal (GB)", "Kapasitas Baterai", "Daya Fast Charging"];
$sehariHariCriteria = ["RAM (GB)", "Memori Internal (GB)", "Skor_AnTuTu", "Kapasitas Baterai", "Screen Resolution"];

// Ambil data smartphone berdasarkan ID yang dipilih
$selectedId = isset($_GET['id']) ? intval($_GET['id']) : null;
$data = [];

if ($selectedId) {
    $data = getSmartphoneData($conn, $selectedId);
}

// Ambil daftar ID smartphone untuk dropdown
$smartphones = getSmartphoneList($conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skoring Per HP</title>
    <script src="js/skoring.js" defer></script>
    <script src="js/rumus.js" defer></script>
</head>
<body>
    <h1>Skoring HP</h1>

    <!-- Dropdown untuk memilih smartphone -->
    <form method="GET" action="">
        <label for="smartphone">Pilih Smartphone:</label>
        <select name="id" id="smartphone" onchange="this.form.submit()">
            <option value="">Pilih Smartphone</option>
            <?php foreach ($smartphones as $smartphone): ?>
                <option value="<?php echo $smartphone['id']; ?>" <?php echo ($selectedId == $smartphone['id']) ? 'selected' : ''; ?>>
                    <?php echo $smartphone['Brand'] . ' - ' . $smartphone['Nama Produk'] . ' ' . $smartphone['RAM (GB)'] . '/' . $smartphone['Memori Internal (GB)']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($data): ?>
        <h2>ID: <?php echo $data['id']; ?></h2>
        <h2>Brand: <?php echo $data['Brand']; ?></h2>
        <h2>Nama Produk: <?php echo $data['Nama Produk']; ?></h2>

        <?php
        // Membuat tabel Gaming
        createTable("Tabel Gaming", $gamingCriteria, $data);

        // Membuat tabel Fotografi
        createTable("Tabel Fotografi", $fotografiCriteria, $data);

        // Membuat tabel Konten Kreator
        createTable("Tabel Konten Kreator", $kontenKreatorCriteria, $data);

        // Membuat tabel Sehari-hari
        createTable("Tabel Sehari-hari", $sehariHariCriteria, $data);
        ?>
    <?php else: ?>
        <p>Pilih smartphone untuk melihat detailnya.</p>
    <?php endif; ?>
</body>
</html>
