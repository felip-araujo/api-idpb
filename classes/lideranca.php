<?php
class Lideranca
{
    private $pdo;
    public function __construct()
    {
        require_once './database/conexao.php';
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $sql = $this->pdo->prepare("SELECT * FROM Usuarios_X");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!$resultados) {
            throw new Exception("Nenhum Membro no Banco de Dados");
        }
        return $resultados;
    }

    public function id($parametros)
    {
        $param1 = $parametros[0];

        $sql = $this->pdo->prepare("SELECT * FROM Usuarios_X WHERE ID_Usuario = :param1");
        $sql->bindParam(':param1', $param1);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if(!$resultados) {
            throw new Exception("Nenhum Membro no Banco de Dados, com este ID");
        } 
        return $resultados;
    }

    public function nome($parametros)
    { 
        $param1 = $parametros[0];

        $sql = $this->pdo->prepare("SELECT Nome FROM Usuarios_X WHERE ID_Usuario = :param1");
        $sql->bindParam(':param1', $param1);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if(!$resultados) {
            throw new Exception("Nenhum Membro no Banco de Dados, com este ID");
        } 
        return $resultados;
    }
}
