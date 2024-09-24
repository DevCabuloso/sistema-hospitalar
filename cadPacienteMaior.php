<?php
require_once('cadastroMaior.php');
require_once('dbconnect.php');

$nomePaciente = '';
$dtNascimento = '';
$cpfPaciente = '';
$rgPaciente = '';

if (isset($_POST['nome_paciente'], $_POST['dtNas_paciente'], $_POST['cpf_paciente'], $_POST['rg_paciente'])) {
    $nomePaciente = $_POST['nome_paciente'];
    $dtNascimento = $_POST['dtNas_paciente'];
    $cpfPaciente = $_POST['cpf_paciente'];
    $rgPaciente = $_POST['rg_paciente'];
}

// Verificação do botão
if (isset($_POST['btn_cadastrar_maior'])) {
    try {
        // INSERT na tabela tb_paciente
        $stmt = $conn->prepare("INSERT INTO tb_paciente (nome, data_nascimento, cpf, rg) VALUES (:nome_paciente, :dt_nascimento, :cpf_paciente, :rg_paciente)");
        $stmt->bindParam(":nome_paciente", $nomePaciente);
        $stmt->bindParam(":dt_nascimento", $dtNascimento);
        $stmt->bindParam(":cpf_paciente", $cpfPaciente);
        $stmt->bindParam(":rg_paciente", $rgPaciente);
        $stmt->execute();

        // Mensagem de sucesso (opcional)
        echo "<script>alert('Paciente cadastrado com sucesso!'); window.location.href='usuariosCadastrados.php';</script>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
