<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, insira um e-mail válido.";
    } elseif ($idade < 18) {
        $error = "Você deve ter 18 anos ou mais para se cadastrar.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, idade) VALUES (:nome, :email, :idade)");
            $stmt->execute(['nome' => $nome, 'email' => $email, 'idade' => $idade]);

            error_log("Dados inseridos no banco com sucesso");

            header("Location: votacao.php");
            exit;
        } catch (PDOException $e) {
            $error = "Erro ao cadastrar: " . $e->getMessage();
            error_log($error); 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cadastros.css">
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

    <main id="cadastroSection">
        <h2>Cadastro</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST" id="cadastroForm">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required>

            <button type="submit">Cadastrar</button>
        </form>
    </main>

    <footer>
        <img src="../img/logoFooterPMJ-blue.png" alt="">
        <div class="footer-info">
            <span>Prefeitura de Joinville</span>
            <p>
                Av. Hermann August Lepper, 10, Centro<br>89221-901 • Joinville • SC - (47) 3431-3233
            </p>
        </div>
    </footer>
</body>
</html>
