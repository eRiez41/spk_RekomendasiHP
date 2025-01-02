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
        unset($productDetails['id']); // Menghapus ID dari array agar tidak ditampilkan
        unset($productDetails['Image URL']); // Menghapus Image URL dari array agar tidak ditampilkan lagi

        echo "<div style='display: flex; align-items: flex-start;'>";
        echo "<div style='flex: 1; padding-right: 20px;'>";
        foreach ($productDetails as $key => $value) {
            echo "<p>$key: $value</p>";
        }
        echo "</div>";
        echo "<div style='flex: 1; display: flex; flex-direction: column; align-items: center; padding: 10px;'>";
        echo "<img src='$imageUrl' alt='Product Image' style='max-width: 100%; height: auto; margin: 0 auto;'>";
        echo "<a href='https://www.tokopedia.com/search?st=product&q=" . urlencode("$brand $namaProduk") . "' target='_blank' style='margin-top: 10px; text-decoration: none; color: blue;'>Link Tokped</a>";
        echo "<a href='https://shopee.co.id/search?keyword=" . urlencode("$brand $namaProduk") . "' target='_blank' style='margin-top: 10px; text-decoration: none; color: blue;'>Link Shopee</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo 'TABLE IS FALSE';
    }
    exit;
}
?>
