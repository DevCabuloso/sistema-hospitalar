<?php
require_once('dbconnect.php');

$nomePaciente = '';
$dtNascimento = '';
$cpfPaciente = '';
$rgPaciente = '';

if (isset($_POST['id_paciente'], $_POST['nome_paciente'], $_POST['dtNas_paciente'], $_POST['cpf_paciente'] , $_POST['rg_paciente'])) {
    $idPaciente = $_POST['id_paciente'];
    $nomePaciente = $_POST['nome_paciente'];
    $dtNascimento = $_POST['dtNas_paciente'];
    $cpfPaciente = $_POST['cpf_paciente'];
    $rgPaciente = $_POST['rg_paciente'];
}

// Verificação do botão
if (isset($_POST['btn_editar_maior'])) {
    try {
        $stmt = $conn->prepare("UPDATE tb_paciente SET nome = :nome_paciente, data_nascimento = :dt_nascimento, cpf = :cpf_paciente, rg = :rg_paciente WHERE id = :id_paciente");
            $stmt->bindParam(":id_paciente", $idPaciente);
            $stmt->bindParam(":nome_paciente", $nomePaciente);
            $stmt->bindParam(":dt_nascimento", $dtNascimento);
            $stmt->bindParam(":cpf_paciente", $cpfPaciente);
            $stmt->bindParam(":rg_paciente", $rgPaciente);
            $stmt->execute();

        echo "<script>alert('Paciente editado com sucesso!'); window.location.href='usuariosCadastrados.php';</script>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

