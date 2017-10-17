<?php

/**
 * Description of ResourceRepository
 *
 * @author fede
 */
class ResourceRepository extends PDORepository {

    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        
    }

	private function buscarUsuario($username){
        $answer = $this->queryRow("select * from users where username = ?", array($username));
		return $answer;
	}


	public function listLimitePaciente() {
        $answer = $this->queryList("select * from paciente", []);
        $final_answer = [];
        foreach ($answer as &$element) {
			foreach ($element as $key => $checkVacio){
				if(empty($checkVacio)){
					$element[$key] = '-';
				}
			}
            $final_answer[] = array('apellido' => $element['apellido'],
									'nombre' => $element['nombre'],
									'dni' => $element['dni'],
									'obra_social' => $element['obra_social']);
        }
        return $final_answer;
    }


	private function limiteUsuariosPorApellido($apellido,$activo){
		if (empty($apellido)){
			$apellido = '%';
		} else{
			$apellido = '%'.$apellido.'%';
		}
		if ($activo == 1){
			$noActivo = 1;
		} elseif ($activo == 2){
			$activo = 0;
			$noActivo = 0;
		} else{
			$activo = 1;
			$noActivo = 0;
		}
        $answer = $this->queryList("SELECT * 
									FROM users
									WHERE last_name LIKE ? AND (activo = ? OR activo = ?)", array($apellido,$activo,$noActivo));
		return $answer;
	}

	private function limiteUsuariosPorUsername($username,$activo){
		if (empty($username)){
			$username = '%';
		} else{
			$username = '%'.$username.'%';
		}
		if ($activo == 1){
			$noActivo = 1;
		} elseif ($activo == 2){
			$activo = 0;
			$noActivo = 0;
		} else{
			$activo = 1;
			$noActivo = 0;
		}
        $answer = $this->queryList("SELECT * 
									FROM users
									WHERE username LIKE ? AND (activo = ? OR activo = ?)", array($username,$activo,$noActivo));
		return $answer;
	}

	private function limiteUsuariosPorUsernameSinAdmin($username,$activo){
		if (empty($username)){
			$username = '%';
		} else{
			$username = '%'.$username.'%';
		}
		if ($activo == 1){
			$noActivo = 1;
		} elseif ($activo == 2){
			$activo = 0;
			$noActivo = 0;
		} else{
			$activo = 1;
			$noActivo = 0;
		}
        $answer = $this->queryList("SELECT * 
									FROM users
									WHERE username LIKE ? AND (activo = ? OR activo = ?) AND NOT EXISTS(
																	SELECT *
																	FROM user_tiene_rol
																	WHERE user_tiene_rol.id_users = users.id_users AND user_tiene_rol.id_rol = 1
																	)", array($username,$activo,$noActivo));
		return $answer;
	}

	public function listLimiteUsuario($apellido = '',$activo = 0) {
        $answer = $this->limiteUsuariosPorApellido($apellido,$activo);
        $final_answer = [];
        foreach ($answer as &$element) {
			foreach ($element as $key => $checkVacio){
				if(empty($checkVacio)){
					$element[$key] = '-';
				}
			}

            $final_answer[] = array('first_name' => $element['first_name'],
									'last_name' => $element['last_name'],
									'roles' => $this->formatoDeRoles($element['id_users']),
									'email' =>$element['email']);
        }
        return $final_answer;
    }

	public function listLimiteUsuarioEliminar($username = '',$activo = 0) {

		$answer = $this->limiteUsuariosPorUsernameSinAdmin($username,$activo);
        $final_answer = [];
        foreach ($answer as &$element) {
			$permisosDelUsuario = $this->formatoDeRoles($element['id_users']);
			$final_answer[] = array('id' => $element['id_users'],
										'username' => $element['username'],
										'estado' => $element['activo'],
										'roles' => $permisosDelUsuario);
        }
        return $final_answer;
    }

	private function buscarRolesDe($id_user){
		$answer = $this->queryList("SELECT * FROM user_tiene_rol
									INNER JOIN rol ON user_tiene_rol.id_rol = rol.id_rol 
									WHERE id_users=?",array($id_user));
		return $answer; 
	}

	private function buscarIdDelUsername($username){
		$answer = $this->queryRow("SELECT * FROM users
									WHERE username=?",array($username));
		return $answer['id_users']; 
	}

	public function buscarRolesDelUsuario($username){
		$id_users = $this->buscarIdDelUsername($username);
		$answer = $this->buscarRolesDe($id_users);
        $final_answer = [];
        foreach ($answer as &$element) {
			$final_answer[$element['nombre']] = true;
        }
		return $final_answer; 
	}


	private function formatoDeRoles($id_user){
		$answer = $this->buscarRolesDe($id_user);
		$final_answer = array(); 
		if($answer){
			foreach ($answer as $elementRol)
			$final_answer = array_merge($final_answer , array($elementRol['nombre'])); 
		}else{
			$final_answer = array('-');
		}
		return $final_answer;
	}


	public function loginForm($username,$password){
        $answer = $this->queryRow("SELECT * FROM users where username=? and password=?",array($username,$password));
		return $answer;
    }

	public function loginFormAdmin($username,$password){
        $answer = $this->queryRow("SELECT * FROM users where username=? and password=? and EXISTS(
																	SELECT *
																	FROM user_tiene_rol
																	WHERE user_tiene_rol.id_users = users.id_users AND user_tiene_rol.id_rol = 1
																	)",array($username,$password));
		return $answer;
    }

	public function signupForm($username,$password,$email,$name,$surname,$roles){
        $answer = $this->queryInsert("
										INSERT INTO users (email,username, password, activo, first_name, last_name) 
										VALUES (?, ?, ?, 1, ?,?)",array($email,$username,$password,$name,$surname));
		if($answer){
			$agregandoRoles = $this->loginForm($username,$password);
			foreach ($roles as $rol){
				$this->queryInsert("
									INSERT INTO user_tiene_rol (id_users,id_rol)
									VALUES (?, ?)",array($agregandoRoles['id_users'],$rol));
			}
		}
		return $answer;
    }

	public function signupPaciente($nombre,$apellido,$nacimiento,$documento,$domicilio,$telefono,$obra,$gender,$tipoDocumento){
        $answer = $this->queryInsert("
INSERT INTO paciente (apellido, nombre, nacimiento, genero, Tipo_dni, dni, domicilio, telefono, obra_social) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",array($apellido,$nombre,(int)$nacimiento,(int)$gender,(int)$tipoDocumento,(int)$documento,$domicilio,(int)$telefono,$obra));
		return $answer;
    }

	public function signupDatosDemograficos($heladera,$electricidad,$mascota,$vivienda,$calefaccion,$agua,$dni){
		$answer = $this->queryLastInsert("INSERT INTO datos_demograficos (heladera,electricidad,mascota,vivienda,calefaccion,agua) VALUES (?,?,?,?,?,?)" , array($heladera,$electricidad,$mascota,$vivienda,$calefaccion,$agua));
		$paciente = $this->queryRow ("SELECT * FROM paciente where dni = ?", array($dni));
		$this->queryInsert("INSERT INTO paciente_tiene_datos_demograficos (id_paciente, id_datos_demograficos) VALUES (?,?)", array($paciente['id_paciente'],$answer));
		
		
		return 1;
	}
	

	public function permisos($username){
        $answer = $this->queryList("SELECT * 
									FROM users
									INNER JOIN user_tiene_rol ON users.id_users = user_tiene_rol.id_users
									INNER JOIN rol ON user_tiene_rol.id_rol = rol.id_rol 
									INNER JOIN rol_tiene_permiso ON rol.id_rol = rol_tiene_permiso.id_rol 
									INNER JOIN permiso ON rol_tiene_permiso.id_permiso = permiso.id_permiso
                                	WHERE users.username = ?",array($username));
        $final_answer = [];
        foreach ($answer as &$element) {
            $final_answer = $final_answer + array($element['nombre'] => true);
        }
        return $final_answer;

	}

	public function destroyUserForm($id,$username){
		$rolesDelUsuario = $this->buscarRolesDe($id);
		foreach($rolesDelUsuario as $rol){
			$this->queryInsert("DELETE FROM user_tiene_rol WHERE id_users=? AND id_rol=? ",array($id,$rol['id_rol']));
		}
		$answer = $this->queryInsert("DELETE FROM users WHERE id_users=? AND username=? ",array($id,$username));
		return $answer;
	}

	public function destroyPacienteForm($dni){
		$answer = $this->queryInsert("DELETE FROM paciente WHERE dni=? ",array($dni));
		return $answer;
	}
	
	public function updatePacienteForm($nombre,$apellido,$nacimiento,$domicilio,$telefono,$obra,$gender,$tipoDocumento,$nuevoDocumento,$dni){
		$answer = $this->queryInsert("UPDATE paciente SET  nombre=?, apellido=?, nacimiento=?, domicilio=?, telefono=?, obra_social=?, genero=?, Tipo_dni=?, dni=? WHERE dni=? ",array ($nombre,$apellido,$nacimiento,$domicilio,$telefono,$obra,$gender,$tipoDocumento,$nuevoDocumento,$dni));
	}

	public function modifyTitulo($titulo){
		$answer = $this->queryInsert("UPDATE configuracion
  									  SET titulo = ?",array($titulo));
		return $answer;
	}

	public function modifyEmail($email){
		$answer = $this->queryInsert("UPDATE configuracion
  									  SET email = ?",array($email));
		return $answer;
	}

	public function modifyDescripcion($descripcion){
		$answer = $this->queryInsert("UPDATE configuracion
  									  SET descripcion = ?",array($descripcion));
		return $answer;
	}

	public function modifyPaginacion($paginacion){
		$answer = $this->queryInsert("UPDATE configuracion
  									  SET paginacion = ?",array((int)$paginacion));
		return $answer;
	}


	public function datosPagina(){
        $answer = $this->queryRow("SELECT * FROM configuracion ",[]);
		return $answer;
	}

	public function getPaginacion(){
        $answer = $this->queryRow("SELECT * FROM configuracion ",[]);
		return $answer['paginacion'];
	}

	public function updateUserForm($email,$name,$surname,$username){
		$usuario = $this->queryInsert("UPDATE users SET email = ?, first_name = ?, last_name = ? WHERE username = ?", array ($email,$name,$surname,$username));
	}

	public function getDatosUsuario($username){
		$answer = $this->queryRow("SELECT email,first_name,last_name FROM users WHERE username = ?", []);
		return $answer['datosUsuario'];
	}
	
		public function getDatosPaciente($dni){
		$answer = $this->queryRow("SELECT * FROM paciente WHERE dni = ?", []);
		return $answer['datosPaciente'];
	}

	public function modifyRolesDelUsuario($username,$roles){
		$id_users = $this->buscarIdDelUsername($username);
		$rolesDelUsuario = $this->buscarRolesDe($id_users);
		foreach($rolesDelUsuario as $rol){
			$this->queryInsert("DELETE FROM user_tiene_rol WHERE id_users=? AND id_rol=? ",array($id_users,$rol['id_rol']));
		}
		foreach ($roles as $rol){
			$this->queryInsert("
								INSERT INTO user_tiene_rol (id_users,id_rol)
								VALUES (?, ?)",array($id_users,$rol));
		}

	}

	public function cambiarEstado(){
		$answer = $this->queryRow("SELECT * FROM configuracion", []);
		if($answer['online']){
			$nuevoEstado = 0;
		} else{
			$nuevoEstado = 1;
		}
		$this->queryInsert("UPDATE configuracion SET online = ? ",array($nuevoEstado));
		return $answer;
	}

	public function toggleEstadoUsuario($username){
		$answer = $this->buscarUsuario($username);
		if($answer['activo']){
			$nuevoEstado = 0;
		} else{
			$nuevoEstado = 1;
		}
		$this->queryInsert("UPDATE users SET activo = ? where id_users = ? ",array($nuevoEstado,$answer['id_users']));
		return $answer;
	}

}
