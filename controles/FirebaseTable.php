<?php

abstract class FirebaseTable
{

    // sua url aqui
    private $firebaseURL = 'https://app2dsams-db1c2-default-rtdb.firebaseio.com/';
    //$firebaseSecret = 'AIzaSyBk9PeYKtGEVJU6AS7oNMWbgfc0lnvgeh0';
    //recebe ou envia o array

    private $table = "";

    private $jsonData;

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function getJsonData()
    {
        return $this->jsonData;
    }

    public function setJsonData($jsonData)
    {
        $this->jsonData = $jsonData;
    }

    public function salvar()
    {
        // Inicializa a sessão cURL e monta url completa
        $ch = curl_init($this->firebaseURL . $this->table . '.json');
        // Configura as opções da requisição POST
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Executa a requisição e obtém a resposta
        $resposta = curl_exec($ch);
        curl_close($ch);

        // Check the response
        return $resposta;
    }

    public function consultar()
    {
        // Inicializa a sessão cURL e monta url completa
        $ch = curl_init($this->firebaseURL . $this->table . '.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Executa a requisição e obtém a resposta
        $resposta = curl_exec($ch);
        curl_close($ch);
        // Decodifica os dados JSON da resposta para um array associativo
        return json_decode($resposta, true);
    }

    public function excluir($key)
    {
        // Inicializa a sessão cURL e monta url completa
        $node = $this->table . "/" . $key;
        $ch = curl_init($this->firebaseURL . $node . '.json');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Executa a requisição e obtém a resposta
        $resposta = curl_exec($ch);
        curl_close($ch);
        // Decodifica os dados JSON da resposta para um array associativo
        return $resposta;
    }

    public function editar($key)
    {
        // Inicializa a sessão cURL e monta url completa
        $node = $this->table . "/" . $key;
        $ch = curl_init($this->firebaseURL . $node . '.json');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Use "PUT" se quiser substituir todo o nó
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Executa a requisição e obtém a resposta
        $resposta = curl_exec($ch);
        curl_close($ch);
        // Decodifica os dados JSON da resposta para um array associativo
        return $resposta;
    }

    public function consultarPorID($key)
    {
        // Inicializa a sessão cURL e monta url completa
        $node = $this->table . "/" . $key;
        $ch = curl_init($this->firebaseURL . $node . '.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Executa a requisição e obtém a resposta
        $resposta = curl_exec($ch);
        curl_close($ch);
        // Decodifica os dados JSON da resposta para um array associativo
        return json_decode($resposta, true);
    }
}
