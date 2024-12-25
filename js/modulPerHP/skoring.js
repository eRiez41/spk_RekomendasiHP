document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menangkap nilai spesifikasi dan mengembalikan skor berdasarkan aturan skoring
    function scoreAll() {
        // Mencari semua baris tabel
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            // Mencari sel yang berisi spesifikasi
            const specCell = row.querySelector('td:nth-child(2)');
            if (specCell) {
                // Mencari sel yang berisi skor
                const scoreCell = specCell.nextElementSibling;
                if (scoreCell) {
                    // Mengisi nilai spesifikasi ke kolom skor
                    let specValue = specCell.textContent.trim();
                    let score = '';

                    // Aturan skoring untuk Kapasitas Baterai
                    if (specCell.previousElementSibling.textContent.trim() === 'Kapasitas Baterai') {
                        let bateraiValue = parseFloat(specValue.replace(' mAh', ''));
                        if (bateraiValue <= 3000) {
                            score = 0;
                        } else if (bateraiValue <= 4000) {
                            score = 20;
                        } else if (bateraiValue <= 5000) {
                            score = 40;
                        } else if (bateraiValue <= 6000) {
                            score = 60;
                        } else if (bateraiValue <= 7000) {
                            score = 80;
                        } else if (bateraiValue <= 8000) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Daya Fast Charging
                    else if (specCell.previousElementSibling.textContent.trim() === 'Daya Fast Charging') {
                        let fastChargingValue = parseFloat(specValue.replace('W', ''));
                        if (fastChargingValue === 5) {
                            score = 0;
                        } else if (fastChargingValue <= 10) {
                            score = 7;
                        } else if (fastChargingValue <= 15) {
                            score = 14;
                        } else if (fastChargingValue <= 20) {
                            score = 21;
                        } else if (fastChargingValue <= 25) {
                            score = 29;
                        } else if (fastChargingValue <= 30) {
                            score = 36;
                        } else if (fastChargingValue <= 45) {
                            score = 57;
                        } else if (fastChargingValue <= 50) {
                            score = 63;
                        } else if (fastChargingValue <= 65) {
                            score = 86;
                        } else if (fastChargingValue <= 67) {
                            score = 100;
                        } else if (fastChargingValue >= 67) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk RAM
                    else if (specCell.previousElementSibling.textContent.trim() === 'RAM (GB)') {
                        let ramValue = parseFloat(specValue.replace(' GB', ''));
                        if (ramValue === 2) {
                            score = 6;
                        } else if (ramValue === 3) {
                            score = 11;
                        } else if (ramValue === 4) {
                            score = 17;
                        } else if (ramValue === 6) {
                            score = 22;
                        } else if (ramValue === 8) {
                            score = 33;
                        } else if (ramValue === 12) {
                            score = 56;
                        } else if (ramValue === 16) {
                            score = 78;
                        } else if (ramValue >= 20) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Memori Internal (GB)
                    else if (specCell.previousElementSibling.textContent.trim() === 'Memori Internal (GB)') {
                        let internalValue = parseFloat(specValue.replace(' GB', ''));
                        if (internalValue === 16) {
                            score = 2;
                        } else if (internalValue === 32) {
                            score = 5;
                        } else if (internalValue === 64) {
                            score = 9;
                        } else if (internalValue === 128) {
                            score = 14;
                        } else if (internalValue === 256) {
                            score = 23;
                        } else if (internalValue === 512) {
                            score = 47;
                        } else if (internalValue === 1024) { // 1 TB = 1024 GB
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Kamera Belakang
                    else if (specCell.previousElementSibling.textContent.trim() === 'Resolusi Kamera Belakang') {
                        let cameraValue = parseFloat(specValue.replace(' MP', ''));
                        if (cameraValue <= 8) {
                            score = 4;
                        } else if (cameraValue <= 12) {
                            score = 6;
                        } else if (cameraValue <= 13) {
                            score = 7;
                        } else if (cameraValue <= 16) {
                            score = 8;
                        } else if (cameraValue <= 20) {
                            score = 10;
                        } else if (cameraValue <= 21) {
                            score = 11;
                        } else if (cameraValue <= 24) {
                            score = 13;
                        } else if (cameraValue <= 25) {
                            score = 14;
                        } else if (cameraValue <= 32) {
                            score = 17;
                        } else if (cameraValue <= 48) {
                            score = 24;
                        } else if (cameraValue <= 50) {
                            score = 25;
                        } else if (cameraValue <= 100) {
                            score = 50;
                        } else if (cameraValue <= 120) {
                            score = 57;
                        } else if (cameraValue >= 200) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Kamera Depan
                    else if (specCell.previousElementSibling.textContent.trim() === 'Resolusi Kamera Depan') {
                        let frontCameraValue = parseFloat(specValue.replace(' MP', ''));
                        if (frontCameraValue <= 5) {
                            score = 10;
                        } else if (frontCameraValue <= 12) {
                            score = 14;
                        } else if (frontCameraValue <= 13) {
                            score = 17;
                        } else if (frontCameraValue <= 16) {
                            score = 22;
                        } else if (frontCameraValue <= 20) {
                            score = 30;
                        } else if (frontCameraValue <= 24) {
                            score = 38;
                        } else if (frontCameraValue <= 25) {
                            score = 40;
                        } else if (frontCameraValue <= 30) {
                            score = 50;
                        } else if (frontCameraValue <= 32) {
                            score = 54;
                        } else if (frontCameraValue <= 48) {
                            score = 87;
                        } else if (frontCameraValue <= 50) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Jumlah Kamera Belakang
                    else if (specCell.previousElementSibling.textContent.trim() === 'Jumlah Kamera Belakang') {
                        let cameraCount = parseInt(specValue);
                        if (cameraCount === 1) {
                            score = 20;
                        } else if (cameraCount === 2) {
                            score = 25;
                        } else if (cameraCount === 3) {
                            score = 50;
                        } else if (cameraCount === 4) {
                            score = 75;
                        } else if (cameraCount === 5) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Skor AnTuTu
                    else if (specCell.previousElementSibling.textContent.trim() === 'Skor_AnTuTu') {
                        let antutuValue = parseFloat(specValue.replace(',', ''));
                        if (antutuValue <= 100000) {
                            score = 10;
                        } else if (antutuValue <= 200000) {
                            score = 20;
                        } else if (antutuValue <= 300000) {
                            score = 30;
                        } else if (antutuValue <= 400000) {
                            score = 40;
                        } else if (antutuValue <= 500000) {
                            score = 50;
                        } else if (antutuValue <= 600000) {
                            score = 60;
                        } else if (antutuValue <= 700000) {
                            score = 70;
                        } else if (antutuValue <= 800000) {
                            score = 80;
                        } else if (antutuValue <= 900000) {
                            score = 90;
                        } else if (antutuValue <= 1000000) {
                            score = 100;
                        } else if (antutuValue >= 1000000) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Versi OS
                    else if (specCell.previousElementSibling.textContent.trim() === 'OS Version & Version Detail') {
                        if (specValue.includes('Android 12')) {
                            score = 20;
                        } else if (specValue.includes('Android 13')) {
                            score = 30;
                        } else if (specValue.includes('Android 14')) {
                            score = 40;
                        } else if (specValue.includes('Android 15')) {
                            score = 50;
                        }
                    }
                    // Aturan skoring untuk Teknologi Layar
                    else if (specCell.previousElementSibling.textContent.trim() === 'Technology') {
                        if (specValue.includes('TFT')) {
                            score = 25;
                        } else if (specValue.includes('IPS') || specValue.includes('PLS')) {
                            score = 50;
                        } else if (specValue.includes('AMOLED') || specValue.includes('SUPER AMOLED') || specValue.includes('OLED')) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Layar
                    else if (specCell.previousElementSibling.textContent.trim() === 'Screen Resolution') {
                        let resolutionCategory = specValue.match(/\(([^)]+)\)/)[1];
                        if (resolutionCategory === 'HD' || resolutionCategory === 'HD+') {
                            score = 10;
                        } else if (resolutionCategory === 'FHD' || resolutionCategory === 'FHD+') {
                            score = 20;
                        } else if (resolutionCategory === '2K') {
                            score = 30;
                        } else if (resolutionCategory === '2K+') {
                            score = 40;
                        } else if (resolutionCategory === '3K') {
                            score = 50;
                        } else if (resolutionCategory === '4K') {
                            score = 60;
                        } else if (resolutionCategory === '8K') {
                            score = 100;
                        } else {
                            score = 'Unknown';
                        }
                    } else {
                        // Untuk kriteria lain, tetap mengembalikan nilai spesifikasi
                        score = specValue;
                    }

                    scoreCell.textContent = score;
                }
            }
        });
    }

    // Memanggil fungsi scoreAll setelah dokumen selesai dimuat
    scoreAll();
});
