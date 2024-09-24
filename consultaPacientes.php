<?php
require_once('dbconnect.php');

try {
    // Consulta os dados dos pacientes e atendimento
    $stmt = $conn->prepare("SELECT p.id, p.nome, p.cpf, p.rg, p.data_nascimento, IFNULL(r.nome, 'Não precisa de responsável, maior de 18 anos') nome_responsavel, r.id id_responsavel
                           FROM tb_paciente p
                           LEFT JOIN tb_responsavel r ON p.id = r.tb_paciente_id");
    $stmt->execute();

    // Verifica se há pacientes
    if ($stmt->rowCount() > 0) {
        // Itera sobre os resultados e cria as linhas da tabela
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['rg'] . "</td>";
            echo "<td>" . $row['data_nascimento'] . "</td>";
            echo "<td>" . $row['nome_responsavel'] . "</td>";
            
            if (is_null($row['id_responsavel'])) {
                echo "<td><a href='editarPacienteMaior.php?id=" . $row['id'] . "'><button class='buttons'>Editar</button></a></td>";
            } else {
                echo "<td><a href='editarPacienteMenor.php?id=" . $row['id'] . "'><button class='buttons'>Editar</button></a></td>";
            }

            echo "<td><a href='relatorio.php?id=" . $row['id'] . "'><button class='buttons'>Relatorio</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Nenhum paciente encontrado.</td></tr>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
