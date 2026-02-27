<?php

class Category {

	var $id;
	var $title;
	var $description;
	var $parent; // id

	public function get_category_by_name($name) {
		$this->id = 3;
		$this->name = 'Música';
		$this->description = 'Aqui eu falo de música!';

		return $this;
	}
}

class Article extends Category {

	var $author;
	var $timestamp;
	var $content;

	public function get_article_by_id($id) {
		return $this;
	}

}

class Database {

	var $link;

	public function connect() {
		include('config.php');
		$result = false;
		$conn = mysql_pconnect($cfg_database_host, $cfg_database_user, $cfg_database_password);

		if (!$conn) {
			die('unable to connect to database');
		}

		$result = mysql_selectdb($cfg_database_name, $conn) or die('unable to find the database');
		$this->link = $conn;
		return $result;
	}

	public function search($query) {
		if (!$this->link) {
			$this->connect();
		}

		$result = mysql_query($query, $this->link) or die('invalid query');
		return $result;
	}
}

?>
