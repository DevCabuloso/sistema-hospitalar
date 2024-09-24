<?php
require_once('dbconnect.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do paciente não fornecido.";
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("SELECT * FROM tb_paciente WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paciente) {
        echo "Paciente não encontrado.";
        exit;
    }

    $stmtResponsavel = $conn->prepare("SELECT * FROM tb_responsavel WHERE tb_paciente_id = :id");
    $stmtResponsavel->bindParam(":id", $id);
    $stmtResponsavel->execute();
    $responsavel = $stmtResponsavel->fetch(PDO::FETCH_ASSOC);

    if (!$responsavel) {
        echo "Responsável não encontrado.";
        exit;
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Paciente Maior</title>
    <link rel="stylesheet" href="cadMenor.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>        
        $(document).ready(function(){
            $('#cpf_paciente').mask('###.###.###-##');
            $('#rg_paciente').mask('##.###.###-#');
        });
    </script>
</head>
<body>

<header></header>

<div class="container">
    <div class="form-box">
        <h2>Informações do Responsável e do Menor</h2>
        <form action="updatePacienteMenor.php" method="POST">
            <div class="form-section">
            <input type="hidden" name="id_paciente" value="<?= $paciente['id'] ?>">
            <div>
                    <label for="nome_responsavel">Nome (Responsável)</label>
                    <input type="text" id="nome_responsavel" name="nome_responsavel" placeholder="Digite aqui"  value="<?= $responsavel['nome'] ?>" required>
                </div>
                <div>
                    <label for="nome_menor">Nome (Menor de Idade)</label>
                    <input type="text" id="nome_menor" name="nome_menor" placeholder="Digite aqui" value="<?= $paciente['nome'] ?>" required>
                </div>
                <div>
                    <label for="cpf_responsavel">CPF (Responsável)</label>
                    <input type="text" id="cpf_responsavel" name="cpf_responsavel" placeholder="Digite aqui" minlength="14" maxlength="14" value="<?= $responsavel['cpf'] ?>" required>
                </div>
                <div>
                    <label for="cpf_menor">CPF (Menor de Idade)</label>
                    <input type="text" id="cpf_menor" name="cpf_menor" placeholder="Digite aqui" minlength="14" maxlength="14" value="<?= $paciente['cpf'] ?>" required>
                </div>
                <div>
                    <label for="rg_responsavel">RG (Responsável)</label>
                    <input type="text" id="rg_responsavel" name="rg_responsavel" placeholder="Digite aqui" minlength="12" maxlength="12" value="<?= $responsavel['rg'] ?>" required>
                </div>
                <div>
                    <label for="rg_menor">RG (Menor de Idade)</label>
                    <input type="text" id="rg_menor" name="rg_menor" placeholder="Digite aqui" minlength="12" maxlength="12" value="<?= $paciente['rg'] ?>" required>
                </div>
                <div>
                    <label for="dtNas_responsavel">Data de Nascimento (Responsável)</label>
                    <input type="date" id="dtNas_responsavel" name="dtNas_responsavel" value="<?= $responsavel['data_nascimento'] ?>" required>
                </div>
                <div>
                    <label for="dtNas_menor">Data de Nascimento (Menor de Idade)</label>
                    <input type="date" id="dtNas_menor" name="dtNas_menor" value="<?= $paciente['data_nascimento'] ?>" required>
                </div>
                <button type="button" class="button" onclick="window.location.href='usuariosCadastrados.php'">Voltar</button>
                <button type="submit" name="btn_editar_menor" value="Enviar" class="button">Editar</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>