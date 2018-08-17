<?php


require_once (__DIR__.'/config.php');

spl_autoload_register(function ($class) {
    $str = $class . '.php';
    $str = str_replace('\\', '/', $str);
    require_once __DIR__.'/'.mb_strtolower($class).'/'.$str; 
});

//use Rest;



//
//
////die;
//
//class Rest
//{
//
//    private $url;
//    private $method;
//    
//    private $class;
//    
//    public $_content_type = "application/json";
//    private $_code = 200;
//
//
//    public function __construct()
//    {
//        $this->url = $_SERVER['REQUEST_URI'];
//        $this->method = $_SERVER['REQUEST_METHOD'];
//    }
//    
//     public function response($data,$status){
//        $this->_code = ($status)?$status:200;
//        $this->set_headers();
//        echo $data;
//        exit;
//    }
//    
//    private function get_status_message(){
//        $status = array(
//            100 => 'Continue',  
//            101 => 'Switching Protocols',  
//            200 => 'OK',
//            201 => 'Created',  
//            202 => 'Accepted',  
//            203 => 'Non-Authoritative Information',  
//            204 => 'No Content',  
//            205 => 'Reset Content',  
//            206 => 'Partial Content',  
//            300 => 'Multiple Choices',  
//            301 => 'Moved Permanently',  
//            302 => 'Found',  
//            303 => 'See Other',  
//            304 => 'Not Modified',  
//            305 => 'Use Proxy',  
//            306 => '(Unused)',  
//            307 => 'Temporary Redirect',  
//            400 => 'Bad Request',  
//            401 => 'Unauthorized',  
//            402 => 'Payment Required',  
//            403 => 'Forbidden',  
//            404 => 'Not Found',  
//            405 => 'Method Not Allowed',  
//            406 => 'Not Acceptable',  
//            407 => 'Proxy Authentication Required',  
//            408 => 'Request Timeout',  
//            409 => 'Conflict',  
//            410 => 'Gone',  
//            411 => 'Length Required',  
//            412 => 'Precondition Failed',  
//            413 => 'Request Entity Too Large',  
//            414 => 'Request-URI Too Long',  
//            415 => 'Unsupported Media Type',  
//            416 => 'Requested Range Not Satisfiable',  
//            417 => 'Expectation Failed',  
//            500 => 'Internal Server Error',  
//            501 => 'Not Implemented',  
//            502 => 'Bad Gateway',  
//            503 => 'Service Unavailable',  
//            504 => 'Gateway Timeout',  
//            505 => 'HTTP Version Not Supported');
//        return ($status[$this->_code])?$status[$this->_code]:$status[500];
//    }
//    
//    private function set_headers(){
//        header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
//        header("Content-Type:".$this->_content_type);
//    }
//
//    public function setMethodApi()
//    {
//        
//        list($a, $d, $db, $table, $path) = explode('/', $this->url, 6);
//        
//      
//        switch ($this->method) {
//            case 'GET':
//     
//                $this->setMethod($table, 'get' . ucfirst($table), explode('/', $path));
//                break;
//            case 'DELETE':
//                $this->setMethod('delete' . ucfirst($table), explode('/', $path));
//                break;
//            case 'POST':
//                $this->setMethod('post' . ucfirst($table), explode('/', $path));
//                break;
//            case 'PUT':
//                $this->setMethod('put' . ucfirst($table), explode('/', $path));
//                break;
//            default:
//                $this->response('',406);
//                return false;
//        }
//    }
//    
//    
//    private function setMethod($class ,$methodName, $data=[])
//    {
//        
//
//        if(file_exists( __DIR__.'/'.mb_strtolower($class).'/'.ucfirst($class).'.php')){
//            
//            $this->class = ucfirst($class);
//            
//        } else {
//            
//            echo 'error this class does not exist'; 
//            die;
//        }
//        
//        require_once __DIR__.'/'.mb_strtolower($class).'/'.ucfirst($class).'.php';
//
//        $this->class = new $this->class;
//        
//        
//        if(method_exists($this->class, $methodName)){
//
//            call_user_func_array([$this->class, $methodName], $data);
//
//        } else {
//            echo 'error method not exist'; die;
//        }
//        
//       
//    }
//    
//    
//    private function json($data){
//        if(is_array($data)){
//            return json_encode($data);
//        }
//    }
//
//}


$obj  = new Rest();

 $obj->setMethodApi();

//
//function setMethod($method, $param=false) 
//{ 
//    if ( method_exists($this, $method) ) 
//    { 
//      //  call_user_func(......); 
//    } 
//} 
