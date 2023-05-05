<?php

namespace Controllers;

use PDO;


class UserRolesController {
	
	
	public function getAllPossibleRoles() {
		global $db;
		$stmt = $db->query("SELECT * FROM roles ORDER BY role_id", array());
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function getRolesForUserId($id) {
		global $db;
		$stmt = $db->query("SELECT * FROM roles_connections WHERE connection_type = ? AND connection_id = ?", array('USER', $id));
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function getRoleNameAndType($id) {
		global $db;
		$stmt = $db->query("SELECT role_name, role_right FROM roles WHERE role_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function updateUserRoles($id) {
		
		$postData = $_POST;
		global $db;
		$db->pdo->beginTransaction();
		
		try {
			
			$stmt = $db->pdo->prepare ("DELETE FROM roles_connections WHERE connection_type = ? AND connection_id = ?");
			$stmt->execute(array('USER', $id));
			
			foreach ($postData as $role) {
			
				$stmt = $db->pdo->prepare ("INSERT INTO roles_connections ( role_id, connection_type, connection_id ) VALUES ( ?, ?, ? ) ");
				$stmt->execute(array($role, 'USER', $id));
			
			}

			$db->pdo->commit();

		} catch (PDOException $e) {
			
			$db->pdo->rollback();
			throw $e;
			die();
			
		}

		header('Location: ' . ROOT_PATH . '/users');
		die();
		
	}
	
	
	
	
	
	public function ableToArticleCreate() {
		$rolesData = $this->getRolesForUserId($_SESSION['user_id']);
		foreach ($rolesData as $role) {
			if ($role['role_id']==4) return true;
		}
		return false;
	}
	
	public function ableToNavigationCreate() {
		
	}
	
	public function ableToNavigationEdit() {
		
	}
	
	public function ableToNavigationDelete() {
		
	}
	

}

?>