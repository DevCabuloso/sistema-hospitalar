<?php
require_once('cadastroMenor.php');
require_once('dbconnect.php');

$nomeMenor = '';
$cpfMenor = '';
$rgMenor = '';
$dtNascimentoMenor = '';
$nomeResponsavel = '';
$cpfResponsavel = '';
$rgResponsavel = '';
$dtNascimentoResponsavel = '';

if (isset($_POST['nome_menor'], $_POST['cpf_menor'], $_POST['rg_menor'], $_POST['dtNas_menor'], $_POST['nome_responsavel'], $_POST['cpf_responsavel'], $_POST['rg_responsavel'], $_POST['dtNas_responsavel'])) {
    $nomeMenor = $_POST['nome_menor'];
    $cpfMenor = $_POST['cpf_menor'];
    $rgMenor = $_POST['rg_menor'];
    $dtNascimentoMenor = $_POST['dtNas_menor'];
    $nomeResponsavel = $_POST['nome_responsavel']; 
    $cpfResponsavel = $_POST['cpf_responsavel'];
    $rgResponsavel = $_POST['rg_responsavel'];
    $dtNascimentoResponsavel = $_POST['dtNas_responsavel'];
}

// Verificação do botão
if (isset($_POST['btn_cadastrar_menor'])) {
    try {
        // INSERT na tabela tb_paciente
        $stmt = $conn->prepare("INSERT INTO tb_paciente (nome, data_nascimento, cpf, rg) VALUES (:nomeMenor, :dtNascimentoMenor, :cpfMenor, :rgMenor)");
        $stmt->bindParam(":nomeMenor", $nomeMenor);
        $stmt->bindParam(":dtNascimentoMenor", $dtNascimentoMenor);
        $stmt->bindParam(":cpfMenor", $cpfMenor);
        $stmt->bindParam(":rgMenor", $rgMenor);
        $stmt->execute();

        // Obtendo o ID do paciente recém-inserido
        $pacienteId = $conn->lastInsertId();

        // INSERT na tabela tb_atendimento
        $stmt2 = $conn->prepare("INSERT INTO tb_responsavel (tb_paciente_id, nome, data_nascimento, cpf, rg) VALUES (:pacienteId, :nomeResponsavel, :dtNascimentoResponsavel, :cpfResponsavel, :rgResponsavel)");
        $stmt2->bindParam(":pacienteId", $pacienteId);
        $stmt2->bindParam(":nomeResponsavel", $nomeResponsavel);
        $stmt2->bindParam(":dtNascimentoResponsavel", $dtNascimentoResponsavel);
        $stmt2->bindParam(":cpfResponsavel", $cpfResponsavel);
        $stmt2->bindParam(":rgResponsavel", $rgResponsavel);
        $stmt2->execute();

        // Mensagem de sucesso (opcional)
        echo "<script>alert('Paciente cadastrado com sucesso!'); window.location.href='usuariosCadastrados.php';</script>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
