function calculateScore(criteria, value) {
    let score = 0;

    if (criteria === "Kapasitas Baterai") {
        value = parseInt(value);
        if (value < 4000) {
            score = 25;
        } else if (value >= 4000 && value < 5000) {
            score = 50;
        } else if (value >= 5000 && value < 7000) {
            score = 75;
        } else if (value >= 7000) {
            score = 100;
        }
    } else if (criteria === "Daya Fast Charging") {
        value = parseInt(value);
        if (value < 15) {
            score = 25;
        } else if (value >= 15 && value < 25) {
            score = 50;
        } else if (value >= 25 && value < 65) {
            score = 75;
        } else if (value >= 65) {
            score = 100;
        }
    } else if (criteria === "RAM") {
        value = parseInt(value);
        if (value < 4) {
            score = 25;
        } else if (value >= 4 && value < 6) {
            score = 50;
        } else if (value >= 6 && value <= 8) {
            score = 75;
        } else if (value > 8) {
            score = 100;
        }
    } else if (criteria === "Memori Internal") {
        value = parseInt(value);
        if (value < 32) {
            score = 25;
        } else if (value >= 32 && value < 128) {
            score = 50;
        } else if (value >= 128 && value < 256) {
            score = 75;
        } else if (value >= 256) {
            score = 100;
        }
    } else if (criteria === "Resolusi Kamera Belakang") {
        value = parseInt(value);
        if (value < 8) {
            score = 25;
        } else if (value >= 8 && value < 16) {
            score = 50;
        } else if (value >= 16 && value < 50) {
            score = 75;
        } else if (value >= 50) {
            score = 100;
        }
    } else if (criteria === "Resolusi Kamera Depan") {
        value = parseInt(value);
        if (value < 5) {
            score = 25;
        } else if (value >= 5 && value < 16) {
            score = 50;
        } else if (value >= 16 && value < 32) {
            score = 75;
        } else if (value >= 32) {
            score = 100;
        }
    } else if (criteria === "Skor Antutu") {
        value = parseInt(value);
        if (value < 100000) {
            score = 25;
        } else if (value >= 100000 && value < 200000) {
            score = 50;
        } else if (value >= 200000 && value < 500000) {
            score = 75;
        } else if (value >= 500000) {
            score = 100;
        }
    } else if (criteria === "Resolusi Layar") {
        if (value === "HD") {
            score = 25;
        } else if (value === "FHD") {
            score = 50;
        } else if (value === "3K") {
            score = 75;
        } else if (value === "4K" || value === "8K") {
            score = 100;
        }
    } else if (criteria === "Versi OS") {
        if (value === "Android 12") {
            score = 25;
        } else if (value === "Android 13") {
            score = 50;
        } else if (value === "Android 14") {
            score = 75;
        } else if (value === "Android 15" || value === "Android 16") {
            score = 100;
        }
    } else if (criteria === "Video") {
        if (value === "720p") {
            score = 25;
        } else if (value === "1080p" || value === "2K") {
            score = 50;
        } else if (value === "4K") {
            score = 75;
        } else if (value === "8K") {
            score = 100;
        }
    } else if (criteria === "Teknologi Layar") {
        if (value === "IPS"|| value === "PLS") {
            score = 50;
        } else if (value === "AMOLED" || value === "SUPER AMOLED"|| value === "OLED") {
            score = 100;
        }
    }
    // Tambahkan logika skor untuk kriteria lain di sini
    return score;
}

// Panggil fungsi updateScore saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateScore);
