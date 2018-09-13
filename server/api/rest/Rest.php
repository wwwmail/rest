<?php

//namespace rest;

class Rest
{

    private $url;
    private $method;
    private $class;
    public $_content_type = "application/json";
    private $_code = 200;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function response($data, $status = 200)
    {
        //var_dump($data); die;
        $this->_code = ($status) ? $status : 200;
        $this->set_headers();
        echo $this->json($data);
    }

    private function get_status_message()
    {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return ($status[$this->_code]) ? $status[$this->_code] : $status[500];
    }

    private function set_headers()
    {
        header("HTTP/1.1 " . $this->_code . " " . $this->get_status_message());
        header("Content-Type:" . $this->_content_type);
    }

    public function setMethodApi()
    {

      //  list($a, $d, $db, $table, $path) = explode('/', $this->url, 6);
         list($a, $b, $c, $d, $e, $db, $table, $path) = explode('/', $this->url, 8);

//var_dump($table); die; 

        switch ($this->method) {
            case 'GET':

                $this->setMethod($table, 'get' . ucfirst($table), explode('/', $path));
                break;
            case 'DELETE':
                $this->setMethod($table, 'delete' . ucfirst($table), explode('/', $path));
                break;
            case 'POST':
                //var_dump($_POST); die;
                $this->setMethod($table, 'post' . ucfirst($table), $this->cleanInputs($_POST));
                break;
            case 'PUT':
                $this->setMethod($table, 'put' . ucfirst($table), explode('/', $path));
                break;
            default:
                $this->response('', 406);
                return false;
        }
    }

    private function setMethod($class, $methodName, $data = array())
    {
        
        //var_dump($data);die;

        //var_dump($data); die;
//echo  __DIR__.'/'.mb_strtolower($class).'/../'.ucfirst($class).'.php'; die;

        if (file_exists(__DIR__ . '/../' . mb_strtolower($class) . '/' . ucfirst($class) . '.php')) {

            $this->class = ucfirst($class);
        } else {

            echo 'error this class does not exist';
            die;
        }

        // require_once __DIR__.'/'.mb_strtolower($class).'/'.ucfirst($class).'.php';

        $this->class = new $this->class;



        if (strstr($data[0], 'filter?')) {

            $methodName .= 'Filter';

            $data = $this->cleanInputs($_GET);
        }elseif (!empty($data[0]) && $data[0] == 'logout') {
            $methodName .= 'Logout';

            $data = $this->cleanInputs($data);
        }elseif (!empty($data[0]) && !strstr($data[0], 'filter')) {
            $methodName .= 'ById';

            $data = $this->cleanInputs($data);
        }






        //echo $methodName; die;
        //   var_dump($data); die;


        if (method_exists($this->class, $methodName)) {

            call_user_func_array(array($this->class, $methodName), $data);
        } else {
            echo 'error method not exist';
            die;
        }
    }

    private function cleanInputs($data)
    {
        $clean_input = array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    protected function json($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}
