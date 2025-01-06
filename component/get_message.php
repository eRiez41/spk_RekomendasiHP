<?php
include __DIR__ . '/../koneksi/koneksi.php';

function getProductDetails($id) {
    global $conn; // Asumsikan $conn adalah koneksi database Anda
    $query = "SELECT * FROM spek_hp WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $productDetails = getProductDetails($id);
    if ($productDetails) {
        $imageUrl = $productDetails['Image URL'];
        $brand = $productDetails['Brand'];
        $namaProduk = $productDetails['Nama Produk'];
        $price = $productDetails['Harga']; // Ambil harga dari database
        unset($productDetails['id']); // Menghapus ID dari array agar tidak ditampilkan
        unset($productDetails['Image URL']); // Menghapus Image URL dari array agar tidak ditampilkan lagi
        unset($productDetails['Harga']); // Menghapus Harga dari array agar tidak ditampilkan di spesifikasi

        echo "<div style='display: flex; gap: 10px; align-items: flex-start;'>"; // Jarak antar elemen lebih kecil
        echo "<div style='flex: 1; padding: 10px;'>";
        foreach ($productDetails as $key => $value) {
            echo "<p style='margin: 5px 0; font-size: 14px;'><strong>$key:</strong> $value</p>";
        }
        echo "</div>";
        echo "<div style='flex: 1; text-align: center; padding: 10px;'>";
        echo "<img src='$imageUrl' alt='Product Image' style='max-width: 150px; height: auto; margin-bottom: 10px;'>"; // Gambar lebih kecil
        echo "<p style='margin: 10px 0; font-size: 16px; font-weight: bold;'>Harga: $price</p>"; // Harga di bawah gambar
        echo "<div style='margin-top: 10px;'>";

        // Tombol marketplace
        echo "<a href='https://www.tokopedia.com/search?st=product&q=" . urlencode("$brand $namaProduk") . "' target='_blank' style='display: inline-block; margin: 5px; padding: 8px 16px; background: #4caf50; color: white; text-decoration: none; border-radius: 5px;'>Link Tokped</a>";
        echo "<a href='https://shopee.co.id/search?keyword=" . urlencode("$brand $namaProduk") . "' target='_blank' style='display: inline-block; margin: 5px; padding: 8px 16px; background: #ff5722; color: white; text-decoration: none; border-radius: 5px;'>Link Shopee</a>";

        echo "</div>";
        // Tombol beri penilaian
        echo "<div style='margin-top: 15px;'>"; // Margin tambahan untuk jarak
        echo "<a href='https://forms.gle/ik7qbmuzU4ELgLdz5' target='_blank' style='display: inline-block; margin: 5px; padding: 8px 16px; background: #2196f3; color: white; text-decoration: none; border-radius: 5px;'>Beri Penilaian</a>";
        echo "</div>";

        echo "</div>";
        echo "</div>";

    } else {
        echo 'TABLE IS FALSE';
    }
    exit;
}
?>
