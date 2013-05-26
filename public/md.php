<?php

require '../vendor/autoload.php';

abstract class Context {

    protected $data;

    protected static $availableContexts = [
        'text/html' => 'HTML',
        'application/json' => 'JSON',
        'application/javascript' => 'JSON',
    ];

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param $httpAccept
     * @param $data
     * @return Context
     */
    public static function getContext($httpAccept, $data){
        $acceptList = array_flip(array_map('trim', explode(',', $httpAccept)));
        foreach($acceptList as $context => $class){
            if(isset(self::$availableContexts[trim($context)])) {
                return new self::$availableContexts[$context]($data);
            }
        }

        return new self::$availableContexts['text/html']($data);
    }

    abstract function sendHeaders();
    abstract function output();
}

class JSON extends Context {
    function output()
    {
        $this->sendHeaders();
        $callbackPrefix = '';
        $callbackPostfix = '';

        if(isset($_GET['callback'])) {
            $callbackPrefix = $_GET['callback'] . '(';
            $callbackPostfix = ');';
        }

        return $callbackPrefix . json_encode($this->data) . $callbackPostfix;
    }

    function sendHeaders()
    {
        header("Content-Type: application/json");
    }
}

class HTML extends Context {
    function output()
    {
        $this->sendHeaders();
        return $this->data['output'];
    }

    function sendHeaders()
    {
        header("Content-Type: text/html");
    }
}

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        try {
            if(empty($_POST['md'])) {
                throw new InvalidArgumentException("Missing POST argument: md");
            }
            $success = true;
            $res = \Michelf\Markdown::defaultTransform($_POST['md']);
        }
        catch (Exception $e){
            echo "**";
            echo $e->getMessage();
        }
        break;
    default:
        try {
            if(empty($_GET['md'])) {
                throw new InvalidArgumentException("Missing GET argument: md");
            }
            $res = \Michelf\Markdown::defaultTransform($_GET['md']);
            $success = true;
        }
        catch (Exception $e){
            $success = false;
            $res = $e->getMessage();
        }
        break;
}


$data = array(
    'success' => $success,
    'output' => $res
);

$httpAccept = isset($_GET['json']) ? 'application/json' : $_SERVER['HTTP_ACCEPT'];
echo Context::getContext($httpAccept, $data)->output();
