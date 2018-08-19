<?php



class Auth extends Rest{

    
    
	
	
	
	public function postAuth($email, $password)
	{
		//echo $email;
		//echo $password;
		
		$obj = new Users();
		
		$user = $obj->getUserByEmail($email);
		
		if($user && $password == $user[0]['password']){
			echo 'succes';
		}else{
			echo 'bad auth';
		}
		die;
		var_dump($user[0]['password']);
		var_dump($user);
		
		die;
	}
	
	
	
	
	
	
	}