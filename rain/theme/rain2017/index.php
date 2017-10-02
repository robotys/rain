<?php 
	include('header.php');
 				
	$posts = post_list();

	// dd($posts);
	if(count($posts) === 0){
		echo 'No Post';
	}else{
		
		foreach($posts as $post){
			echo '<h1><a href="/read/'.$post['slug'].'">'.strtoupper($post['title']).'</a></h1>';
			echo '<div class="meta">Published at '; the_time('F dS, Y'); echo ' by '; the_author();

			if(has_tag()) echo ' tagged as '; the_tags();

			echo '</div>';
			echo get_post($post['slug']);
			echo '<br/>';
		}

		echo '<br/><br/>';
		the_posts_pagination();

	}

	include('footer.php');
?>
		