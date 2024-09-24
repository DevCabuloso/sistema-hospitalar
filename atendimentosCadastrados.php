<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimentos Cadastrados</title>
    <link rel="stylesheet" href="userCad.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>        
        $(document).ready(function(){
            $('#cpf').mask('###.###.###-##');
        });

        function carregarPacientes(cpf = '') {
            $.ajax({
                url: 'consultaAtendimentos.php',
                method: 'GET',
                data: { cpf: cpf },
                success: function(data) {
                    $('#tabela-atendimentos').html(data);
                },
                error: function() {
                    alert('Erro ao carregar pacientes.');
                }
            });
        }

        $(document).ready(function() {
            carregarPacientes();

            // Ação para o botão de pesquisa
            $('#btn-pesquisar').click(function() {
                var cpf = $('#cpf').val();
                carregarPacientes(cpf);
            });
        });
    </script>
</head>
<body>
    <div class="header">
        <a href="atendimento.php"><button class="button">Voltar</button></a>
    </div>

    <div class="container">
        <h1>ATENDIMENTOS</h1>

        <div class="cpf-search">
            <input type="text" id="cpf" placeholder="Digite o CPF para pesquisar" maxlength="14">
            <button id="btn-pesquisar">PESQUISAR</button>
        </div>

        <br>

        <table>
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>Descrição</th>
                    <th>SITUAÇÃO</th>
                    <th>Data Chegada</th>
                    <th>Hora Chegada</th>
                </tr>
            </thead>
            <tbody id="tabela-atendimentos">

            </tbody>
        </table>
    </div>

</body>
</html>
