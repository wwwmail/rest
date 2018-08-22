<?php



class Users extends Rest{

    
    
    public function postUsers($email, $password, $first_name,  $last_name) 
    {
        //        $token = random_bytes(24);
        $token = bin2hex(random_bytes(16));


        $date = (new \DateTime());
            
        $expire = $date ->format('Y-m-d H:i:s');

       // $expire = $date->modify('+'.STAY_LOGINING_TIME.' minutes')->format('Y-m-d H:i:s');
      //  $expire = new DateTime('now')->format('Y-m-d H:i:s');
    //    echo $expire; die;
        //  echo $expire; die;
        //
        //
        //
        //$password = 'my password';
        $random = openssl_random_pseudo_bytes(18);

        $salt = sprintf('$2y$%02d$%s',
                13, // 2^n cost factor
                    substr(strtr(base64_encode($random), '+', '.'), 0, 22)
                );

        $options = ['cost' => 13,
                        'salt' => $salt];

        $hash = password_hash($password, PASSWORD_BCRYPT, $options);



        $db = Db::getInstance();
        $stmt = $db->prepare("INSERT INTO users (email, password, first_name, last_name, token, expire) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $hash);
        $stmt->bindParam(3, $first_name);
        $stmt->bindParam(4, $last_name);
        $stmt->bindParam(5, $token);
        $stmt->bindParam(6, $expire);
        if ($stmt->execute() == true) {
              return $this->response(array('succes' => 'true'), 200);
        } else {
            return $this->response(array('succes' => 'false'), 200);
        }
    }



	
	
	public function getUsersById($id)
	{
		
		$db = Db::getInstance();
        $result = $db->query("SELECT * FROM users WHERE  id = $id");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $this->response($data, 200);
        } else {
            return $this->response($data, 204);
        }
		
	}
	
	public function getUserByEmail($email)
	{
		//echo 'test'; die;
		$db = Db::getInstance();
        $result = $db->query("SELECT * FROM users WHERE  email = '$email' LIMIT 1");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
		
		if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
	}
    
    
    private function validateEmail(){}
    private function validatePassword(){}
    private function validateName(){}
}
