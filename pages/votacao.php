<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidato_id = $_POST['candidato'];

    try {
        $stmt = $pdo->prepare("UPDATE votos SET votos = votos + 1 WHERE candidato_id = :candidato_id");
        $stmt->execute(['candidato_id' => $candidato_id]);
        header("Location: confirmacao.php"); 
        exit;
    } catch (PDOException $e) {
        die("Erro ao votar: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/votacao.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">
                <img src="../img/joinville.png" alt="Joinville">
            </a>
            <div class="button-result">
                <a href="resultados.php">Resultados</a>
            </div>
        </nav>
    </header>

    <main id="votacaoSection">
        <h2>Escolha seu Candidato</h2>
        <form method="POST">
            <div class="candidatos">
                <div class="candidato">
                    <img src="../img/candidato1.png" alt="Candidato 1">
                    <p>Adriano Silva</p>
                    <button type="submit" name="candidato" value="1">Votar</button>
                </div>
                <div class="candidato">
                    <img src="../img/candidato2.jpg" alt="Candidato 2">
                    <p>Sargento Lima</p>
                    <button type="submit" name="candidato" value="2">Votar</button>
                </div>
                <div class="candidato">
                    <img src="../img/candidato3.webp" alt="Candidato 3">
                    <p>Luiz Cláudio Gubert</p>
                    <button type="submit" name="candidato" value="3">Votar</button>
                </div>
                <div class="candidato">
                    <img src="../img/candidato4.jpg" alt="Candidato 4">
                    <p>Rodrigo Bornholdt</p>
                    <button type="submit" name="candidato" value="4">Votar</button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
