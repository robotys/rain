<?php 
	include('header.php');
 				
	$post = get_data();

	echo '<h1><a href="/read/'.$post['slug'].'">'.strtoupper($post['title']).'</a></h1>';
	echo get_post($post['slug']);
	echo '<br/>';
	echo '<div class="nav">';

	// dd($post);

	if($post['navigation']['prev']) echo '<a href="/read/'.$post['navigation']['prev']['slug'].'" style="float:left;">&larr; '.$post['navigation']['prev']['title'].'</a>';

	if($post['navigation']['next']) echo '<a href="/read/'.$post['navigation']['next']['slug'].'" style="float:right;">'.$post['navigation']['next']['title'].' &rarr;</a>';

	echo '</div>';

	include('footer.php');
?>
		