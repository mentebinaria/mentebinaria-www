<?php

if (!isset($_SESSION))
	session_start();

function u($s) {
	return utf8_encode($s);
}

function load_content($category) {
	require('classes.php');

	$db = new Database();
	$result = $db->search("SELECT * FROM categories WHERE title LIKE '". $category ."';");
	$r = mysql_fetch_array($result);

	if ($r['id'] < 1) {
		die('invalid category');
	}

	$show_timestamp = $r['show_timestamp'];

	echo '<p>' . u($r['description']) . '</p>';

	$result = $db->search('SELECT * FROM articles WHERE parent = '.$r['id'].' ORDER BY id DESC;');

	while ($r = mysql_fetch_array($result)) {
		echo "<article>\n<header>\n<a name=\"" . $r['id'] . '"><h3>' .
		u($r['title']) . "</h3></a>\n" ;

		if($show_timestamp) {
			echo '<div class="date"><time pubdate datetime="' . $r['timestamp'] . '">' . "\n" .
				'Publicado em '.$r['timestamp'].' por '. u($r['author']) .'</time></div>' . "\n";
		}
		echo "</header>\n" . u($r['content']) . "\n";
	}
}

function menu($name=null)
{
	include('config.php');

	$data = "\n";
	$i = 1;

	// número de itens no menu
	$num_items = count($cfg_pages);

	foreach ($cfg_pages as $index => $value) {
		$item_name = is_numeric($index) ? $value : $index;

		// highlight current menu item
		if (isset($name) && $name == $item_name) {
			$data .= "<a style=\"color: #00cc66;\" href=\"$value\">$item_name</a>";
		} else {
			$data .= "<a href=\"$value\">$item_name</a>";
		}

		// put a separator among items, excepting the last one
		if ($i == $num_items) {
			$data .= "\n";

		} else if ($i == 7 && $cfg_menu_linebreak) {
			$data .= "<br />\n";
		} else {
			$data .= "\n $cfg_menu_separator ";
		}

		$i++;
	}

	return $data;
}

function frase()
{
	$f = array();

	$f[]='o que sabemos é uma gota; o que ignoramos é um oceano (Newton)';
	$f[]='aqueles que podem ler, vêem duas vezes melhor (Menandro)';
	$f[]='o principal não é o conhecimento, mas seu uso (Talmude)';
	$f[]='não decore passos, aprenda um caminho! (Klauss Vianna)';
	$f[]='quem desconfia, fica sábio (João Guimarães Rosa)';
	$f[]='é impossível aprender aquilo que se acha que já sabe (Epiteto)';
	$f[]='nenhum conhecimento pode ir além de sua experiência (John Locke)';
	$f[]='creia em si, mas não duvide sempre dos outros (Machado de Assis)';
	$f[]='os erros são os portais da descoberta (James Joyce)';
	$f[]='ou nós encontramos um caminho, ou abrimos um (Aníbal)';
	$f[]='de erro em erro descobre-se a verdade inteira (Sigmund Freud)';
	$f[]='a humildade é o primeiro degrau para a sabedoria (Tomás de Aquino)';
	$f[]='quem muito fala, muito mente (Provérbio Português)';
	$f[]='a humildade é o escudo dos fortes';
	$f[]='comemora quando há obstáculos; a vitória se justificará';
	$f[]='conhecimento adquirido e não compartilhado, é perdido';
	$f[]='de nada serve um homem que não ajuda ninguém';
	$f[]='a dificuldade diminui na medida em que o desafio aumenta';
	$f[]='linguagens são como mulheres: se você usa muitas, não vai prestar pra nenhuma';
	$f[]='o nome original do jogo Paciência é Solitaire. Pense nisso';
	$f[]='estude html e css, ou terá um site que nem esse';

	return $f[rand(0, count($f)-1)];
}

function logo()
{
	include('config.php');

	$data = str_replace(" ", "&nbsp;", $cfg_logo_ascii);
	$data = str_replace("\n", "<br>", $data);
	return $data;
}

?>
