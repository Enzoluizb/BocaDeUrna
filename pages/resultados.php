<?php
require_once '../config.php';

try {
    $stmt = $pdo->query("SELECT candidato_id, votos FROM votos");
    $votos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar resultados: " . $e->getMessage());
}

$candidatos = [
    1 => 'Adriano Silva',
    2 => 'Sargento Lima',
    3 => 'Luiz Cláudio Gubert',
    4 => 'Rodrigo Bornholdt'
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Parciais</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/resultados.css">
</head>
<body>
    <header>
        <nav>
            <a href="../index.php">
                <img src="../img/joinville.png" alt="Joinville">
            </a>
            <div class="button-result">
                <a href="resultados.php">Resultados</a>
            </div>
        </nav>
    </header>

    <main id="resultadoSection">
        <h2>Resultados Parciais</h2>
        <div style="width: 60%; margin: auto;">
            <canvas id="graficoVotos"></canvas>
        </div>
    </main>

    <footer>
        <img src="../img/logoFooterPMJ-blue.png" alt="Logo Joinville">
        <div class="footer-info">
            <span>Prefeitura de Joinville</span>
            <p>
                Av. Hermann August Lepper, 10, Centro<br>
                89221-901 • Joinville • SC - (47) 3431-3233
            </p>
        </div>
    </footer>

    <script>
        const candidatos = <?= json_encode(array_values($candidatos)) ?>;
        const votos = <?= json_encode(array_column($votos, 'votos')) ?>;

        const ctx = document.getElementById('graficoVotos').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: candidatos,
                datasets: [{
                    label: 'Número de Votos',
                    data: votos,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
