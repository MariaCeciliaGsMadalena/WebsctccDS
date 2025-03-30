<?php
// Definir os níveis de urgência e suas datas disponíveis
$urgencias = [
    'Baixa' => [
        'disponibilidade' => ['2025-03-28', '2025-03-29', '2025-03-30'],
    ],
    'Média' => [
        'disponibilidade' => ['2025-03-26', '2025-03-27', '2025-03-28'],
    ],
    'Alta' => [
        'disponibilidade' => ['2025-03-25', '2025-03-26'],
    ],
];

// Função para exibir o formulário de agendamento
function exibirFormulario($urgencias) {
    // Recupera os valores enviados via POST, se existirem
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $parentesco = isset($_POST['parentesco']) ? $_POST['parentesco'] : '';
    $idade = isset($_POST['idade']) ? $_POST['idade'] : '';
    $motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
    $rg = isset($_POST['rg']) ? $_POST['rg'] : '';
    $nivelUrgenciaSelecionado = isset($_POST['urgencia']) ? $_POST['urgencia'] : '';
    $dataSelecionada = isset($_POST['data']) ? $_POST['data'] : '';

    echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agendamento de Consulta</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f8ff;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%;
                margin: 0 auto;
                padding: 20px;
                background-color: #e6f7ff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            h1 {
                text-align: center;
                color: #007bff;
            }
            select, input[type="text"], input[type="number"], input[type="submit"], textarea {
                padding: 10px;
                margin: 10px 0;
                border-radius: 4px;
                border: 1px solid #ccc;
                width: 100%;
                box-sizing: border-box;
            }
            .urgencia-label, .campo-label {
                font-size: 16px;
                font-weight: bold;
            }
            .disponibilidade {
                margin-top: 10px;
            }
            .disponibilidade label {
                margin-right: 10px;
            }
            .disponibilidade input[type="radio"] {
                margin-right: 5px;
            }
            footer {
                text-align: center;
                font-size: 14px;
                padding: 10px;
                background-color: #007bff;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Agendamento de Consulta</h1>
            <form action="" method="POST">
                
                <!-- Campos de informações pessoais -->
                <label for="nome" class="campo-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="' . $nome . '" required>
                
                <label for="parentesco" class="campo-label">Parentesco:</label>
                <input type="text" name="parentesco" id="parentesco" value="' . $parentesco . '" required>
                
                <label for="idade" class="campo-label">Idade:</label>
                <input type="number" name="idade" id="idade" value="' . $idade . '" required>
                
                <label for="motivo" class="campo-label">Motivo da Consulta:</label>
                <textarea name="motivo" id="motivo" rows="4" required>' . $motivo . '</textarea>

                <label for="rg" class="campo-label">RG:</label>
                <input type="text" name="rg" id="rg" value="' . $rg . '" required>

                <!-- Escolha do nível de urgência -->
                <label for="urgencia" class="urgencia-label">Escolha o nível de urgência:</label>
                <select name="urgencia" id="urgencia" required>
                    <option value="">Selecione...</option>';

    // Exibir opções de urgência, marcando a selecionada
    foreach ($urgencias as $nivel => $dados) {
        $selected = ($nivel == $nivelUrgenciaSelecionado) ? 'selected' : '';
        echo "<option value=\"$nivel\" $selected>$nivel</option>";
    }

    echo '</select>';

    // Se uma urgência for selecionada, exibe as datas disponíveis
    if ($nivelUrgenciaSelecionado) {
        echo '<div class="disponibilidade">';
        echo '<p>Escolha a data disponível para consulta:</p>';

        foreach ($urgencias[$nivelUrgenciaSelecionado]['disponibilidade'] as $data) {
            $checked = ($data == $dataSelecionada) ? 'checked' : '';
            echo '<label><input type="radio" name="data" value="' . $data . '" required ' . $checked . '>' . $data . '</label>';
        }

        echo '</div>';
    }

    echo '<input type="submit" value="Agendar Consulta">
        </form>';

    // Se a consulta foi agendada, exibe os detalhes
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
        echo '<div class="container">
                <p><strong>Consulta agendada com sucesso!</strong></p>
                <p>Nome: ' . $nome . '</p>
                <p>Parentesco: ' . $parentesco . '</p>
                <p>Idade: ' . $idade . '</p>
                <p>Motivo da Consulta: ' . $motivo . '</p>
                <p>RG: ' . $rg . '</p>
                <p>Urgência: ' . $_POST['urgencia'] . '</p>
                <p>Data escolhida: ' . $_POST['data'] . '</p>
              </div>';
    }

    echo '<footer>Hospital Online - 2025</footer>
    </body>
    </html>';
}

// Exibir o formulário de agendamento
exibirFormulario($urgencias);
?>
