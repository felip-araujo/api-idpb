<?php
class Membros
{
  public function listar()
  {
    require_once './database/conexao.php';
    $sql = $pdo->prepare("SELECT * FROM membros");
    $sql->execute();
    $retorno = array();

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
      $resultados[] = $row;
    }

    if (!$resultados) {

      throw new Exception("Nenhum Membro no Banco de Dados");
    }

    return $resultados;
  }


  public function id($parametros)
  {

    $param1 = $parametros[0];

    require_once './database/conexao.php';
    $sql = $pdo->prepare("SELECT * FROM membros WHERE id = :param1");
    $sql->bindParam(':param1', $param1);
    $sql->execute();
    $retorno = array();

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
      $resultados[] = $row;
    }

    if (!$resultados) {
      throw new Exception("Nenhum membro no banco de dados, com o id selecionado");
    }

    return $resultados;
  }

  public function deletar($parametros)
  {

    $param1 = $parametros[0];

    require_once './database/conexao.php';
    $sql = $pdo->prepare("DELETE FROM membros WHERE id = :param1");
    $sql->bindParam(':param1', $param1);
    if ($sql->execute()) {
      $resultados = "Membro deletado com sucesso!";
    } else {
      throw new Exception("Membro não deletado");
    }
    return $resultados;
  }
}
