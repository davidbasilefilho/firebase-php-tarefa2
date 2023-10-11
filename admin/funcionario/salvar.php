<?php
//capturar o id da url
$id = filter_input(INPUT_GET, 'id');
//comunicação com class Categoria
include_once '../controles/FuncionarioTable.php';
$conf = new FuncionarioTable();

if (isset($id)) {
    $data = $conf->consultarPorID($id);
    if ($data !== null) {
        $nome = $data['nome'];
        $escolha = $data['escolha'];
        $campo1 = $data['campo1'];
        $campo2 = $data['campo2'];
    } else {
        echo "Registro não encontrado ou não existe.";
    }
}
?>
<h3>Funcionário - Cadastrar</h3>
<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">
    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe seu nome" name="txtnome" value="<?= isset($data) ? $nome : "" ?>">
    </div>

    <div class="form-group">
        <label>Professor ou Outro?</label>
        <input type="radio" name="escolha" id="professor" value="Professor" <?php if (isset($data)) {
                                                                                echo $escolha === "Professor" ? "checked" : "";
                                                                            } else {
                                                                                echo "checked";
                                                                            } ?>>
        <label for="professor">Professor</label>
        <input type="radio" name="escolha" id="outro" value="Outro" <?php if (isset($data)) {
                                                                        echo $escolha === "Outro" ? "checked" : "";
                                                                    } ?>>
        <label for="outro">Outro</label>
    </div>

    <div id="sel_professor">
        <div class="form-group">
            <label for="exampleInputText">Área</label>
            <input type="text" class="form-control" id="exampleInputText" name="txtarea" value="<?php if (isset($data)) {
                                                                                                    echo $escolha === "Professor" ? $campo1 : "";
                                                                                                } ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputText">Titulação</label>
            <select class="form-control" id="exampleInputText" name="txttitulacao">
                <option value="Licenciatura" <?php if (isset($data)) {
                                                    echo $escolha === "Professor" && $campo2 === "Licenciatura" ? "selected" : "";
                                                } else {
                                                    echo "selected";
                                                } ?>>Licenciatura</option>

                <option value="Pós Graduação" <?php if (isset($data)) {
                                                    echo $escolha === "Professor" && $campo2 === "Pós Graduação" ? "selected" : "";
                                                } ?>>Pós Graduação</option>

                <option value="Mestrado" <?php if (isset($data)) {
                                                echo $escolha === "Professor" && $campo2 === "Mestrado" ? "selected" : "";
                                            } ?>>Mestrado</option>
            </select>
        </div>
    </div>

    <div id="sel_outro">
        <div class="form-group">
            <label for="exampleInputText">Salário</label>
            <input type="number" class="form-control" id="exampleInputText" name="txtsalario" value="<?php if (isset($data)) {
                                                                                                            echo $escolha === 'Outro' ? $campo1 : '';
                                                                                                        } ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputText">Cargo</label>
            <select class="form-control" name="txtcargo" id="txtcargo">
                <option value="Coordenador" <?php if (isset($data) && $escolha === "Outro" && $campo2 === "Coordenador") {
                                                echo "selected";
                                            } else if (!isset($data)) {
                                                echo "";
                                            } ?>>Coordenador</option>

                <option value="Diretor" <?php if (isset($data) && $escolha === "Outro" && $campo2 === "Diretor") {
                                            echo "selected";
                                        } ?>>Diretor</option>

                <option value="Limpeza" <?php if (isset($data) && $escolha === "Outro" && $campo2 === "Limpeza") {
                                            echo "selected";
                                        } ?>>Limpeza</option>
            </select>
        </div>

    </div>

    <div class="form-group col-sm-4">
        <input type="submit" class="btn btn-primary" name="btnsalvar" value="Cadastrar">
    </div>


</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $escolha = filter_input(INPUT_POST, "escolha");

    if ($escolha === "Professor") {
        $campo1 = filter_input(INPUT_POST, 'txtarea');
        $campo2 = filter_input(INPUT_POST, 'txttitulacao');
    } else if ($escolha === "Outro") {
        $campo1 = filter_input(INPUT_POST, 'txtsalario');
        $campo2 = filter_input(INPUT_POST, 'txtcargo');
    }
    $nome = filter_input(INPUT_POST, 'txtnome');

    // Data to be stored in the database
    $dados = [
        'nome' => $nome,
        "escolha" => $escolha,
        'campo1' => $campo1,
        'campo2' => $campo2
    ];

    include_once '../controles/FuncionarioTable.php';
    if (!isset($conf))
        $conf = new FuncionarioTable();

    $conf->setJsonData(json_encode($dados));

    $msg = "";

    if (isset($id)) {
        $msg = $conf->editar($id) === true ? 'Erro' : 'Dados editados com sucesso - Funcionário.';
    } else {
        $msg = $conf->salvar() === true ? 'Erro' : 'Dados salvos com sucesso - Funcionário.';
    }

    //var_dump($conf->getJsonData());

    echo '<div class="alert alert-primary mt-3" role="alert>"'
        . $msg
        . '</div>';

    //echo '<meta http-equiv="refresh" content="0.3;URL=?p=funcionario/listar">';
}
