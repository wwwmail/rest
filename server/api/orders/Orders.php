<?php

class Orders extends Rest{

    
    
    public function postOrders($auto_id, $status=0) 
    {
        // var_dump(Auth::isAuth()); die;
        if (!Auth::isAuth()) {
            return $this->response(array('success' => 'false',
                        'message' => 'must be logining'), 200);
        }
        
        
        $obj = new Auth();
        
        $user_id =  $obj->getUserId(); 


        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO orders (auto_id, user_id, status) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $auto_id);
        $stmt->bindParam(2, $user_id);
//        $stmt->bindParam(3, $payment);
        $stmt->bindParam(3, $status);

        if ($stmt->execute() == true) {
              return $this->response(array('succes' => 'true'), 200);
        } else {
            return $this->response(array('succes' => 'false'), 200);
        }
    }
    
    
    public function getOrders()
    {
       
         if (!Auth::isAuth()) {
            return $this->response(array('success' => 'false',
                        'message' => 'must be logining'), 200);
        }
        
        
        $obj = new Auth();
        
        $user_id =  $obj->getUserId(); 
        
        
        $db = Db::getInstance();
        $result = $db->query("SELECT * FROM orders WHERE user_id = $user_id");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $this->response($data, 200);
        } else {
            return $this->response($data, 204);
        }
    }
}