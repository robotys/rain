<?php 
	include('header.php');
 				
	$posts = post_list();
	// dd($posts);
	if(count($posts) === 0){
		echo 'No Post';
	}else{
		
		foreach($posts as $post){
			echo '<h1><a href="/read/'.$post['slug'].'">'.strtoupper($post['title']).'</a></h1>';

			echo get_post($post['slug']);
			echo '<br/>';
		}

	}

	include('footer.php');
?>
		