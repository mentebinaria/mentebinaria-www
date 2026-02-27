<?php

include('config.php');
include('functions.php');
include('template/header.inc');

if (isset($_GET['p'])) {
	$page = $_GET['p'];
	if (in_array($page, $cfg_pages)) {
		load_content($page);
	} else {
		header('Location: /');
	}

} else {
	load_content('home');
}

include('template/footer.inc');

?>
