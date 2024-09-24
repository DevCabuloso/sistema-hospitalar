<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente Maior</title>
    <link rel="stylesheet" href="cadMaior.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>        
        $(document).ready(function(){
            $('#cpf_paciente').mask('###.###.###-##');
            $('#rg_paciente').mask('##.###.###-#');
        });
    </script>
</head>
<body>

<header></header>

<div class="container">
    <div class="form-box">
        <h2>Informações do Paciente</h2>

        <form action="cadPacienteMaior.php" method="POST">
            <div class="form-section">
                <div>
                    <label for="nome_paciente">Nome</label>
                    <input type="text" id="nome_paciente" name="nome_paciente" placeholder="Digite aqui" required>
                </div>
                <div>
                    <label for="dtNas_paciente">Data de Nascimento</label>
                    <input type="date" id="dtNas_paciente" name="dtNas_paciente" placeholder="Digite aqui" required>
                </div>
                <div>
                    <label for="cpf_paciente">CPF</label>
                    <input type="text" id="cpf_paciente" name="cpf_paciente" placeholder="Digite aqui" minlength="14" maxlength="14" required>
                </div>
                <div>
                    <label for="rg_paciente">RG</label>
                    <input type="text" id="rg_paciente" name="rg_paciente" placeholder="Digite aqui" minlength="12" maxlength="12" required>
                </div>
            <div class="buttons">
                <button type="button" class="button" onclick="window.location.href='index.php'">Voltar</button>
                <button type="submit" name="btn_cadastrar_maior" value="Enviar" class="button">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
