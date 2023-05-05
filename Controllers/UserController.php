<?php

namespace Controllers;

use PDO;


class UserController {
	
	
	public function createUser($name, $email, $password) {
		global $db;
		$stmt = $db->query("INSERT INTO users ( user_name, user_email, user_password ) VALUES ( ?, ?, ? )", array($name, $email, $password));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function createSession($id) {
		$_SESSION['user_id'] = $id;
	}
	
	
	public function readAllForUpdate() {
		global $db;
		$stmt = $db->query("SELECT * FROM users WHERE user_id = ?", array($_SESSION['user_id']));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function readForUpdateAdmin($id) {
		//trebati će poslati ID od korisnika za kojeg treba povući podatke, za koga se želi napraviti update
		//povući sve osim PASSWORD
	}
	
	
	public function readAllUsers() {
		global $db;
		$stmt = $db->query("SELECT * FROM users ORDER BY user_id", array());
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function readLogin($email, $password) {		
		global $db;
		$stmt = $db->query("SELECT user_id FROM users WHERE user_email = ? AND user_password = ?", array($email, $password));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	public function readEmail($email) {
		global $db;
		$stmt = $db->query("SELECT user_email FROM users WHERE user_email = ?", array($email));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function getName($id) {
		global $db;
		$stmt = $db->query("SELECT user_name FROM users WHERE user_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results['user_name'];
	}
	
	
	public function updateUser($name, $email, $password) {
		global $db;
		$stmt = $db->query("UPDATE users SET user_name = ?, user_email = ?, user_password = ? WHERE user_id = ?", array($name, $email, $password, $_SESSION['user_id']));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->deleteSession();
	}
	
	
	public function updateUserAdmin($id, $name, $email) {
		//šalje se ID od koga se treba nešto promijeniti, NAME u koje se treba promijeniti i EMAIL u koji se treba promijentii
		//ID se čita iz URI,  user/update/-id-
		//ADMIN ne može mijenjati PASSWORD, to treba napraviti neki sustav za RECOVER PASSWORD
	}
	
	
	public function deleteUser() {
		global $db;
		$stmt = $db->query("DELETE FROM users WHERE user_id = ?", array($_SESSION['user_id']));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->deleteSession();
	}
	
	
	public function isAdmin() {
		return true;
	}
	
	
	public function deleteSession() {
		unset($_SESSION['user_id']);
		header('Location: ' . ROOT_PATH . '/user/login');
		die();
	}

	
}

?>