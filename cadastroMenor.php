<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Menor de Idade</title>
    <link rel="stylesheet" href="cadMenor.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>        
        $(document).ready(function(){
            $('#cpf_responsavel, #cpf_menor').mask('###.###.###-##');
            $('#rg_responsavel, #rg_menor').mask('##.###.###-#');
        });
    </script>
</head>
<body>

<header></header>

<div class="container">
    <div class="form-box">
        <h2>Informações do Responsável e do Menor</h2>
        <form action="cadPacienteMenor.php" method="POST">
            <div class="form-section">
                <div>
                    <label for="nome_responsavel">Nome (Responsável)</label>
                    <input type="text" id="nome_responsavel" name="nome_responsavel" placeholder="Digite aqui" required>
                </div>
                <div>
                    <label for="nome_menor">Nome (Menor de Idade)</label>
                    <input type="text" id="nome_menor" name="nome_menor" placeholder="Digite aqui" required>
                </div>
                <div>
                    <label for="cpf_responsavel">CPF (Responsável)</label>
                    <input type="text" id="cpf_responsavel" name="cpf_responsavel" placeholder="Digite aqui" minlength="14" maxlength="14" required>
                </div>
                <div>
                    <label for="cpf_menor">CPF (Menor de Idade)</label>
                    <input type="text" id="cpf_menor" name="cpf_menor" placeholder="Digite aqui" minlength="14" maxlength="14" required>
                </div>
                <div>
                    <label for="rg_responsavel">RG (Responsável)</label>
                    <input type="text" id="rg_responsavel" name="rg_responsavel" placeholder="Digite aqui" minlength="12" maxlength="12" required>
                </div>
                <div>
                    <label for="rg_menor">RG (Menor de Idade)</label>
                    <input type="text" id="rg_menor" name="rg_menor" placeholder="Digite aqui" minlength="12" maxlength="12" required>
                </div>
                <div>
                    <label for="dtNas_responsavel">Data de Nascimento (Responsável)</label>
                    <input type="date" id="dtNas_responsavel" name="dtNas_responsavel" required>
                </div>
                <div>
                    <label for="dtNas_menor">Data de Nascimento (Menor de Idade)</label>
                    <input type="date" id="dtNas_menor" name="dtNas_menor" required>
                </div>

            <div class="buttons">
                <button type="button" class="button" onclick="window.location.href='index.php'">Voltar</button>
                <button type="submit" name="btn_cadastrar_menor" value="Enviar" class="button">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
