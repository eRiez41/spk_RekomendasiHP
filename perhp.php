<?php
include 'sql/sqlPerHP.php';
include 'component/navbar.php';

// Fungsi untuk menentukan kategori resolusi layar
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

// Fungsi untuk membuat tabel berdasarkan kriteria
function createTable($title, $criteria, $data) {
    $tableContainer = '<div class="table-container">';
    $tableContainer .= '<div class="toggle-button">';
    $tableContainer .= '<span class="icon">▼</span>';
    $tableContainer .= '<span class="category">' . $title . '</span>';
    $tableContainer .= '</div>';
    $tableContainer .= '<div class="content">';
    $tableContainer .= '<table border="1">';
    $tableContainer .= '<thead>';
    $tableContainer .= '<tr>';
    $tableContainer .= '<th>Kriteria</th>';
    $tableContainer .= '<th>Spesifikasi</th>';
    $tableContainer .= '<th>Skor</th>';
    $tableContainer .= '<th>Bobot</th>';
    $tableContainer .= '</tr>';
    $tableContainer .= '</thead>';
    $tableContainer .= '<tbody>';

    foreach ($criteria as $criterion) {
        $tableContainer .= '<tr>';
        $tableContainer .= '<td>' . $criterion . '</td>';
        if ($criterion === 'Screen Resolution') {
            $resolution = $data[$criterion];
            $category = getResolutionCategory($resolution);
            $tableContainer .= '<td>' . $resolution . ' (' . $category . ')</td>';
        } else {
            $tableContainer .= '<td>' . (isset($data[$criterion]) ? $data[$criterion] : '') . '</td>';
        }
        $tableContainer .= '<td></td>';
        $tableContainer .= '<td></td>';
        $tableContainer .= '</tr>';
    }

    $tableContainer .= '</tbody>';
    $tableContainer .= '</table>';
    $tableContainer .= '</div>';
    $tableContainer .= '</div>';

    return $tableContainer;
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
<link rel="stylesheet" href="style/perhp.css">
    <script src="js/modulPerHP/skoring.js" defer></script>
    <script src="js/modulPerHP/rumus.js" defer></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Skoring Per HP</h1>

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
            echo createTable("Tabel Gaming", $gamingCriteria, $data);

            // Membuat tabel Fotografi
            echo createTable("Tabel Fotografi", $fotografiCriteria, $data);

            // Membuat tabel Konten Kreator
            echo createTable("Tabel Konten Kreator", $kontenKreatorCriteria, $data);

            // Membuat tabel Sehari-hari
            echo createTable("Tabel Sehari-hari", $sehariHariCriteria, $data);
            ?>
        <?php else: ?>
            <p>Pilih smartphone untuk melihat detailnya.</p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toggle-button').forEach(button => {
                button.addEventListener('click', () => {
                    const tableContainer = button.closest('.table-container');
                    tableContainer.classList.toggle('expanded');
                    button.querySelector('.icon').textContent = tableContainer.classList.contains('expanded') ? '▲' : '▼';
                });
            });
        });
    </script>
</body>
</html>
