<?php
class Current_User extends Model{

	private static $user;

	function __construct() {
    parent::Model();  
    
  }

	public static function user() {
   
		if(!isset(self::$user)) {

			$CI =& get_instance();
			$CI->load->library('session');
       
			if (!$user_id = $CI->session->userdata('user_id')) {
		
      	return FALSE;
			}
      
      $query=$CI->db->get_where("admusers",array("id"=>$CI->db->escape_str($user_id)));
      $u=$query->result();
			if (!isset($u[0])) {
				return FALSE;
			}

			self::$user = $u[0];
		}

		return self::$user;
	}

	public static function login($username, $password) {

	
		 $CI =& get_instance();
	   $sql="select * from admusers where active=1 and username='".$CI->db->escape_str($username)."'";
		$query=$CI->db->query($sql);
		$u=$query->result();
		if (isset($u[0]) ) {

      $CI->load->model("user_model");
			// password match (comparing encrypted passwords)
			
			
			if ($u[0]->password == $CI->user_model->transform_password($password)) {
				
				//$CI =& get_instance();
				$CI->load->library('session');
				
				$CI->session->set_userdata('user_id',$u[0]->id);
				self::$user = $u[0];

				return TRUE;
			}


		}

		// login failed
		return FALSE;

	}
	
	public function getUsername()
	{
    if (isset(self::$user) )
       return self::$user->username;
    else
       return '';   
  
  }
  
  
  
  public function isHabilitado($modulo)
  { 
     if (isset(self::$user) )
     {
     
      $idusuario=self::$user->id;
      
     $sql="select u.* from admusers a, usuario_permiso u,permisos p
      where a.id=u.usuarioid and p.macro='$modulo' and 
      u.permisoid=p.id and a.id=$idusuario
     ";
     
     $query=$this->db->query($sql);
     $usuario=$query->result();
     if (count($usuario) > 0)
       return true;
     else
       return false;  
     
     }
     else
       return false;
     
     
  
  }

   public function __clone() {
	        trigger_error('Clone is not allowed.', E_USER_ERROR);
	    }
}
?>
