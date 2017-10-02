<?php
session_start();
session_destroy();

error_reporting(E_ALL);

function og_meta(){
	if(is_post()){
		$post = get_data();

		echo '
  <meta property="og:title" content="'.$post['title'].' - '.get_blog('name').'"/>
  <meta property="og:site_name" content="'.$_SERVER['HTTP_HOST'].'" />
  <meta property="og:url" content="/read/'.$post['slug'].'" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="'.$post['brief'].'"/>
  <meta property="og:image" content="/media/'.$post['featured_img'].'"/>

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="'.$_SERVER['HTTP_HOST'].'" />
  <meta name="twitter:creator" content="@Robotys" />
  <meta name="twitter:title" content="'.$post['title'].' - '.get_blog('name').'" />
  <meta name="twitter:description" content="'.$post['brief'].'" />
  <meta name="twitter:image" content="/media/'.$post['featured_img'].'" />';
	
	}elseif(is_home()){
		echo '
  <meta property="og:title" content="'.get_blog('name').'"/>
  <meta property="og:site_name" content="'.$_SERVER['HTTP_HOST'].'" />
  <meta property="og:url" content="'.get_blog('url').'" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="'.get_blog('description').'"/>
  <meta property="og:image" content="/media/'.get_blog('featured_img').'"/>

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="'.get_blog('url').'" />
  <meta name="twitter:creator" content="@Robotys" />
  <meta name="twitter:title" content="'.get_blog('name').'" />
  <meta name="twitter:description" content="'.get_blog('description').'" />
  <meta name="twitter:image" content="/media/'.get_blog('featured_img').'" />';
	}
}

function auto_footer(){
	// check for prism = true in session and add prism js
	if(array_key_exists('has_syntax', $_SESSION) AND $_SESSION['has_syntax'] == true){
		echo '
<link rel="stylesheet" type="text/css" href="/rain/lib/prism.css" />
<script src="/rain/lib/prism.js"></script>';
	}
}

function rain_header(){
	
	og_meta();

	if(get_blog('ga_tracking_id')){
		echo '
  <!-- Global Site Tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29977976-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments)};
    gtag(\'js\', new Date());

    gtag(\'config\', \''.get_blog('ga_tracking_id').'\');
  </script>
';
	}

}

function assets($path){
	$settings = settings();
	// dd($settings);
	echo '/rain/theme/'.$settings['theme'].'/assets/'.$path;
}

function has_tag(){
	$post = get_data();
	return (array_key_exists('tags', $post) !== false);
}

function upvote_link(){
	echo '<a href="/upvote/'.$_SESSION['post_slug'].'">upvote</a>';
}

function have_posts(){
	// if home, get list
	if(is_home()){
		$list = post_list();
		$keys = array_keys($list);

		if(array_key_exists('prev_index', $_SESSION) === false){
			$prev = false;
			$now = 0;
			$next = 1;
		}else{

			$prev = $_SESSION['prev_index'];
			$now = $prev+1;
			$next = $now+1;

		}

		// $_SESSION['prev_index'] = $now;
		
		if(array_key_exists($now, $keys) !== false){
			$_SESSION['post_slug'] = $keys[$now];
			return true;
		}else{
			return false;
		}

	}
	// if read, get post

	// if search, get search list
}

function the_tags(){
	$post = get_data();
	$tags = $post['tags'];
	
	$all = [];
	foreach($tags as $tag){
		$all[] = '<a href="/tag/'.$tag.'">'.$tag.'</a>';
	}

	echo implode(', ', $all);
}

function the_content(){
	echo get_post();
}

function the_title($open = '<h1>', $close = '</h1>', $link = true){
	if($link){
		$open = $open.'<a href="'.get_permalink().'">';
		$close = '</a>'.$close;
	}

	echo $open.get_title().$close;
}

function the_time($format = 'Y-m-d H:i:s'){
	echo get_time($format);
}

function the_author(){
	echo get_author();
}

function the_author_posts_link(){
	echo get_author();
}

function blog($key){
	// dd($key);
	echo get_blog($key);
}

function get_blog($key){
	$settings = settings();
	
	if(array_key_exists($key, $settings) !== FALSE) return $settings[$key];
	else return false;
}

function get_author(){
	$data = get_data();
	return $data['author'];
}

function get_time($format = 'Y-m-d H:i:s'){
	$data = get_data();
	return date($format, strtotime($data['published_at']));
}

function get_permalink(){
	return '/read/'.$_SESSION['post_slug'];
}

function get_title(){
	$data = get_data();
	return $data['title'];
}

function the_post(){
	
	// update post pointer
	if(array_key_exists('prev_index', $_SESSION) === false){
		$now = 0;
	}else{
		$now = $_SESSION['prev_index']+1;
	}

	$_SESSION['prev_index'] = $now;
	
}

function is_home(){
	return ($_SERVER['REQUEST_URI'] == '/');
}

function is_post(){
	return (strpos($_SERVER['REQUEST_URI'], '/read/') !== FALSE);
}

function is_search(){
	return (strpos($_SERVER['REQUEST_URI'], '/search/') !== FALSE);
}

function is_tag(){
	return (strpos($_SERVER['REQUEST_URI'], '/tag/') !== FALSE);
}

function read_slug(){
	if(is_post()){
		return str_replace('/read/', '', $_SERVER['REQUEST_URI']);
	}else{
		return false;
	}
}

function the_posts_pagination(){
	$per_page = get_blog('post_per_list');
	$total_post = $_SESSION['total_post'];
	$total_page = ceil($total_post/$per_page);

	if(array_key_exists('page', $_GET)) $current_page = $_GET['page'];
	else{
		// dd($_SERVER['REQUEST_URI']);
		$current_page = 1;
	}



	if($total_page > 1){
		$links = [];
		
		if($current_page > 1) $links[] = '<li class="page-item"><a class="page-link" href="?page='.($current_page - 1).'"> &laquo; </a></li>';

		for($i=0; $i < $total_page; $i++){
			$class = '';
			if(($i+1) == $current_page){
				$links[] = '<li class="page-item active">'.($i+1).'</li>';
			}else{
				
				$links[] = '<li class="page-item"><a class="page-link" href="?page='.($i+1).'">'.($i+1).'</a></li>';
			} 
		}

		if($current_page < $total_page) $links[] = '<li class="page-item"><a class="page-link" href="?page='.($current_page + 1).'"> &raquo; </a></li>';

		echo '<ul class="pagination">'.implode($links).'</ul>';
	}
	
}

function sort_list($list){

	// date descending
	$dates = $slug_index = [];
	$count = 0;
	foreach($list as $index=>$post){
		$dates[$post['slug']] = (int)strtotime($post['published_at']).''.$count++;
		$slug_index[$post['slug']] = $index;
	}

	arsort($dates);
	$sorted = [];

	// dd($list);

	// create pagination
	$per_page = get_blog('post_per_list');
	$total_post = $_SESSION['total_post'] = count($list);
	$total_page = ceil($total_post/$per_page);

	if(array_key_exists('page', $_GET)) $current_page = $_GET['page'];
	else{
		// dd($_SERVER['REQUEST_URI']);
		$current_page = 1;
	} 
	
	$start = ($current_page - 1) * $per_page;
	$end = $start + ($per_page - 1);

	// dd($start);
	
	$count = 0;
	foreach($dates as $slug=>$timekey){
		if($count >= $start) $sorted[] = $list[$slug_index[$slug]];
		$count++;

		if($count > $end) break;
	}

	// dd($sorted);

	return $sorted;
}

function search_phrase(){
	if(strpos($_SERVER['REQUEST_URI'], '/search/') !== FALSE){

		$exp = explode('/', $_SERVER['REQUEST_URI']);

		$key = $exp[2];
		$ex = explode('?', $key);
		$keyword = $ex[0];
		
		echo $keyword;
	}
}

function search_list($keyword){

	// search in all data
	$res = [];
	$all_data = [];
	foreach(scandir('../post') as $path){
		if($path !== '.' AND $path !== '..' AND $path !== 'index.php' AND strpos($path, '.json') !== FALSE){
			
			$str = file_get_contents('../post/'.$path);
			$data = json_decode(file_get_contents('../post/'.$path), TRUE);
			$data['slug'] = str_replace('.json', '', $path);

			if(stripos($str, $keyword) !== false AND $data['status'] == 'published'){
				$res[$data['slug']] = $data;
			}

			if($data['status'] == 'published') $all_data[$data['slug']] = $data;
		}
	}

	foreach($all_data as $data){
		$md = get_markdown($data['slug']);
		if(stripos($md, $keyword) !== false) $res[$data['slug']] = $data;
	}

	return $res; // no need to sort, as post_list will sort this res!
}

function post_list(){

	// no filter yet. Will filter based on search 
	// no order yet. Will order by descending date
	if(strpos($_SERVER['REQUEST_URI'], '/search/') !== FALSE){

		$exp = explode('/', $_SERVER['REQUEST_URI']);
		$key = $exp[2];
		$ex = explode('?', $key);
		$keyword = $ex[0];
		$list = search_list($keyword);
		

	}else{
		// get all published post list WITHOUT actual long content
		$tmp = [
							'title'=>'',
							'brief'=>'',
							'published_at'=>'',
							'created_at'=>'',
							'author'=>'',
							'tags'=>[],
							'status'=>'draft',
						];
		foreach(scandir('../post') as $path){
			if($path !== '.' AND $path !== '..' AND $path !== 'index.php' AND strpos($path, '.json') !== FALSE){
				// dd($path);
				$data = json_decode(file_get_contents('../post/'.$path), TRUE);
				$data['slug'] = str_replace('.json', '', $path);

				foreach($tmp as $key=>$default){
					if(array_key_exists($key, $data) === FALSE) $data[$key] = $default;
				}

				// $data['post'] = get_post($data['slug']);
				$list[$data['slug']] = $data;
			}
		}
	}

	return sort_list($list);
}

function get_navigation($current_slug){
	$list = post_list();
	$prev = $next = false;
	foreach($list as $index=>$post){
		if($post['slug'] == $current_slug){
			if(array_key_exists(($index-1), $list) !== false) $prev = $list[($index-1)];
			if(array_key_exists(($index+1), $list) !== false) $next = $list[($index+1)];
			break;
		}
	}

	$nav['prev'] = $prev;
	$nav['next'] = $next;
	return $nav;
}


include('parsedown.php');

function get_data($slug = false){

	if(!$slug AND $_SERVER['REQUEST_URI'] === '/') $slug = $_SESSION['post_slug'];
	else $slug = str_replace('/read/','',$_SERVER['REQUEST_URI']);

	$tmp = [
						'title'=>'',
						'brief'=>'',
						'published_at'=>'',
						'created_at'=>'',
						'author'=>'',
						'tags'=>[],
						'status'=>'draft',
					];

	
	$data = json_decode(file_get_contents('../post/'.$slug.'.json'), TRUE);
	$data['slug'] = str_replace('.json', '', $slug);

	foreach($tmp as $key=>$default){
		if(array_key_exists($key, $data) === FALSE) $data[$key] = $default;
	}

	$data['navigation'] = get_navigation($slug);

	// $data['post'] = get_post($data['slug']);
	return $data;
}

function get_post($slug = false){

	if(!$slug) $slug = $_SESSION['post_slug'];

	$md = get_markdown($slug);

	$parsedown = new Parsedown();
	$html = $parsedown->text($md);

	if(stripos($html, '<pre>') !== -1){
		$_SESSION['has_syntax'] = true;
	}

	$exp = explode('</h1>', $html);

	return $exp[1];
}

function get_markdown($slug){
	// dd($slug);
	$md = file_get_contents('../post/'.$slug.'.md');
	return $md;
}

function settings($key = false, $value = false){
	if($key){

	}else{
		// dd(scandir('./rain/metadata/blog.json'));
		$json = json_decode(file_get_contents('../settings.json'), TRUE);
		return $json['blog'];
	}
}


function dd($multi){
	echo '<pre style="padding: 15px; background: #444; color: #00FF00">';
	var_dump($multi);
	echo '</pre>';
	exit;
}

?>