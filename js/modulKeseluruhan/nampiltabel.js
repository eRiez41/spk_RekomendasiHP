let sortDirection = true; // true for ascending, false for descending
let activeColumn = null;

function sortTable(columnIndex) {
    const table = document.getElementById('combined-table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const headers = table.querySelectorAll('th');

    // Remove sort icons from all headers
    headers.forEach(header => {
        const sortIcon = header.querySelector('.sort-icon');
        sortIcon.classList.remove('asc', 'desc');
    });

    // Add sort icon to the active header
    if (activeColumn === columnIndex) {
        sortDirection = !sortDirection;
    } else {
        sortDirection = true;
        activeColumn = columnIndex;
    }

    const activeHeader = headers[columnIndex];
    const activeSortIcon = activeHeader.querySelector('.sort-icon');
    activeSortIcon.classList.add(sortDirection ? 'asc' : 'desc');

    rows.sort((a, b) => {
        const aText = a.querySelectorAll('td')[columnIndex].innerText;
        const bText = b.querySelectorAll('td')[columnIndex].innerText;

        if (columnIndex === 6) {
            // Sort by price (numeric)
            const aPrice = parseFloat(aText.replace(/[^0-9.-]+/g, ""));
            const bPrice = parseFloat(bText.replace(/[^0-9.-]+/g, ""));
            return sortDirection ? aPrice - bPrice : bPrice - aPrice;
        } else {
            // Sort by text
            return sortDirection ? aText.localeCompare(bText) : bText.localeCompare(aText);
        }
    });

    // Re-append sorted rows to the tbody
    rows.forEach(row => tbody.appendChild(row));
}

function showPopup(hp) {
    const popupContent = document.getElementById('popup-content');
    popupContent.innerHTML = `
        <span class="close" onclick="closePopup()">&times;</span>
        <div class="popup-content-left">
            <h2>${hp.Brand} - ${hp.NamaProduk}</h2>
            <p><strong>Tahun Rilis:</strong> ${hp.TahunRilis}</p>
            <p><strong>Jaringan:</strong> ${hp.Jaringan}</p>
            <p><strong>Material:</strong> ${hp.Material}</p>
            <p><strong>SIM Slots:</strong> ${hp.SIMSlots}</p>
            <p><strong>Technology:</strong> ${hp.Technology}</p>
            <p><strong>Ukuran Layar:</strong> ${hp.UkuranLayar}</p>
            <p><strong>Screen Resolution:</strong> ${hp.ScreenResolution}</p>
            <p><strong>OS Version & Version Detail:</strong> ${hp.OSVersionVersionDetail}</p>
            <p><strong>Skor AnTuTu:</strong> ${hp.Skor_AnTuTu}</p>
            <p><strong>Prosesor:</strong> ${hp.Prosesor}</p>
            <p><strong>RAM (GB):</strong> ${hp.RAMGB}</p>
            <p><strong>Memori Internal (GB):</strong> ${hp.MemoriInternalGB}</p>
            <p><strong>NFC:</strong> ${hp.NFC}</p>
            <p><strong>USB:</strong> ${hp.USB}</p>
            <p><strong>Kapasitas Baterai:</strong> ${hp.KapasitasBaterai}</p>
            <p><strong>Daya Fast Charging:</strong> ${hp.DayaFastCharging}</p>
            <p><strong>Waterproof:</strong> ${hp.Waterproof}</p>
            <p><strong>Sensor:</strong> ${hp.Sensor}</p>
            <p><strong>3.5mm Jack:</strong> ${hp.Jack35mm}</p>
            <p><strong>Resolusi Kamera Belakang:</strong> ${hp.ResolusiKameraBelakang}</p>
            <p><strong>Resolusi Kamera Utama Lainnya:</strong> ${hp.ResolusiKameraUtamaLainnya}</p>
            <p><strong>Dual Kamera Belakang:</strong> ${hp.DualKameraBelakang}</p>
            <p><strong>Jumlah Kamera Belakang:</strong> ${hp.JumlahKameraBelakang}</p>
            <p><strong>Resolusi Kamera Depan:</strong> ${hp.ResolusiKameraDepan}</p>
            <p><strong>Dual Kamera Depan:</strong> ${hp.DualKameraDepan}</p>
            <p><strong>Flash:</strong> ${hp.Flash}</p>
            <p><strong>Dual Flash:</strong> ${hp.DualFlash}</p>
            <p><strong>Video:</strong> ${hp.Video}</p>
            <p><strong>Harga:</strong> ${hp.Harga}</p>
        </div>
        <div class="popup-content-right">
            <img src="${hp.ImageURL}" alt="${hp.Brand} - ${hp.NamaProduk}" style="max-width: 100%; height: auto;">
        </div>
    `;
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('combined-table');
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        row.addEventListener('click', function() {
            const hpData = JSON.parse(row.getAttribute('data-hp'));
            showPopup(hpData);
        });
    });
});