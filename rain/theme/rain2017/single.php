<?php 
	include('header.php');
 				
	$post = get_data();
	current_url();
	echo '<h1>'.strtoupper($post['title']).'</h1>';
	
	echo '<div class="meta">Published at '; the_time('F dS, Y'); echo ' by '; the_author();

	if(has_tag()) echo ' tagged as '; the_tags();

	echo '</div>';

	echo get_post($post['slug']);
	echo '<br/>';
	echo '<div class="nav">';

	// dd($post);

	if($post['navigation']['prev']) echo '<a href="/read/'.$post['navigation']['prev']['slug'].'" style="float:left;">&larr; '.$post['navigation']['prev']['title'].'</a>';

	if($post['navigation']['next']) echo '<a href="/read/'.$post['navigation']['next']['slug'].'" style="float:right;">'.$post['navigation']['next']['title'].' &rarr;</a>';

	echo '</div>';

	include('footer.php');
?>
		