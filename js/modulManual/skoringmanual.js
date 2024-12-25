function calculateScore(criteria, value) {
    let score = 0;

    if (criteria === "Kapasitas Baterai") {
        value = parseInt(value);
        if (value <= 3000) {
            score = 0;
        } else if (value <= 4000) {
            score = 20;
        } else if (value <= 5000) {
            score = 40;
        } else if (value <= 6000) {
            score = 60;
        } else if (value <= 7000) {
            score = 80;
        } else if (value <= 8000) {
            score = 100;
        }
    } else if (criteria === "Daya Fast Charging") {
        value = parseInt(value);
        if (value === 5) {
            score = 0;
        } else if (value <= 10) {
            score = 7;
        } else if (value <= 15) {
            score = 14;
        } else if (value <= 20) {
            score = 21;
        } else if (value <= 25) {
            score = 29;
        } else if (value <= 30) {
            score = 36;
        } else if (value <= 45) {
            score = 57;
        } else if (value <= 50) {
            score = 63;
        } else if (value <= 65) {
            score = 86;
        } else if (value <= 67) {
            score = 100;
        } else if (value === 67) {
            score = 100;
        }
    } else if (criteria === "RAM") {
        value = parseInt(value);
        if (value === 2) {
            score = 6;
        } else if (value === 3) {
            score = 11;
        } else if (value === 4) {
            score = 17;
        } else if (value === 6) {
            score = 22;
        } else if (value === 8) {
            score = 33;
        } else if (value === 12) {
            score = 56;
        } else if (value === 16) {
            score = 78;
        } else if (value === 20) {
            score = 100;
        }
    } else if (criteria === "Memori Internal") {
        value = parseInt(value);
        if (value === 16) {
            score = 2;
        } else if (value === 32) {
            score = 5;
        } else if (value === 64) {
            score = 9;
        } else if (value === 128) {
            score = 14;
        } else if (value === 256) {
            score = 23;
        } else if (value === 512) {
            score = 47;
        } else if (value === 1024) { // 1 TB = 1024 GB
            score = 100;
        }
    } else if (criteria === "Resolusi Kamera Belakang") {
        value = parseInt(value);
        if (value === 8) {
            score = 4;
        } else if (value === 12) {
            score = 6;
        } else if (value === 13) {
            score = 7;
        } else if (value === 16) {
            score = 8;
        } else if (value === 20) {
            score = 10;
        } else if (value === 21) {
            score = 11;
        } else if (value === 24) {
            score = 13;
        } else if (value === 25) {
            score = 14;
        } else if (value === 32) {
            score = 17;
        } else if (value === 48) {
            score = 24;
        } else if (value === 50) {
            score = 25;
        } else if (value === 100) {
            score = 50;
        } else if (value === 120) {
            score = 57;
        } else if (value === 200) {
            score = 100;
        }
    } else if (criteria === "Resolusi Kamera Depan") {
        value = parseInt(value);
        if (value === 5) {
            score = 10;
        } else if (value === 12) {
            score = 14;
        } else if (value === 13) {
            score = 17;
        } else if (value === 16) {
            score = 22;
        } else if (value === 20) {
            score = 30;
        } else if (value === 24) {
            score = 38;
        } else if (value === 25) {
            score = 40;
        } else if (value === 30) {
            score = 50;
        } else if (value === 32) {
            score = 54;
        } else if (value === 48) {
            score = 87;
        } else if (value === 50) {
            score = 100;
        }
    } else if (criteria === "Skor Antutu") {
        value = parseInt(value);
        if (value <= 100000) {
            score = 10;
        } else if (value <= 200000) {
            score = 20;
        } else if (value <= 300000) {
            score = 30;
        } else if (value <= 400000) {
            score = 40;
        } else if (value <= 500000) {
            score = 50;
        } else if (value <= 600000) {
            score = 60;
        } else if (value <= 700000) {
            score = 70;
        } else if (value <= 800000) {
            score = 80;
        } else if (value <= 900000) {
            score = 90;
        } else if (value <= 1000000) {
            score = 100;
        } else if (value === 1000000) {
            score = 100;
        }
    } else if (criteria === "Resolusi Layar") {
        if (value === "HD" || value === "HD+") {
            score = 10;
        } else if (value === "FHD" || value === "FHD+") {
            score = 20;
        } else if (value === "2K") {
            score = 30;
        } else if (value === "2K+") {
            score = 40;
        } else if (value === "3K") {
            score = 50;
        } else if (value === "4K") {
            score = 60;
        } else if (value === "8K") {
            score = 100;
        }
    } else if (criteria === "Versi OS") {
        if (value === "Android 12") {
            score = 25;
        } else if (value === "Android 13") {
            score = 50;
        } else if (value === "Android 14") {
            score = 75;
        } else if (value === "Android 15") {
            score = 100;
        }
    } else if (criteria === "Video") {
        if (value === "720p") {
            score = 10;
        } else if (value === "1080p") {
            score = 20;
        } else if (value === "2K") {
            score = 30;
        } else if (value === "4K") {
            score = 40;
        } else if (value === "8K") {
            score = 100;
        }
    } else if (criteria === "Teknologi Layar") {
        if (value === "TFT") {
            score = 25;
        } else if (value === "IPS" || value === "PLS") {
            score = 50;
        } else if (value === "AMOLED" || value === "SUPER AMOLED" || value === "OLED") {
            score = 100;
        }
    }
    // Tambahkan logika skor untuk kriteria lain di sini
    return score;
}

// Panggil fungsi updateScore saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateScore);
