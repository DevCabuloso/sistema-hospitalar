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

    // Consultar o último atendimento
    $stmtAtendimento = $conn->prepare("SELECT p.nome, p.cpf, a.estado, a.gravidade, a.data_chegada, a.hora_chegada
                                        FROM tb_atendimento a
                                        INNER JOIN tb_paciente p ON a.tb_paciente_id = p.id
                                        WHERE p.id = :id
                                        ORDER BY a.data_chegada DESC, a.hora_chegada DESC LIMIT 1");
    $stmtAtendimento->bindParam(":id", $id);
    $stmtAtendimento->execute();
    $atendimento = $stmtAtendimento->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}

function formatarDataHora($data, $hora) {
    $dataFormatada = DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y');
    $horaFormatada = DateTime::createFromFormat('H:i:s', $hora)->format('H:i');
    return [$dataFormatada, $horaFormatada];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Paciente</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="relatorio.css">
</head>
<body>
    <div class="header">
        <h1>Relatório e estatísticas de paciente</h1>
    </div>

    <div class="container">
        <h2>RELATÓRIO DE PACIENTE</h2>

        <div class="content" id="relatorioContent">
            <div class="info-box">
                <div class="personal-info">
                    <h3>INFORMAÇÕES DO PACIENTE</h3>
                    <p>Nome: <span><?= $paciente['nome'] ?></span></p>
                    <p>RG: <span><?= $paciente['rg'] ?></span></p>
                    <p>CPF: <span><?= $paciente['cpf'] ?></span></p>
                    <p>Data de nascimento: <span>
                        <?php 
                        // Formatar a data de nascimento do paciente
                        list($dataNascimentoFormatada, ) = formatarDataHora($paciente['data_nascimento'], '00:00:00');
                        echo $dataNascimentoFormatada; 
                        ?>
                    </span></p>
                </div>
                <div class="technical-info">
                    <h3>INFORMAÇÕES DO RESPONSÁVEL</h3>
                    <?php if ($responsavel): ?>
                        <p>Nome: <span><?= $responsavel['nome'] ?></span></p>
                        <p>RG: <span><?= $responsavel['rg'] ?></span></p>
                        <p>CPF: <span><?= $responsavel['cpf'] ?></span></p>
                        <p>Data de nascimento: <span>
                            <?php 
                            // Formatar a data de nascimento do responsável
                            list($dataNascimentoResponsavelFormatada, ) = formatarDataHora($responsavel['data_nascimento'], '00:00:00');
                            echo $dataNascimentoResponsavelFormatada; 
                            ?>
                        </span></p>
                    <?php else: ?>
                        <p>Nenhum responsável encontrado para este paciente.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="observation-box">
                <h3>ÚLTIMO ATENDIMENTO:</h3>
                <?php if ($atendimento): 
                    list($dataFormatada, $horaFormatada) = formatarDataHora($atendimento['data_chegada'], $atendimento['hora_chegada']); ?>
                    <p>Nome do Paciente: <span><?= $atendimento['nome'] ?></span></p>
                    <p>CPF: <span><?= $atendimento['cpf'] ?></span></p>
                    <p>Estado: <span><?= $atendimento['estado'] ?></span></p>
                    <p>Gravidade: <span>
                        <?= $atendimento['gravidade'] == 'L' ? 'Leve' : ($atendimento['gravidade'] == 'M' ? 'Moderado' : 'Grave') ?>
                    </span></p>
                    <p>Data de Chegada: <span><?= $dataFormatada ?></span></p>
                    <p>Hora de Chegada: <span><?= $horaFormatada ?></span></p>
                <?php else: ?>
                    <p>Nenhum atendimento encontrado para este paciente.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <button type="button" class="button" onclick="window.location.href='usuariosCadastrados.php'">Voltar</button>
    </div>

</body>
</html>
