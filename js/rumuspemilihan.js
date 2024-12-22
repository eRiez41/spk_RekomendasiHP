document.addEventListener('DOMContentLoaded', function() {
    let selectedBrandProducts = [];
    let selectedPriceRange = '';
    let selectedCategory = '';

    // Fungsi untuk menghitung bobot berdasarkan jumlah kriteria dalam setiap kategori
    function calculateWeights() {
        // Mencari semua tabel
        const tables = document.querySelectorAll('table.hidden-table');
        const combinedTable = document.querySelector('table:not(.hidden-table)');
        const combinedRows = combinedTable.querySelectorAll('tbody tr');

        let rowIndex = 0;
        let currentRow = combinedRows[rowIndex];

        tables.forEach(table => {
            // Mencari semua baris tabel
            const rows = table.querySelectorAll('tbody tr');
            const numCriteria = rows.length;

            // Menghitung bobot
            const weight = 1 / numCriteria;

            // Menampilkan data di console
            console.log(`Bobot kriteria: Wj = 1/${numCriteria} = ${weight.toFixed(2)}`);

            // Memasukkan hasil bobot ke kolom bobot
            rows.forEach(row => {
                const weightCell = row.querySelector('td:nth-child(4)');
                if (weightCell) {
                    weightCell.textContent = weight.toFixed(2);
                }
            });

            // Menghitung skor akhir
            let totalScore = 0;
            rows.forEach(row => {
                const scoreCell = row.querySelector('td:nth-child(3)');
                const score = parseFloat(scoreCell.textContent);
                totalScore += weight * score;
            });

            // Menampilkan skor akhir di console
            console.log(`Skor akhir: Vi = ∑_(j=1)^n (Wj × rij) = ${totalScore.toFixed(2)}`);

            // Menambahkan skor akhir ke tabel gabungan
            if (table.previousElementSibling.textContent.includes('Gaming')) {
                currentRow.querySelector('.gaming-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Fotografi')) {
                currentRow.querySelector('.fotografi-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Konten Kreator')) {
                currentRow.querySelector('.konten-kreator-score').textContent = totalScore.toFixed(2);
            } else if (table.previousElementSibling.textContent.includes('Sehari-hari')) {
                currentRow.querySelector('.sehari-hari-score').textContent = totalScore.toFixed(2);
                rowIndex++;
                currentRow = combinedRows[rowIndex];
            }
        });
    }

    // Fungsi untuk menangkap data brand dan nama produk dari tabel dan membuat combo box baru
    function captureBrandData() {
        const combinedTable = document.querySelector('table:not(.hidden-table)');
        const combinedRows = combinedTable.querySelectorAll('tbody tr');
        const brandDataMap = new Map();

        combinedRows.forEach(row => {
            const brandCell = row.querySelector('td:nth-child(2)');
            const brandData = brandCell.textContent.trim();
            const brandName = brandData.split(' - ')[0];
            const productData = row.querySelectorAll('td');

            if (!brandDataMap.has(brandName)) {
                brandDataMap.set(brandName, []);
            }
            brandDataMap.get(brandName).push(productData);
        });

        // Membuat combo box baru
        const resultComboBoxContainer = document.createElement('div');
        resultComboBoxContainer.innerHTML = `
            <h2>Proses Pemilihan</h2>
            <select id="brand-combo-box">
                <option value="">Pilih Brand</option>
            </select>
        `;

        const comboBox = resultComboBoxContainer.querySelector('#brand-combo-box');
        brandDataMap.forEach((products, brand) => {
            const option = document.createElement('option');
            option.value = brand;
            option.textContent = brand;
            comboBox.appendChild(option);
        });

        // Menambahkan combo box baru ke dokumen
        document.body.appendChild(resultComboBoxContainer);

        // Menambahkan event listener untuk combo box
        comboBox.addEventListener('change', function() {
            const selectedBrand = comboBox.value;
            selectedBrandProducts = brandDataMap.get(selectedBrand);
            clearPreviousData();
            displaySelectedBrandData(selectedBrand, brandDataMap);
        });
    }

    // Fungsi untuk menampilkan data lengkap sesuai dengan pilihan combo box
    function displaySelectedBrandData(selectedBrand, brandDataMap) {
        const products = brandDataMap.get(selectedBrand);

        // Membuat tabel lengkap baru
        const resultTableContainer = document.createElement('div');
        resultTableContainer.innerHTML = `
            <h2>Data Lengkap</h2>
            <table border='1' id='result-table'>
                <thead>
                    <tr>
                        <th>ID HP</th>
                        <th>Brand dan Nama Produk</th>
                        <th>Gaming</th>
                        <th>Fotografi</th>
                        <th>Konten Kreator</th>
                        <th>Sehari-hari</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        `;

        const resultTableBody = resultTableContainer.querySelector('tbody');
        if (products) {
            products.forEach(productData => {
                const row = document.createElement('tr');
                productData.forEach(cell => {
                    const newCell = document.createElement('td');
                    newCell.textContent = cell.textContent.trim();
                    row.appendChild(newCell);
                });
                resultTableBody.appendChild(row);
            });
        }

        // Menghapus tabel lengkap lama jika ada
        const existingResultTable = document.getElementById('result-table-container');
        if (existingResultTable) {
            existingResultTable.remove();
        }

        // Menambahkan tabel lengkap baru ke dokumen
        resultTableContainer.id = 'result-table-container';
        document.body.appendChild(resultTableContainer);

        // Membuat combo box harga dan kategori
        createPriceRangeComboBox();
        createCategoryComboBox();
    }

    // Fungsi untuk membuat combo box harga dengan rentang harga yang telah ditentukan
    function createPriceRangeComboBox() {
        const priceComboBoxContainer = document.getElementById('price-combo-box-container');
        if (!priceComboBoxContainer) {
            const newPriceComboBoxContainer = document.createElement('div');
            newPriceComboBoxContainer.id = 'price-combo-box-container';
            newPriceComboBoxContainer.innerHTML = `
                <h2>Filter Harga</h2>
                <select id="price-range-combo-box">
                    <option value="">Pilih Rentang Harga</option>
                    <option value="1000000-2000000">1-2 juta</option>
                    <option value="2000000-3000000">2-3 juta</option>
                    <option value="3000000-4000000">3-4 juta</option>
                    <option value="4000000-5000000">4-5 juta</option>
                    <option value="5000000-6000000">5-6 juta</option>
                    <option value="6000000-7000000">6-7 juta</option>
                    <option value="7000000-8000000">7-8 juta</option>
                    <option value="8000000-9000000">8-9 juta</option>
                    <option value="9000000-10000000">9-10 juta</option>
                    <option value="10000000-">Diatas 10 juta</option>
                </select>
            `;

            const priceComboBox = newPriceComboBoxContainer.querySelector('#price-range-combo-box');

            // Menambahkan combo box harga ke dokumen
            document.body.appendChild(newPriceComboBoxContainer);

            // Menambahkan event listener untuk combo box harga
            priceComboBox.addEventListener('change', function() {
                selectedPriceRange = priceComboBox.value;
                applyFilters();
            });
        }
    }

    // Fungsi untuk membuat combo box kategori
    function createCategoryComboBox() {
        const categoryComboBoxContainer = document.getElementById('category-combo-box-container');
        if (!categoryComboBoxContainer) {
            const newCategoryComboBoxContainer = document.createElement('div');
            newCategoryComboBoxContainer.id = 'category-combo-box-container';
            newCategoryComboBoxContainer.innerHTML = `
                <h2>Filter Kategori</h2>
                <select id="category-combo-box">
                    <option value="">Pilih Kategori</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Fotografi">Fotografi</option>
                    <option value="Konten Kreator">Konten Kreator</option>
                    <option value="Sehari-hari">Sehari-hari</option>
                </select>
            `;

            const categoryComboBox = newCategoryComboBoxContainer.querySelector('#category-combo-box');

            // Menambahkan combo box kategori ke dokumen
            document.body.appendChild(newCategoryComboBoxContainer);

            // Menambahkan event listener untuk combo box kategori
            categoryComboBox.addEventListener('change', function() {
                selectedCategory = categoryComboBox.value;
                applyFilters();
            });
        }
    }

    // Fungsi untuk menerapkan filter harga dan kategori secara bersamaan
    function applyFilters() {
        let filteredProducts = selectedBrandProducts;

        // Filter berdasarkan rentang harga
        if (selectedPriceRange) {
            const [minPriceStr, maxPriceStr] = selectedPriceRange.split('-');
            const minPrice = parseInt(minPriceStr.replace(/\D/g, ''), 10);
            const maxPrice = maxPriceStr ? parseInt(maxPriceStr.replace(/\D/g, ''), 10) : Infinity;

            filteredProducts = filteredProducts.filter(productData => {
                const priceCell = productData[productData.length - 1];
                const price = parseInt(priceCell.textContent.trim().replace(/\D/g, ''), 10);
                return price >= minPrice && price <= maxPrice;
            });
        }

        // Filter berdasarkan kategori
        if (selectedCategory) {
            const categoryIndex = getCategoryIndex(selectedCategory);
            filteredProducts = filteredProducts.filter(productData => {
                const categoryCell = productData[categoryIndex];
                const categoryValue = parseFloat(categoryCell.textContent.trim());
                return !isNaN(categoryValue);
            });
        }

        // Mengurutkan data berdasarkan skor tertinggi
        filteredProducts.sort((a, b) => {
            const scoreA = parseFloat(a[getCategoryIndex(selectedCategory)].textContent.trim());
            const scoreB = parseFloat(b[getCategoryIndex(selectedCategory)].textContent.trim());
            return scoreB - scoreA;
        });

        // Membuat tabel lengkap baru
        const resultTableContainer = document.createElement('div');
        resultTableContainer.innerHTML = `
            <h2>Data Lengkap (Filtered by Price Range and Category)</h2>
            <table border='1' id='filtered-result-table'>
                <thead>
                    <tr>
                        <th>ID HP</th>
                        <th>Brand dan Nama Produk</th>
                        <th>${selectedCategory}</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        `;

        const resultTableBody = resultTableContainer.querySelector('tbody');
        filteredProducts.forEach(productData => {
            const row = document.createElement('tr');
            const idCell = productData[0];
            const brandCell = productData[1];
            const categoryCell = productData[getCategoryIndex(selectedCategory)];
            const priceCell = productData[productData.length - 1];

            const newIdCell = document.createElement('td');
            newIdCell.textContent = idCell.textContent.trim();
            row.appendChild(newIdCell);

            const newBrandCell = document.createElement('td');
            newBrandCell.textContent = brandCell.textContent.trim();
            row.appendChild(newBrandCell);

            const newCategoryCell = document.createElement('td');
            newCategoryCell.textContent = categoryCell.textContent.trim();
            row.appendChild(newCategoryCell);

            const newPriceCell = document.createElement('td');
            newPriceCell.textContent = priceCell.textContent.trim();
            row.appendChild(newPriceCell);

            resultTableBody.appendChild(row);
        });

        // Menghapus tabel lengkap lama jika ada
        const existingFilteredTable = document.getElementById('filtered-result-table-container');
        if (existingFilteredTable) {
            existingFilteredTable.remove();
        }

        // Menambahkan tabel lengkap baru ke dokumen
        resultTableContainer.id = 'filtered-result-table-container';
        document.body.appendChild(resultTableContainer);
    }

    // Fungsi untuk mendapatkan indeks kolom kategori
    function getCategoryIndex(category) {
        switch (category) {
            case 'Gaming':
                return 2;
            case 'Fotografi':
                return 3;
            case 'Konten Kreator':
                return 4;
            case 'Sehari-hari':
                return 5;
            default:
                return -1;
        }
    }

    // Fungsi untuk menghapus tabel dan combo box yang ada
    function clearPreviousData() {
        const existingResultTable = document.getElementById('result-table-container');
        if (existingResultTable) {
            existingResultTable.remove();
        }

        const existingFilteredTable = document.getElementById('filtered-result-table-container');
        if (existingFilteredTable) {
            existingFilteredTable.remove();
        }

        const existingPriceComboBoxContainer = document.getElementById('price-combo-box-container');
        if (existingPriceComboBoxContainer) {
            existingPriceComboBoxContainer.remove();
        }

        const existingCategoryComboBoxContainer = document.getElementById('category-combo-box-container');
        if (existingCategoryComboBoxContainer) {
            existingCategoryComboBoxContainer.remove();
        }

        selectedPriceRange = '';
        selectedCategory = '';
    }

    // Memanggil fungsi calculateWeights setelah dokumen selesai dimuat
    calculateWeights();

    // Memanggil fungsi captureBrandData setelah dokumen selesai dimuat
    captureBrandData();
});
