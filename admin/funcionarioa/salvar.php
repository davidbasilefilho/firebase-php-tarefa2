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
        $email = $data['email'];
        $idade = $data['idade'];
    } else {
        echo "Registro não encontrado ou não existe.";
    }
}
?>
<h3>Funcionario - <?= isset($id) ? 'Editar' : 'Cadastrar' ?></h3>
<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">
    <div class="form-group">
        <label># <?= $id ?></label>
    </div>
    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe seu nome" name="txtnome" value="<?= isset($id) ? $nome : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">E-mail</label>
        <input type="email" class="form-control" id="exampleInputText" placeholder="Informe a descrição da categoria" name="txtemail" value="<?= isset($id) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Idade</label>
        <input type="number" class="form-control" id="exampleInputText" name="txtidade" value="<?= isset($id) ? $idade : '' ?>">
    </div>
    <div class="form-group col-sm-4">
        <input type="submit" class="btn btn-<?= isset($id) ? 'success' : 'primary' ?>" name="<?= isset($id) ? 'btneditar' : 'btnsalvar' ?>" value="<?= isset($id) ? 'Editar' : 'Cadastrar' ?>">
        <a class="btn btn-danger " href="?p=firebase/listar"><i class="bi bi-arrow-bar-left"></i></a>
    </div>


</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');
    $idade = filter_input(INPUT_POST, 'txtidade');
    // Data to be stored in the database
    $dados = array(
        'nome' => $nome,
        'email' => $email,
        'idade' => $idade
    );

    $conf->setJsonData(json_encode($dados));
    $msg = $conf->salvar() === true ? 'Dados salvos com sucesso - Firebase.' : 'Erro';

    //var_dump($conf->getJsonData());

    echo '<div class="alert alert-primary mt-3" role="alert>"'
        . $msg
        . '</div>';

    echo '<meta http-equiv="refresh" content="0.3;URL=?p=firebase/listar">';
}

if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');
    $idade = filter_input(INPUT_POST, 'txtidade');
    // Data to be stored in the database
    $dados = array(
        'nome' => $nome,
        'email' => $email,
        'idade' => $idade
    );

    $conf->setJsonData(json_encode($dados));
    $msg = $conf->editar($id) === 'null' ? 'Dados editados com sucesso - Firebase.' : 'Erro';

    //var_dump($conf->getJsonData());

    echo '<div class="alert alert-danger mt-3" role="alert>"'
        . $msg
        . '</div>';

    echo '<meta http-equiv="refresh" content="0.3;URL=?p=firebase/listar">';
}
