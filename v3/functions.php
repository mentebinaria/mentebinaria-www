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

if (!isset($_SESSION))
	session_start();

include_once("google_analytics.php");

function menu($name=null)
{
	$data = "\n";
	$i = 1;
	$separator = ":";
	$break = true; // define se o menu vai quebrar a linha

	// nome do menu => link
	$mnu_items = array(
	"home"          => "/",
	"artigos"        => "textos",
	"blog"          => "blog",
	"projetos"      => "projetos",
	"downloads"     => "files",
	"treinamentos"  => "treinamentos",
	"notas"         => "notas",
	"música"        => "musica",
	"favoritos"     => "favoritos",
	"carreira"      => "carreira",
	"gafes"   		=> "gafes",
	"foss"          => "foss",
	"palestras"     => "palestras",
	"zine"     	    => "zine",
	"faq"           => "faq",
	);

	// número de itens no menu
	$num_items = count($mnu_items);

	foreach ($mnu_items as $mnu => $link)
	{
		// item realçado se for igual ao nome
		if (isset($name) && $name == $mnu)
			$data .= "<a style=\"color: #00cc66;\" href=\"$link\">$mnu</a>";
		else
			$data .= "<a href=\"$link\">$mnu</a>";

		// separador no fim de todos, menos do último item
		if ($i == $num_items)
			$data .= "\n";
		else if ($i == 7 && $break)
			$data .= "<br />\n";
		else
			$data .= "\n $separator ";

		$i++;
	}

	return $data;
}

function frase($all=false)
{
	$f = array();

	$handle = fopen("files/frases.txt", "r");

	if (!$handle)
		return null;

    while (($line = fgets($handle)) !== false) {
        $f[] = $line;
    }

    fclose($handle);

	return $all ? $f : $f[rand(0, count($f)-1)];
}

function logo()
{

$year = date("Y") - 2009;
$data="
___  ___           _         ______ _                  _      
 |  \/  |          | |        | ___ (_)         _      (_)      
 | .  . | ___ _ __ | |_  ___  | |_/ /_ _ __   _//_ _ __ _  __ _ 
 | |\/| |/ _ \ '_ \| __|/ _ \ | ___ \ | '_ \ / _` | '__| |/ _` |
 | |  | |  __/ | | | |_|  __/ | |_/ / | | | | (_| | |  | | (_| |
 \_|  |_/\___|_| |_|\__|\___| \____/|_|_| |_|\__,_|_|  |_|\__,_|
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~$year anos~~~~";

	$data = str_replace(" ", "&nbsp;", $data);
	$data = str_replace("\n", "<br />", $data);
	
	return $data;
}

function loadxml()
{
	$db = "db.xml";
	$xml = null;

	if (file_exists($db))
		$xml = simplexml_load_file($db);

	return $xml;
}

function draw($width, $text) {

	$len = mb_strlen($text, 'UTF-8');

	echo '&#9556;';
	for ($i=0; $i<$width; $i++)
		echo '&#9552;';
	echo '&#9559;<br />';

	echo '&#9553;';
	$n = floor(($width - $len) / 2);
	for ($i=0; $i<$n; $i++)
		echo '&nbsp;';
	echo $text;

	$o = ($len % 2 == 0) ? $n : $n+1;

	for ($i=0; $i<$o; $i++)
		echo '&nbsp;';
	echo '&#9553;<br />';
	
	echo '&#9562;';
	for ($i=0; $i<$width; $i++)
		echo '&#9552;';
	echo '&#9565;<br />';
}

?>
