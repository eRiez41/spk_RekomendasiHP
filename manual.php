<? include 'component/navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skoring HP Manual</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        input { width: 100%; border: none; padding: 5px; }
        .explanation { margin-top: 10px; font-style: italic; color: gray; }
    </style>
</head>
<body>
    <script>
        const categories = ['Gaming', 'Fotografi', 'Konten Kreator', 'Sehari-hari'];
        const criteriaTemplates = {
        'Gaming': ['RAM', 'Memori Internal', 'Skor Antutu', 'Kapasitas Baterai', 'Teknologi Layar'],
        'Fotografi': ['Resolusi Kamera Belakang', 'Resolusi Kamera Depan', 'Memori Internal', 'Resolusi Layar', 'Teknologi Layar'],
        'Konten Kreator': ['Resolusi Kamera Belakang', 'Resolusi Kamera Depan', 'Memori Internal', 'Kapasitas Baterai', 'Daya Fast Charging'],
        'Sehari-hari': ['RAM', 'Memori Internal', 'Skor Antutu', 'Kapasitas Baterai', 'Resolusi Layar']
    };


        const specs = {
            "RAM": ["4", "6", "8", "12"],
            "Memori Internal": ["64", "128", "256", "512"],
            "Skor Antutu": ["200000", "300000", "400000", "500000"],
            "Kapasitas Baterai": ["4000", "5000", "6000"],
            "Teknologi Layar": ["IPS", "AMOLED", "SUPER AMOLED"],
            "Daya Fast Charging": ["10", "18", "30", "65"],
            "Resolusi Kamera Belakang": ["12MP", "16MP", "48MP", "64MP"],
            "Resolusi Kamera Depan": ["8MP", "12MP", "16MP", "32MP"],
            "Resolusi Layar": ["HD", "FHD", "3K", "4K"]
        };

        const units = {
            "RAM": "GB",
            "Memori Internal": "GB",
            "Kapasitas Baterai": "mAh",
            "Daya Fast Charging": "W"
        };

        function createTable(category) {
            const table = document.createElement('table');
            table.id = category.toLowerCase().replace(/\s+/g, '') + 'Table';
            
            const headerRow = table.insertRow();
            ['Kriteria', 'Spesifikasi', 'Skor', 'Bobot'].forEach(header => {
                const th = document.createElement('th');
                th.textContent = header;
                headerRow.appendChild(th);
            });

            criteriaTemplates[category].forEach(criteria => {
                const row = table.insertRow();
                const criteriaCell = row.insertCell();
                criteriaCell.textContent = criteria;

                const specCell = row.insertCell();
                const input = document.createElement('input');
                input.type = 'text';
                input.classList.add('spec');
                if (units[criteria]) input.dataset.unit = units[criteria];
                specCell.appendChild(input);

                row.insertCell().classList.add('score');
                row.insertCell().classList.add('bobot');
            });

            return table;
        }

        document.addEventListener('DOMContentLoaded', () => {
            categories.forEach(category => {
                const h2 = document.createElement('h2');
                h2.textContent = category;
                document.body.appendChild(h2);
                
                const table = createTable(category);
                document.body.appendChild(table);
                
                const explanation = document.createElement('div');
                explanation.classList.add('explanation');
                document.body.appendChild(explanation);

                table.querySelectorAll('.spec').forEach(input => {
                    const criteria = input.parentElement.parentElement.querySelector('td:first-child').textContent;
                    let value = specs[criteria][Math.floor(Math.random() * specs[criteria].length)];
                    const unit = input.dataset.unit;
                    if (unit) value += ` ${unit}`;
                    input.value = value;
                    input.addEventListener('input', updateScore);
                });
            });

            updateScore();
        });

        function updateScore() {
            document.querySelectorAll('.spec').forEach(input => {
                const criteria = input.parentElement.parentElement.querySelector('td:first-child').textContent;
                const value = input.value.trim();
                const scoreCell = input.parentElement.parentElement.querySelector('.score');
                scoreCell.textContent = calculateScore(criteria, value);
            });

            categories.forEach(category => 
                calculateBobot(category.toLowerCase().replace(/\s+/g, '') + 'Table')
            );
        }
    </script>
    <script src="js/skoringmanual.js"></script>
    <script src="js/rumusmanual.js"></script>
</body>
</html>