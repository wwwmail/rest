<?php

class Auth extends Rest {

    public function postAuth($email, $password)
    {
        $obj = new Users();

        $user = $obj->getUserByEmail($email);

        if (password_verify($password, $user[0]['password'])) {
            $token = bin2hex(random_bytes(16));
            $date = (new \DateTime());
            $expire = $date->modify('+' . STAY_LOGINING_TIME . ' minutes')->format('Y-m-d H:i:s');

            $obj->setExpire($user[0]['id'], $expire, $token);

           return $this->response(array('success' => 'true', 
                                         'message'=> 'congratulation you are logining',
                                        'auth' => $token,
                                        ), 200);
        } else {
            return $this->response(array('success' => 'false', 
                                         'message'=> 'email or password is wrong'), 200);
            
        }
    }
    
    public function getAuth()
    {
        if(!self::isAuth()){
            
            return $this->response(array('success' => 'false',), 200);
        } else {
          
            $id = $this->getUserId();
            $obj = new Users();
            $user = $obj->getUsersByIdArray($id);
           
            $name = $user['first_name']. ' '. $user['last_name'];
           
            return $this->response(array('success' => 'true', 'user_name'=> $name), 200);
        }
    }
    
    public function getAuthLogout()
    {
        $obj = new Users();
        $authToken = (new self)->getBearerToken();
        
        $user = $obj->getUserByToken($authToken);
        $date = (new \DateTime());
        $expire = $date->modify('-' . STAY_LOGINING_TIME . ' minutes')->format('Y-m-d H:i:s');
        $token = bin2hex(random_bytes(16));
        $obj->setExpire($user[0]['id'], $expire, $token);
        
        
        if(!self::isAuth()){
            return $this->response(array('success' => 'true'), 200);
        } else {
            return $this->response(array('success' => 'false'), 200);
        }
    }
    

    public static function isAuth()
    {
        $obj = new Users();
        $authToken = (new self)->getBearerToken();
        $user = $obj->getUserByToken($authToken);

       // echo 'test';
       // echo $authToken; die;
        $date = (new \DateTime());

        $nowDate = $date->format('Y-m-d H:i:s');

        if (isset($user) && time() < strtotime($user[0]['expire'])) {
            return true;
        } else {
            return false;
        }

    }
    
    public function getUserId()
    {
        $obj = new Users();
        $authToken = (new self)->getBearerToken();
        //echo $authToken; die;
        $user = $obj->getUserByToken($authToken);
        
        return $user[0]['id'];
        
    }

    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        //var_dump($headers); die;
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    function getAuthorizationHeader()
    {

/*
    var_dump($_SERVER);
        echo '<pre>';
        print apache_request_headers()["Authorization"];
         var_dump($_SERVER["HTTP_AUTHORIZATION"]);
        var_dump(getallheaders());
echo '22';
        $a  = apache_request_headers();
        var_dump($a); die;

        foreach (getallheaders() as $name => $value) {
                echo "$name: $value\n";
        }
*/
       // die;

     //   $head = getallheaders();
   // echo '<Pre>';
     //  var_dump($_SERVER); die;
        $headers = null;
        if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])){
            $headers = trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }
        elseif (isset($_SERVER['Authorization'])) {
      //     var_dump($_SERVER); die;
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
           // var_dump($_SERVER);die;
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
         //  print_r($requestHeaders); die;
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

}
