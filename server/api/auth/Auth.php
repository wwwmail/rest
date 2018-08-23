<?php

class Auth extends Rest {

    public function postAuth($email, $password)
    {


        if(self::isAuth()){
            echo 'good auth';
        }else {
            echo 'bad auth';
        }
        echo 'test';



        die;
        //echo $email;
        //echo $password;

        $obj = new Users();

        $user = $obj->getUserByEmail($email);

        //var_dump($user); die;
//                echo $user[0]['password'];
//                echo $password; die;
        if (password_verify('123456', $user[0]['password'])) {
            $token = bin2hex(random_bytes(16));
            $date = (new \DateTime());
            $expire = $date->modify('+' . STAY_LOGINING_TIME . ' minutes')->format('Y-m-d H:i:s');

            $obj->setExpire($user[0]['id'], $expire, $token);

            setcookie("_auth", $token, time() + STAY_LOGINING_TIME * 60);

            

            //$expire = $date->format('Y-m-d H:i:s');


            echo 'succes';
        } else {
            echo 'bad auth1';
        }
        die;
        var_dump($user[0]['password']);
        var_dump($user);

        die;
    }

    public static function isAuth()
    {
        $obj = new Users();
        $authToken = (new self)->getBearerToken();
        $user = $obj->getUserByToken($authToken);

        $date = (new \DateTime());

        $nowDate = $date->format('Y-m-d H:i:s');

        if (isset($user) && time() < strtotime($user[0]['expire'])) {
            return true;
        } else {
            return false;
        }


        die;
        var_dump($user);
    }

    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

}
