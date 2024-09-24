<?php
require_once('cadastroAtendimento.php');
require_once('dbconnect.php');

$cpf = '';
$dtChegada = '';
$horaChegada = '';
$estado = '';
$gravidade = '';

if (isset($_POST['cpf'], $_POST['observacao'], $_POST['dt_chegada'], $_POST['hr_chegada'], $_POST['situacao'])) {
    $cpf = $_POST['cpf'];
    $dtChegada = $_POST['dt_chegada'];
    $horaChegada = $_POST['hr_chegada'];
    $estado = $_POST['observacao'];
    $gravidade = $_POST['situacao'];
}

if (isset($_POST['btn_cadastrar_atendimento'])) {
    try {
        $stmt = $conn->prepare("SELECT id, nome, data_nascimento FROM tb_paciente WHERE cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
            $tbPacientId = $paciente['id']; 
            $nomePaciente = $paciente['nome'];
            $dataNascimento = $paciente['data_nascimento']; 

            $stmtAtendimento = $conn->prepare("INSERT INTO tb_atendimento (tb_paciente_id, data_chegada, hora_chegada, estado, gravidade) 
                                               VALUES (:tbPacientId, :dtChegada, :horaChegada, :estado, :gravidade)");
            $stmtAtendimento->bindParam(":tbPacientId", $tbPacientId);
            $stmtAtendimento->bindParam(":dtChegada", $dtChegada);
            $stmtAtendimento->bindParam(":horaChegada", $horaChegada);
            $stmtAtendimento->bindParam(":estado", $estado);
            $stmtAtendimento->bindParam(":gravidade", $gravidade);
            $stmtAtendimento->execute();

            echo "<script>alert('Atendimento cadastrado com sucesso!'); window.location.href='atendimento.php';</script>";
        } else {
            echo "<script>alert('Paciente não encontrado! Verifique o CPF informado.'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
