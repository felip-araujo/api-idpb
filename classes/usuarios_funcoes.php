<?php
class Usuario_Funcoes
{
    private $pdo;
    public function __construct()
    {
        require_once './database/conexao.php';
        $this->pdo = $pdo;
    }
    public function listar()
    {
        $sql = $this->pdo->prepare("SELECT * FROM Usuario_Funcoes_X");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!$resultados) {
            throw new Exception("Nenhum registro no banco de dados.");
        }
        return $resultados;
    }

    public function id($parametros)
    {
        $param1 = $parametros[0];

        $sql = $this->pdo->prepare("SELECT * FROM Usuario_Funcoes_X WHERE ID_Usuario = :param1");
        $sql->bindParam(':param1', $param1);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!$resultados) {
            throw new Exception("Nenhum registro no banco de dados.");
        }
        return $resultados;
    }

    public function deletar_funcao($parametros)
    {
        if (isset($parametros[0]) && ($parametros[1])) {

            $param1 = $parametros[0];
            $param2 = $parametros[1];

            $sql = $this->pdo->prepare("DELETE FROM Usuario_Funcoes_X WHERE ID_Usuario = :param1 AND ID_Funcao = :param2");
            $sql->bindParam(':param1', $param1);
            $sql->bindParam(':param2', $param2);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $resultados = 'Função de usuario deletada com Sucesso!';
            } else {
                throw new Exception("a Função não foi deletada.");
            }

            return $resultados;
        }
    }
}
