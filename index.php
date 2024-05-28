<?php

header('Content-Type: application/json;');

require_once './classes/membros.php';
require_once './classes/lideranca.php';
require_once './classes/usuarios_funcoes.php';



class Rest
{
    public static function open($requisicao)
    {
        $url = explode('/', $_REQUEST['url']);
        $classe = $url[0];
        array_shift($url);

        $metodo = $url[0];
        array_shift($url);

        $parametros = array($url);




        try {
            if (class_exists($classe)) {
                if (method_exists($classe, $metodo)) {
                    $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
                    return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
                } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'metodo inexistente'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'classe inexistente'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
        }
    }
}

if (isset($_REQUEST)) {
    echo Rest::open($_REQUEST);
}
