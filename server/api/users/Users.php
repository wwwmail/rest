<?php



class Users extends Rest{

    
    
    public function postUsers($email, $password, $first_name,  $last_name) 
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $first_name);
        $stmt->bindParam(4, $last_name);

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