<?php

class Orders extends Rest{

    
    
    public function postOrders($auto_id, $first_name, $last_name, $payment) 
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO orders (auto_id, first_name, last_name, payment) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $auto_id);
        $stmt->bindParam(2, $first_name);
        $stmt->bindParam(3, $last_name);
        $stmt->bindParam(4, $payment);

        if ($stmt->execute() == true) {
              return $this->response(array('succes' => 'true'), 200);
        } else {
            return $this->response(array('succes' => 'false'), 200);
        }
    }
}