<?php
//seta o site para o horário e data regionais
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once 'cabecalho.php'; ?>
    </head>
    <body>
        <?php include_once 'navbar.php'; ?>
        <div class = "row m-5">
            <div class = "col-12">
                <?php
                $pagina = filter_input(INPUT_GET, 'p');
                if (empty($pagina) || $pagina == "index") {
                    include_once 'pagina-inicial.php';
                } else {
                    if (file_exists($pagina . '.php')) {
                        include_once $pagina . '.php';
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Erro 404, página não encontrada!                                      
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include_once 'scripts.php'; ?>
</body>
</html>