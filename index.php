<?php
include 'component/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base Styling */
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f7;
        }

        /* Container Styling */
        .container {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Text Styling */
        .text-center {
            text-align: center;
        }

        .text-center h1 {
            font-size: 2rem;
            color: #333;
        }

        .text-center p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
                max-width: 100%;
                border-radius: 0;
            }

            .text-center h1 {
                font-size: 1.5rem;
            }

            .text-center p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0.5rem;
            }

            .text-center h1 {
                font-size: 1.2rem;
            }

            .text-center p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Selamat Datang di Aplikasi Rekomendasi Smartphone Android</h1>
            <p class="mt-4">
                Aplikasi ini dirancang untuk membantu Anda dalam memilih smartphone Android yang sesuai dengan kebutuhan Anda.
                Dengan menggunakan metode <strong>Simple Additive Weighting (SAW)</strong>, aplikasi ini memproses berbagai
                kriteria seperti performa, kamera, baterai, dan fitur lainnya untuk memberikan rekomendasi terbaik.
            </p>
            <p>
                Baik Anda mencari smartphone untuk gaming, fotografi, pembuatan konten, atau kebutuhan sehari-hari,
                aplikasi ini hadir untuk mempermudah proses pemilihan dengan hasil yang relevan dan akurat.
                Nikmati kemudahan memilih smartphone sesuai kebutuhan hanya dengan aplikasi ini.
            </p>
        </div>
    </div>
</body>
</html>
