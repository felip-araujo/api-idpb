<?php

header('Content-Type: application/json;');

require_once './classes/membros.php';
require_once './classes/lideranca.php';
require_once './classes/usuarios_funcoes.php';

// Função de autenticação básica
function authenticate() {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="My API"');
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(['status' => 'erro', 'dados' => 'Autenticação requerida.']);
        exit;
    } else {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        // Substitua 'seu_usuario' e 'sua_senha' pelas suas credenciais
        if ($username !== 'felp' || $password !== '159753') {
            header('HTTP/1.0 403 Forbidden');
            echo json_encode(['status' => 'erro', 'dados' => 'Credenciais inválidas.']);
            exit;
        }
    }
}

// Chama a função de autenticação no início do script
authenticate();

class Rest
{
    public static function open($requisicao)
    {
        $url = explode('/', $_REQUEST['url']);
        $classe = $url[0];
        array_shift($url);

        $metodo = $url[0];
        array_shift($url);

        $parametros = array();
        $parametros = $url;

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
