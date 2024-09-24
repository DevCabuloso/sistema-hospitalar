<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Atendimento</title>
    <link rel="stylesheet" href="cadMenor.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>        
        $(document).ready(function(){
            $('#cpf').mask('###.###.###-##');

            let agora = new Date();
            let dataAtual = agora.toISOString().split('T')[0];
            $('#dtChegada').val(dataAtual);
            let horaAtual = agora.toTimeString().split(':');
            let horaFormatada = `${horaAtual[0]}:${horaAtual[1]}`;
            $('#horaChegada').val(horaFormatada);
        });
    </script>
</head>
<body>

<header></header>

<div class="container">
    <div class="form-box">
        <h2>Cadastrar Atendimento</h2>
        <form action="cadAtendimento.php" method="POST">
            <div class="form-section">
                <div>
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Digite aqui" minlength="14" maxlength="14" required>
                </div>

                <div class="observation">
                    <label for="observacao">Descrição</label>
                    <textarea id="observacao" rows="3" name="observacao" placeholder="Observações adicionais..."></textarea>
                </div>

                <div>
                    <label for="dtChegada">Data Chegada</label>
                    <input type="date" id="dtChegada" name="dt_chegada" required>
                </div>
                <div>
                    <label for="horaChegada">Hora Chegada</label>
                    <input type="time" id="horaChegada" name="hr_chegada" required>
                </div>

                <div class="radio-group">
                    <label>SITUAÇÃO:</label>
                    <input type="radio" id="leve" name="situacao" value="leve" required>
                    <label for="leve">Leve</label>
                    <input type="radio" id="moderado" name="situacao" value="moderado">
                    <label for="moderado">Moderado</label>
                    <input type="radio" id="grave" name="situacao" value="grave">
                    <label for="grave">Grave</label>
                </div>

                <div class="buttons">
                    <button type="button" class="button" onclick="window.location.href='atendimento.php'">Voltar</button>
                    <button type="submit" name="btn_cadastrar_atendimento" value="Enviar" class="button">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
