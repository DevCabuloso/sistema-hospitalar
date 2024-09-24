<?php
require_once('dbconnect.php');

$nomeMenor = '';
$cpfMenor = '';
$rgMenor = '';
$dtNascimentoMenor = '';
$nomeResponsavel = '';
$cpfResponsavel = '';
$rgResponsavel = '';
$dtNascimentoResponsavel = '';

if (isset($_POST['id_paciente'], $_POST['nome_menor'], $_POST['cpf_menor'], $_POST['rg_menor'], $_POST['dtNas_menor'], $_POST['nome_responsavel'], $_POST['cpf_responsavel'], $_POST['rg_responsavel'], $_POST['dtNas_responsavel'])) {
    $idPaciente = $_POST['id_paciente'];
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
if (isset($_POST['btn_editar_menor'])) {
    try {
        // UPDATE na tabela tb_paciente
        $stmt = $conn->prepare("UPDATE tb_paciente SET nome = :nomeMenor, data_nascimento = :dtNascimentoMenor, cpf = :cpfMenor, rg = :rgMenor WHERE id = :idPaciente");
        $stmt->bindParam(":nomeMenor", $nomeMenor);
        $stmt->bindParam(":dtNascimentoMenor", $dtNascimentoMenor);
        $stmt->bindParam(":cpfMenor", $cpfMenor);
        $stmt->bindParam(":rgMenor", $rgMenor);
        $stmt->bindParam(":idPaciente", $idPaciente);
        $stmt->execute();

        // UPDATE na tabela tb_responsavel
        $stmt2 = $conn->prepare("UPDATE tb_responsavel SET nome = :nomeResponsavel, data_nascimento = :dtNascimentoResponsavel, cpf = :cpfResponsavel, rg = :rgResponsavel WHERE tb_paciente_id = :idPaciente");
        $stmt2->bindParam(":nomeResponsavel", $nomeResponsavel);
        $stmt2->bindParam(":dtNascimentoResponsavel", $dtNascimentoResponsavel);
        $stmt2->bindParam(":cpfResponsavel", $cpfResponsavel);
        $stmt2->bindParam(":rgResponsavel", $rgResponsavel);
        $stmt2->bindParam(":idPaciente", $idPaciente);
        $stmt2->execute();

        // Mensagem de sucesso (opcional)
        echo "<script>alert('Paciente atualizado com sucesso!'); window.location.href='usuariosCadastrados.php';</script>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
