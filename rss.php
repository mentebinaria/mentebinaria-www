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

class Feed {

	public $header = '<?xml version="1.0" encoding="UTF-8"?>';

}

class Rss extends Feed {
	
	public $rssversion=
'xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/"';

	public $channel;
	
	public $items = array();
	
	function publishChannel() {
		echo "<channel>\n".
		"<title>".$this->channel->title."</title>\n".
		'<atom:link href="'.$this->channel->feedlink.'" rel="self" type="application/rss+xml" />'."\n".
      "<link>".$this->channel->link."</link>\n".
      "<description>".$this->channel->description."</description>\n".
      "<language>".$this->channel->language."</language>\n".
      "<sy:updatePeriod>".$this->channel->updatePeriod."</sy:updatePeriod>\n".
      "<sy:updateFrequency>".$this->channel->updateFrequency."</sy:updateFrequency>\n".
      "<pubDate>".$this->channel->pubDate."</pubDate>\n".
      "<lastBuildDate>".$this->channel->lastBuildDate."</lastBuildDate>\n".
      "<docs>".$this->channel->docs."</docs>\n".
      "<generator>".$this->channel->generator."</generator>\n";
	}
	
	function publishItems() {
		foreach ($this->items as $i) {
			echo "<item>\n".
			"<title>".$i->title."</title>\n".
         "<link>".$i->link."</link>\n".
         '<guid isPermaLink="false">'.$i->link."</guid>\n".
        "<dc:creator>".$i->dccreator."</dc:creator>\n".
         "<description><![CDATA[".$i->description."]]></description>\n".
         "<content:encoded>\n<![CDATA[".$i->content."]]>\n</content:encoded>\n".
         "<pubDate>".$i->pubDate."</pubDate>\n".
      	"</item>\n";
		}
	}
	
	function publishEnd() {	echo "</channel>\n</rss>";	}
	
	function publish() {
		header("Content-Type: application/rss+xml");
		echo $this->header."\n";
		echo '<rss version="2.0"'."\n".$this->rssversion."\n>\n";
		
		$this->publishChannel();
		$this->publishItems();
		$this->publishEnd();
	}

}

class Channel {
	public $title;
	public $feedlink;
	public $link;
	public $description;
	public $language = 'pt-br';
	public $updatePeriod = 'hourly';
	public $updateFrequency = 1;
	public $pubDate;
	public $lastBuildDate;
   public $docs;
   public $generator;
}

class Item {
	public $title;
	public $link;
	public $dccreator;
	public $description;
	public $content;
	public $pubDate;
}

// cricação do canal
$c = new Channel();
$c->title = 'Mente Binária';
$c->feedlink = 'http://www.mentebinaria.com.br/rss';
$c->link = 'http://www.mentebinaria.com.br/';
$c->description = 'um site no mínimo diferente sobre tecnologia';
$c->pubDate = 'Sun, 18 Sep 2011 23:06:00 -0300';
$c->lastBuildDate = 'Mon, 26 Nov 2013 14:00:00 -0300';
$c->docs = 'http://www.mentebinaria.com.br/rss';
$c->generator = 'classe php do mente binária';

// item
$item = new Item();
$item->title = 'Nova distribuição Linux rápida, segura e moderna! Sei.';
$item->link = 'http://www.mentebinaria.com.br/blog#12';
$item->dccreator = 'Fernando Mercês';
$item->description = '';
$item->content =
'<p>
Motivei-me a escrever este texto dada a recente enxurrada de distribuições Linux que vêm surgindo de tempos em tempos. Basta dar uma rápida olhada no site DistroWatch [1] pra ver a quantidade de distribuições que estão em pleno desenvolvimento. Várias redundantes em relação ís outras, no entanto.
</p>';
$item->pubDate = 'Mon, 26 Nov 2013 14:00:00 -0300';

$r = new Rss();

$r->channel = $c;
$r->items[] = $item;

$r->publish();

?>
