<?php

$comments_body = "";
foreach ($article->comments() as $comment) {
	$comments_body .=
	"<p class='blog-post-meta'>$comment->user_name</p>
	$comment->comment";
}

return
"<div class='blog-post'>
	<h2 class='blog-post-title'>$article->title</h2>
	<p class='blog-post-meta'>$article->about | $article->created_at</p>
	$article->content
</div><!-- /.blog-post -->
<div class='btn-group' role='group' aria-label='...'>
  <a href='/articles/$article->id/edit' class='btn btn-default'>Edit</a>
  <a href='/articles/delete/$article->id' class='btn btn-default'>Delete</a>
  <a href='/' class='btn btn-default'>Back</a>
</div>

<div class='row'>
$comment_form
</div>

<div class='row'>
$comments_body
</div>
";

?>
