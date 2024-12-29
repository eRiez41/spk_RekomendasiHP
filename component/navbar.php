<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/navbar.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">SPK Rekomendasi HP</div>
        <div class="menu">
            <a href="index.php" class="active">Home</a>
            <a href="manual.php">Perhitungan Manual</a>
            <a href="perhp.php">Per HP</a>
            <a href="keseluruhan.php">Keseluruhan</a>
            <a href="pemilihan.php">Pemilihan</a>
        </div>
    </div>

    <script>
        // JavaScript to set the active class based on the current page
        document.addEventListener("DOMContentLoaded", function() {
            const currentPage = window.location.pathname.split("/").pop();
            const navLinks = document.querySelectorAll(".navbar .menu a");

            navLinks.forEach(link => {
                if (link.getAttribute("href") === currentPage) {
                    link.classList.add("active");
                } else {
                    link.classList.remove("active");
                }
            });
        });
    </script>
</body>
</html>
