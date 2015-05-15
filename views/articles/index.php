<?php

$body = "";

foreach ($articles as $article) {
	$body .= 
	"<div class='blog-post'>
		<h2 class='blog-post-title'><a href='/articles/$article->id'>$article->title</a></h2>
		<p class='blog-post-meta'>$article->about | $article->created_at</p>
	</div><!-- /.blog-post -->";
}

return $body;


?>