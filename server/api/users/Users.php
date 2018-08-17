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
    
    
    private function validateEmail(){}
    private function validatePassword(){}
    private function validateName(){}
}