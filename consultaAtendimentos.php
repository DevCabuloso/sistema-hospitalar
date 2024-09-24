<?php
require_once('dbconnect.php');

$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

try {
    if (!empty($cpf)) {
        $stmt = $conn->prepare("SELECT p.nome, p.cpf, a.estado, a.gravidade, a.data_chegada, a.hora_chegada
                               FROM tb_atendimento a
                               INNER JOIN tb_paciente p ON a.tb_paciente_id = p.id
                               WHERE p.cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['cpf'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                echo "<td>" . ($row['gravidade'] == 'L' ? 'Leve' : ($row['gravidade'] == 'M' ? 'Moderado' : 'Grave')) . "</td>";
                echo "<td>" . $row['data_chegada'] . "</td>";
                echo "<td>" . $row['hora_chegada'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum paciente encontrado.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Por favor, insira um CPF para buscar o paciente.</td></tr>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
