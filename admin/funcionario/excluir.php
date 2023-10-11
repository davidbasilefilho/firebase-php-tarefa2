<?php
$id = filter_input(INPUT_GET, 'id');
include_once '../controles/FuncionarioTable.php';
$conf = new FuncionarioTable();
if ($conf->excluir($id) === 'null') {
?>
    <div class="alert alert-primary" role="alert">
        Excluído com sucesso
    </div>
<?php
} else {
?>
    <div class="alert alert-danger" role="alert">
        Erro ao excluir.
    </div>
<?php
}
?>
<meta http-equiv="refresh" content="0.3;URL=?p=funcionario/listar">