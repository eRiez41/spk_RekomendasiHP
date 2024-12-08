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
                        if (bateraiValue < 4000) {
                            score = 25;
                        } else if (bateraiValue >= 4000 && bateraiValue <= 4999) {
                            score = 50;
                        } else if (bateraiValue >= 5000 && bateraiValue <= 6999) {
                            score = 75;
                        } else if (bateraiValue >= 7000) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Daya Fast Charging
                    else if (specCell.previousElementSibling.textContent.trim() === 'Daya Fast Charging') {
                        let fastChargingValue = parseFloat(specValue.replace('W', ''));
                        if (fastChargingValue < 15) {
                            score = 25;
                        } else if (fastChargingValue >= 15 && fastChargingValue <= 24.9) {
                            score = 50;
                        } else if (fastChargingValue >= 25 && fastChargingValue <= 64.9) {
                            score = 75;
                        } else if (fastChargingValue >= 65) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk RAM
                    else if (specCell.previousElementSibling.textContent.trim() === 'RAM (GB)') {
                        let ramValue = parseFloat(specValue.replace(' GB', ''));
                        if (ramValue < 4) {
                            score = 25;
                        } else if (ramValue >= 4 && ramValue <= 5.9) {
                            score = 50;
                        } else if (ramValue >= 6 && ramValue <= 8) {
                            score = 75;
                        } else if (ramValue > 8) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Memori Internal (GB)
                    else if (specCell.previousElementSibling.textContent.trim() === 'Memori Internal (GB)') {
                        let internalValue = parseFloat(specValue.replace(' GB', ''));
                        if (internalValue < 32) {
                            score = 25;
                        } else if (internalValue >= 32 && internalValue <= 127.9) {
                            score = 50;
                        } else if (internalValue >= 128 && internalValue <= 254.9) {
                            score = 75;
                        } else if (internalValue >= 256) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Kamera Belakang
                    else if (specCell.previousElementSibling.textContent.trim() === 'Resolusi Kamera Belakang') {
                        let cameraValue = parseFloat(specValue.replace(' MP', ''));
                        if (cameraValue < 8) {
                            score = 25;
                        } else if (cameraValue >= 8 && cameraValue <= 15.9) {
                            score = 50;
                        } else if (cameraValue >= 16 && cameraValue <= 49.9) {
                            score = 75;
                        } else if (cameraValue >= 50) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Kamera Depan
                    else if (specCell.previousElementSibling.textContent.trim() === 'Resolusi Kamera Depan') {
                        let frontCameraValue = parseFloat(specValue.replace(' MP', ''));
                        if (frontCameraValue < 5) {
                            score = 25;
                        } else if (frontCameraValue >= 5 && frontCameraValue <= 15.9) {
                            score = 50;
                        } else if (frontCameraValue >= 16 && frontCameraValue <= 31.9) {
                            score = 75;
                        } else if (frontCameraValue >= 32) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Skor AnTuTu
                    else if (specCell.previousElementSibling.textContent.trim() === 'Skor_AnTuTu') {
                        let antutuValue = parseFloat(specValue.replace(',', ''));
                        if (antutuValue < 100000) {
                            score = 25;
                        } else if (antutuValue >= 100000 && antutuValue <= 199999) {
                            score = 50;
                        } else if (antutuValue >= 200000 && antutuValue <= 499999) {
                            score = 75;
                        } else if (antutuValue >= 500000) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Versi OS
                    else if (specCell.previousElementSibling.textContent.trim() === 'OS Version & Version Detail') {
                        if (specValue.includes('Android 12')) {
                            score = 25;
                        } else if (specValue.includes('Android 13')) {
                            score = 50;
                        } else if (specValue.includes('Android 14')) {
                            score = 75;
                        } else if (specValue.includes('Android 15') || specValue.includes('Android 16') || specValue.includes('Android 17') || specValue.includes('Android 18') || specValue.includes('Android 19')) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Teknologi Layar
                    else if (specCell.previousElementSibling.textContent.trim() === 'Technology') {
                        if (specValue.includes('IPS') || specValue.includes('PLS')) {
                            score = 50;
                        } else if (specValue.includes('AMOLED') || specValue.includes('SUPER AMOLED') || specValue.includes('OLED')) {
                            score = 100;
                        }
                    }
                    // Aturan skoring untuk Resolusi Layar
                    else if (specCell.previousElementSibling.textContent.trim() === 'Screen Resolution') {
                        let resolutionCategory = specValue.match(/\(([^)]+)\)/)[1];
                        if (resolutionCategory === 'HD') {
                            score = 25;
                        } else if (resolutionCategory === 'FHD') {
                            score = 50;
                        } else if (resolutionCategory === '2K') {
                            score = 75;
                        } else if (resolutionCategory === '4K') {
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
