<?php
include_once "FirebaseTable.php";

class FuncionarioTable extends FirebaseTable
{
    public function __construct()
    {
        $this->setTable("funcionario");
    }
}
