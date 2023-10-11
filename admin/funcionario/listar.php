<h3>Funcionário - Listar</h3>
<a class="btn btn-outline-primary float-right" href="?p=funcionario/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Professor ou Outro?</th>
        <th scope="col">Área/Salário</th>
        <th scope="col">Titulação/Cargo</th>
        <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../controles/FuncionarioTable.php';
        $conf = new FuncionarioTable();
        $dados = $conf->consultar();

        if (!empty($dados)) {
            foreach ($dados as $chave => $mostrar) {
        ?>
                <tr>
                    <td><?= $chave ?></td>
                    <td><?= $mostrar['nome'] ?></td>
                    <td><?= $mostrar['escolha'] ?></td>
                    <td><?= $mostrar['campo1'] ?></td>
                    <td><?= $mostrar['campo2'] ?></td>
                    <td>
                        <a href="?p=funcionario/salvar&id=<?= $chave ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=funcionario/excluir&id=<?= $chave ?>" class="btn btn-danger" data-confirm="Excluir">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>