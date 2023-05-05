<?php

namespace Controllers;

use PDO;


class ArticleController {	
	
	
	public function createArticle(array $postData) {
		
		if (!$filename = $this->uploadImage()) die();
		
		global $db;
		$stmt = $db->query("INSERT INTO articles ( 
			article_title, article_content, article_image_src, article_image_alt, 
			article_created_at, article_author, article_route )
			VALUES ( ?, ?, ?, ?, ?, ?, ? )", 
			array($postData['title'], $postData['content'], $filename, $postData['image_alt'],
			'', 1, $postData['route']));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//TREBA REALOKACIJA NA SVE ARTICLES
		//MORAM NAPRAVITI TU ADMIN STRANICU
		die();
		header('Location: ' . ROOT_PATH . '/articles');
		die();
	}
	
	
			public function uploadImage() {
				
				$target_dir = "images/articles/";
				$target_file = $target_dir . basename($_FILES["image-src"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["image-src"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}

				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}

				// Check file size
				if ($_FILES["image-src"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
					die();
				// if everything is ok, try to upload file
				} else {
				if (move_uploaded_file($_FILES["image-src"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["image-src"]["name"])). " has been uploaded.";
					return htmlspecialchars( basename( $_FILES["image-src"]["name"]));
				} else {
					echo "Sorry, there was an error uploading your file.";
					die();
				}
			}
	
		}
	
	
	public function createErrorArray() {
		return array(
			'errorFound' => false,
			'titleIsGoodLength' => true,
			'contentIsGoodLength' => true,
			'imageAltIsGoodLength' => true,
			'imageSrcIsValid' => true,
			'routeIsValid' => true
		);
	}
	
	
	public function checkForValidPostMethod() {
		
		if (!isset($_POST["title"]) OR 
			!isset($_POST["content"]) OR 
			!isset($_POST["image-alt"]) OR 
			//!isset($_POST["image-src"]) OR 
			!isset($_POST["route"])) {
				return false;
		} else {
			$postData = $this->sanitizePost();
			return $postData;
		}
		
	}
	
	
			public function sanitizePost() {
				
				$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
				$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
				$image_alt = filter_input(INPUT_POST, 'image-alt', FILTER_SANITIZE_STRING);
				$route = filter_input(INPUT_POST, 'route', FILTER_SANITIZE_STRING);
				return array(
					'title' => $title,
					'content' => $content,
					'image_alt' => $image_alt,
					'route' => $route
				);
				
			}
	
	
	public function checkForPostErrors($postData, $article_route = '', $article_image_src = '') {
		
		$errorFound = false;
		$titleIsGoodLength = true;
		$contentIsGoodLength = true;
		$imageAltIsGoodLength = true;
		$imageSrcIsValid = true;
		$routeIsValid = true;

		
		if (strlen($postData['title'])==0) $titleIsGoodLength = false;
		if (strlen($postData['title'])>50) $titleIsGoodLength = false;
		if (!$titleIsGoodLength) $errorFound = true;
		
		if (strlen($postData['content'])==0) $contentIsGoodLength = false;
		if (!$contentIsGoodLength) $errorFound = true;
		
		if (strlen($postData['image_alt'])==0) $imageAltIsGoodLength = false;
		if (strlen($postData['image_alt'])>50) $imageAltIsGoodLength = false;
		if (!$imageAltIsGoodLength) $errorFound = true;
		
		//$imageSrcIsValid = true;
		// DODAO SAM ZA SLUČAJ KADA SE KOD EDITIRANJA NE UNOSI NOVA SLIKA, VRIJEDI STARA
		if (strlen($article_image_src)>0) $imageSrcIsValid = true;
		
		$dbData = $this->getArticleRoutes();
		foreach ($dbData as $check) {
			if ($check['article_route']==$postData['route']) $routeIsValid = false;
		}
		
		if (strlen($article_route)>0 AND $postData['route']==$article_route) $routeIsValid = true;
		
		if (!$routeIsValid) $errorFound = true;
		
		return array(
			'errorFound' => $errorFound,
			'titleIsGoodLength' => $titleIsGoodLength,
			'contentIsGoodLength' => $contentIsGoodLength,
			'imageAltIsGoodLength' => $imageAltIsGoodLength,
			'imageSrcIsValid' => $imageSrcIsValid,
			'routeIsValid' => $routeIsValid
		);
		
	}
	
	
		public function getArticleRoutes() {
			global $db;
			$stmt = $db->query("SELECT article_route FROM articles", array());
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		}
	
	
	public function readAllForUpdate($id) {
		
		global $db;
		$stmt = $db->query("SELECT * FROM articles WHERE article_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
		
	}
	
	
	public function readArticleById($id) {
		
		global $db;
		$stmt = $db->query("SELECT * FROM articles WHERE article_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
		
	}
	
	
	public function readArticleByRoute($route) {
		
		global $db;
		$stmt = $db->query("SELECT * FROM articles WHERE article_route = ?", array($route));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
		
	}
	
	
	public function readAllArticles() {
		
		global $db;
		$stmt = $db->query("SELECT * FROM articles ORDER BY article_id", array());
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
		
	}
	
	
	public function updateArticle($id, $postData) {
		
		if (strlen($_FILES["image-src"]["name"])>0) {
			if (!$filename = $this->uploadImage()) die();
		} else {
			$filename = filter_input(INPUT_POST, 'image-src-hidden', FILTER_SANITIZE_STRING);
		}
		global $db;
		$stmt = $db->query("UPDATE articles SET article_title=?, article_content=?, article_image_src=?, article_image_alt=?,
			article_created_at=?, article_author=?, article_route=? 
			WHERE article_id=?",
			array($postData['title'], $postData['content'], $filename, $postData['image_alt'],
			'', 1, $postData['route'], $id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		header('Location: ' . ROOT_PATH . '/articles');
		die();
		
	}
	
	
	public function deleteArticle($id) {
		
		global $db;
		$stmt = $db->query("DELETE FROM articles WHERE article_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		// TREBA UBACITI LOGIKU DA SE PROVJERI GDJE SE KORISTI ARTICLE, KOD NAVIGACIJE I SLIČNO
		// NAKON TOGA IZBACITI PORUKU DA ĆE SE TO OBRISATI, NAKON POTVRDE IZBRISATI POVEZNICU I TAMO
		// ZA SADA NEKA BUDE SAMO DA POVEZNICA SA ODREĐENE NAVIGACIJE NA ARTICLE NE RADI
		header('Location: ' . ROOT_PATH . '/articles');
		die();
		
	}
	
	
	
	
	
	
	
	
	
	
	/*
	public function createNav(array $postData) {
		global $db;
		$stmt = $db->query("INSERT INTO navigations ( 
			navigation_order_id, navigation_parent_id, navigation_name, 
			navigation_connection_type, navigation_connection_id, navigation_created_at, navigation_route, navigation_author ) 
			VALUES ( ?, ?, ?, ?, ?, ?, ?, ? )", 
			array($this->numOfNavs()+1, $postData['parent'], $postData['name'], 
			$this->getConnectionTypeName($postData['connection_type']), $postData['connection_id'], '', $postData['route'], 1));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		header('Location: ' . ROOT_PATH . '/navigations');
		die();
	}
	
	
			public function numOfNavs() {
				global $db;
				$count = $db->pdo->query("SELECT count(*) FROM navigations")->fetchColumn();
				return $count;
			}
			
			
			public function getConnectionTypeName($id) {
				// OVO BIH NAJBOLJE TREBAO NAPRAVITI U BAZI, PA ONDA POVLAČITI TEKST NA OSNOVU ID
				switch ($id) {
					case 0:
						return "";
					case 1:
						return "Article";
					case 2:
						return "Articles Category";
				}
			}
	
	
	public function checkForPostErrors($postData, $navigation_route = '') {
		
		$errorFound = false;
		$nameIsGoodLength = true;
		$parentIsValid = false;
		$connectionTypeIsValid = false;
		$connectionIdIsValid = true;
		$routeIsValid = true;
		
		if (strlen($postData['name'])==0) $nameIsGoodLength = false;
		if (strlen($postData['name'])>10) $nameIsGoodLength = false;
		if (!$nameIsGoodLength) $errorFound = true;
		
		if ($postData['parent']==0) {
			$parentIsValid = true;
		} else {
			$dbData = $this->whoCanBeParentNav();
			foreach ($dbData as $check) {
				if ($check['navigation_id']==$postData['parent']) $parentIsValid = true;
			}
		}
		if (!$parentIsValid) $errorFound = true;
		
		$dbData = $this->getConnectionTypes();
		foreach ($dbData as $check) {
			if ($check['id']==$postData['connection_type']) $connectionTypeIsValid = true;
		}
		
		// $connectionIdIsValid
		// connectionIdIsValid bih morao prvo naprviti logiku, da prepozna radi li se o Article ili Article Category ili nešto treće
		// na temelju toga onda bih mora pristupiti bazi podataka i provjeriti jel postoji članak ili kategorija sa tim idate
		// za sada ovo izostaviti, neka se odbije pristup stranici preko linka
		
		$dbData = $this->getNavRoutes();
		foreach ($dbData as $check) {
			if ($check['navigation_route']==$postData['route']) $routeIsValid = false;
		}
		
		if (strlen($navigation_route)>0 AND $postData['route']==$navigation_route) $routeIsValid = true;
	
		if (!$routeIsValid) $errorFound = true;
		
		return array(
			'errorFound' => $errorFound,
			'nameIsGoodLength' => $nameIsGoodLength,
			'parentIsValid' => $parentIsValid,
			'connectionTypeIsValid' => $connectionTypeIsValid,
			'connectionIdIsValid' => $connectionIdIsValid,
			'routeIsValid' => $routeIsValid
		);
		
	}
	
	
			public function createErrorArray() {
				return array(
					'errorFound' => false,
					'nameIsGoodLength' => true,
					'parentIsValid' => false,
					'connectionTypeIsValid' => false,
					'connectionIdIsValid' => true,
					'routeIsValid' => true
				);
			}
	
	
			public function whoCanBeParentNav() {
	
				global $db;
				$stmt = $db->query("SELECT navigation_id, navigation_name FROM navigations WHERE navigation_parent_id = ? ORDER BY navigation_order_id", array(0));
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
	
			}
	
	
			public function getConnectionTypes() {
				global $db;
				$stmt = $db->query("SELECT id, type FROM navigation_connection_types ORDER BY id", array());
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}
	
	
			public function getNavRoutes() {
				global $db;
				$stmt = $db->query("SELECT navigation_route FROM navigations", array());
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}

	
	public function checkForValidPostMethod() {
		if (!isset($_POST["name"]) OR 
			!isset($_POST["parent"]) OR 
			!isset($_POST["connection-type"]) OR 
			!isset($_POST["connection-id"]) OR 
			!isset($_POST["route"])) {
				return false;
		} else {
			$postData = $this->sanitizePost();
			return $postData;
		}
	}
	
	
			public function sanitizePost() {
				$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				$parent = filter_input(INPUT_POST, 'parent', FILTER_SANITIZE_NUMBER_INT);
				$connection_type = filter_input(INPUT_POST, 'connection-type', FILTER_SANITIZE_NUMBER_INT);
				$connection_id = filter_input(INPUT_POST, 'connection-id', FILTER_SANITIZE_NUMBER_INT);
				$route = filter_input(INPUT_POST, 'route', FILTER_SANITIZE_STRING);
				return array(
					'name' => $name,
					'parent' => $parent,
					'connection_type' => $connection_type,
					'connection_id' => $connection_id,
					'route' => $route
				);
			}
	
	
	public function readRoutes($route) {
	
		global $db;
		$stmt = $db->query("SELECT navigation_route, navigation_connection_type, navigation_connection_id 
			FROM navigations ORDER BY navigation_order_id, navigation_id", array());
		if ( $results = $stmt->fetchAll(PDO::FETCH_ASSOC) ) {
			
			$stmt = $db->query("SELECT type, route FROM navigation_connection_types", array());
			$connTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($results as $nav) {
				
				foreach ($connTypes as $connType) {
				
					if ($nav['navigation_connection_type']==$connType['type'] AND $route==$nav['navigation_route']) {
					
						header('Location: ' . ROOT_PATH . $connType['route'] . 'id/' . $nav['navigation_connection_id']);
						die();
					
					}
				
				}
				
			}
			
		} else {
			return false;
		}
	
	}
	
	
	public function readAllNav() {
		
		global $db;
		$stmt = $db->query("SELECT * FROM navigations ORDER BY navigation_order_id, navigation_id", array());
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
		
	}
	
	
	public function readNavsList() {
	
		global $db;
		$stmt = $db->query("SELECT navigation_order_id, navigation_name, navigation_parent_id, navigation_connection_type, navigation_connection_id, navigation_route FROM navigations ORDER BY navigation_order_id, navigation_id", array());
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	
	}
	
	
	public function getNameOfNavId($id) {
		
		global $db;
		$stmt = $db->query("SELECT navigation_name FROM navigations WHERE navigation_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results['navigation_name'];
		
	}
	
	
	public function readAllForUpdate($id) {
		global $db;
		$stmt = $db->query("SELECT * FROM navigations WHERE navigation_order_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	public function updateNav($id, $postData) {
		global $db;
		$stmt = $db->query("UPDATE navigations SET navigation_parent_id=?, navigation_name=?,
			navigation_connection_type=?, navigation_connection_id=?, navigation_created_at=?, navigation_route=?, navigation_author=?
			WHERE navigation_order_id=?", 
			array($postData['parent'], $postData['name'], 
			$this->getConnectionTypeName($postData['connection_type']), $postData['connection_id'], '', $postData['route'], 1, $id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		header('Location: ' . ROOT_PATH . '/navigations');
		die();
	}
	
	
	public function deleteNav($id) {
		global $db;
		$navId = $this->getNavIdFromOrderId($id);
		$stmt = $db->query("DELETE FROM navigations WHERE navigation_order_id = ?", array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->removeParentFromChilds($navId);
		$this->reOrganiseOrderIds($id);
		header('Location: ' . ROOT_PATH . '/navigations');
		die();
	}
	
	
			public function getNavIdFromOrderId($order_id) {
				global $db;
				$stmt = $db->query("SELECT navigation_id FROM navigations WHERE navigation_order_id = ?", array($order_id));
				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				return $results['navigation_id'];
			}
		
			public function removeParentFromChilds($id) {
				global $db;
				$stmt = $db->query("SELECT navigation_id, navigation_parent_id FROM navigations", array());
				$dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($dbData as $check) {
					if ($check['navigation_parent_id']==$id) {
						$stmt = $db->query("UPDATE navigations SET navigation_parent_id = 0 WHERE navigation_id= ?", array($check['navigation_id']));
						$results = $stmt->fetch(PDO::FETCH_ASSOC);
					}
				}
			}
		
			public function reOrganiseOrderIds($id) {
				$count = $this->numOfNavs();
				global $db;
				for ($i=$id; $i<=$count; $i++) {
					$stmt = $db->query("UPDATE navigations SET navigation_order_id=? WHERE navigation_order_id=?", array($i, $i+1));
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
	
	
	public function hasUniqueOrderIds($dbData) {
	
		// VODITI SE PRVO LOGIKOM DA IMAM SVE UNIQUE ORDER_ID
		// MORAM NAPRAVITI TRANSAKCIJSKI UNOS U BAZU PODATAKA
	
	}
	
	
	public function isParent($dbData, $navId) {
		
		foreach ($dbData as $temp) {
			if ( $temp['navigation_parent_id'] == $navId ) return true;
		}
		return false;
		
	}
	
	
	public function switchOrderIds($id1, $id2) {
	
		global $db;
		$db->pdo->beginTransaction();

		try {
			
			$stmt1 = $db->pdo->prepare("UPDATE navigations SET navigation_order_id = 0 WHERE navigation_order_id = ?");
			$stmt1->execute(array($id1));

			$stmt2 = $db->pdo->prepare("UPDATE navigations SET navigation_order_id = ? WHERE navigation_order_id = ?");
			$stmt2->execute(array($id1, $id2));

			$stmt3 = $db->pdo->prepare("UPDATE navigations SET navigation_order_id = ? WHERE navigation_order_id = 0");
			$stmt3->execute(array($id2));

			$db->pdo->commit();

		} catch (PDOException $e) {
			
			$db->pdo->rollback();
			throw $e;
			die();
			
		}

		header('Location: ' . ROOT_PATH . '/navigations');
		die();
	
	}
	
	*/

	
}

?>