<?php
$pagename = Null;
if (isset($_GET['p']))
	$pagename = $_GET['p'];
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?= $cfg_stylesheet; ?>">
		<link rel="alternate" type="application/rss+xml" title="<?= $cfg_sitename ?>" href="rss">
		<title>
			<?= $pagename ? '(*mentebinaria).' . $pagename : $cfg_sitename; ?>
		</title>
	</head>

	<body>
		<div id="box">
		<div id="logo">
			<?= logo() ?>
		</div>

		<?php
			if ($cfg_show_random_quotes) {
		?>
				<div id="frase">
					<?= frase() ?>
				</div>
		<?php
			}
		?>

		<div id="menu">
			<?= menu($pagename) ?>
		</div>
