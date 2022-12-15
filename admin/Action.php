<?php

session_start();

Class Action {
	
	private $db;

	public function __construct() 
	{

   		include '../connect.php';
    
    	$this->db = $conn;
	}

	function __destruct() 
	{
	    $this->db->close();
	}

	function login()
	{
		extract($_POST);

		$qry = $this->db->query("
			SELECT 
				* 
			FROM 
				users 
			WHERE username = '".$username."' AND password = '".$password."' ");

		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			// var_dump($_SESSION);
			return 1;
		}else {
			return 2;
		}
	}
	function logout()
	{
		session_destroy();

		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}

		header("location: login.php");
	}

	function saveSettings()
	{
		extract($_POST);

		$data = " blog_name = '".$name."' ";
		$data .= ", email = '".$email."' ";
		$data .= ", about = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		$data .= ", contact = '".$contact."' ";
		$chk = $this->db->query("SELECT * FROM site_settings");

		if ($chk->num_rows > 0) {
			$id = $chk->fetch_array()['id'];
			$save = $this->db->query("UPDATE site_settings SET ".$data." where id = ".$id);

			if ($save)
				return 1;

		} else {
			echo "INSERT INTO site_settings SET ".$data;

			$save = $this->db->query("INSERT INTO site_settings SET ".$data);

			if ($save)
				return 1;
		}
	}
	
	function saveCategory()
	{
		extract($_POST);

		if (empty($id)) {
			$chk = $this->db->query("SELECT * FROM category WHERE name ='".$name."' ")->num_rows;

			if ($chk > 0) {
				return json_encode(['status'=>2,'msg'=>'OPS! Essa categoria já existe']);
			} else {
				$save = $this->db->query("INSERT INTO category SET name='".$name."' , description ='".$description."' ");

				if ($save)
					return json_encode(['status'=>1]);
			}

		} else {
			$chk = $this->db->query("SELECT * FROM category WHERE name ='".$name."' and id !='".$id."' ")->num_rows;

			if ($chk > 0) {
				return json_encode(['status'=>2,'msg'=>'OPS! Essa categoria já existe']);
			} else {
				$save = $this->db->query("UPDATE category SET name='".$name."' , description ='".$description."' WHERE id=".$id);

				if ($save)
					return json_encode(['status'=>1]);
			}
		}
	}

	function loadCategory()
	{
		$qry = $this->db->query("SELECT * FROM category WHERE status = 1");

		$data = [];

		while ($row=$qry->fetch_assoc()) {
			$data[] = $row;
		}

		echo json_encode($data);
	}

	function loadPost()
	{
			$qry = $this->db->query("
				SELECT 
					p.*,c.name AS category 
				FROM 
					posts p 
				INNER JOIN 
					category c on c.id = p.category_id ");

			$data = [];

			while ($row=$qry->fetch_assoc()) {
				$data[] = $row;
			}

			echo json_encode($data);
		}

	function removeCategory()
	{
		extract($_POST);

		$remove = $this->db->query("DELETE FROM category WHERE id =".$id);

		if ($remove)
			return 1;
	}

	function publishPost()
	{
		extract($_POST);

		$publish = $this->db->query("UPDATE posts SET status = 1 WHERE id =".$id);

		if ($publish)
			return 1;
	}

	function removePost()
	{
		extract($_POST);

		$remove = $this->db->query("DELETE FROM posts WHERE id =".$id);

		if ($remove)
			return 1;
	}

	function savePost()
	{
		extract($_POST);

		$data = " title = '".$name."' ";
		$data .= ", post = '".htmlentities(str_replace("'","&#x2019;",$post))."' ";
		$data .= ", category_id = '".$category_id."' ";

		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
			$data .= ", img_path = '".$fname."' ";

		}

		if (empty($id)) {
			$insert  = $this->db->query("INSERT INTO posts SET".$data);

			if ($insert) {
				return json_encode(['status'=>1,'id'=>$this->db->insert_id]);
			}

		} else {
			$update  = $this->db->query("
				UPDATE 
					posts 
				SET 
					".$data." , date_published='".date('Y-m-d H:i')."' 
				WHERE 
					id=".$id);

			if ($update) {
				return json_encode(['status'=>1,'id'=>$id]);
			}
		}
		
	}
}