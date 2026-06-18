<?php

/*
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * Copyright (c) 2014, 2016-2017 Fernando Mercês
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <https://www.gnu.org/licenses/>.
 */

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
