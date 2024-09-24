<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="userCad.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function carregarPacientes() {
            $.ajax({
                url: 'consultaPacientes.php',
                method: 'GET',
                success: function(data) {
                    $('#tabela-pacientes').html(data);
                },
                error: function() {
                    alert('Erro ao carregar pacientes.');
                }
            });
        }

        $(document).ready(function() {
            carregarPacientes();
        });
    </script>
</head>
<body>

    <div class="header">
        <a href="index.php"><button class="button">Voltar</button></a>
    </div>

    <div class="container">
        <h1>PACIENTES</h1>

        <table>
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>DATA DE NASCIMENTO</th>
                    <th>RESPONSAVEL</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabela-pacientes">
                
            </tbody>
        </table>
    </div>

</body>
</html>
