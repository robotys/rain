Welcome To Rain
===

![Photo by Mike Kotsch on Unsplash](/media/welcome-rain.jpg)

The main reason Rain was developed is to create a blog engine that is really integrated to my current workflow in developing Web Application. Said workflow is: `Write in Text Editor -> Git Commit -> Git Push.`

And the rest is taken up by `Continuous Integration` setup.

As i'm already writing extensively in markdown format for documentations, and once in a while post in my wordpress blog as markdown format too, then why not make a blog engine completely from ground up with Git And Markdown at its core.

Thus `Rain` was born.

Written from scratch in `PHP` with **no framework**, **no database** and only 1 library (Parsedown, excellent tool!) disregarding any new convention and cool programming paradigm.

Yep, not even `OOP` (except for <a href="http://parsedown.org">Parsedown</a> anyway).

Which means: 1) It is very easy to start hacking Rain functionality away and 2) It is not the most beautiful code in existence. Imagine the beauty of <a href="http://laravel.com">Laravel</a> source code, and now only take 1% of it, that is Rain. :-D

Well, the only thing that it has is `theme` engine, which is quite minimal too. Take a look at this `index.php` file that you are looking at:

```php
<?php 
	include('header.php');
 				
	$posts = post_list();

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
```

Hell yeah blogging gets so simple!

Another point: without database in place, all of the post write up and its metadata is saved as plain text file. Posts is saved as `.md` while metada is saved as `.json` as you guessed it, json format.

This effectively made it very fast and nimble for small and personal project. (Going to benchmark it soon).

Requirements to run Rain:
1. PHP 4.6
2. Git
3. <a href="http://www.sublimetext.com">Good text editor</a>. Pick your poison

What Rain did not have:
1. User login online.
2. Category. but we do have tags
3. Dashboard. This is not <a href="http://wordpress.org">`Wordpress`</a>
4. WYSIWYG editor. Again, this is not `Wordpress`!
5. Comments. Use <a href="http://disqus.com">Disqus</a> instead.

What i've planned for Rain:
1. CDN compatible
2. Simple Analytics
3. Subscription / Newsletter with AWS integration

Which brings this <strike>rant</strike> post to its main caveat: if you are not web developer, and not familiar with git workflow, most likely Rain is not for you.

For 1% of you that fall in that little spot: hey buddies!

Thank you for trying Rain!

![Izwan Robotys Cute Face](/media/avatar.jpg)<br/>`Izwan Robotys`<br/><small>Kuala Lumpur</small>

*ps: If you have any suggestion to further simplify Rain, please do so in github issues. Better yet: fork and pull request. <br> pps: Rain was released under <a href="https://en.wikipedia.org/wiki/MIT_License">MIT opensource</a> license. Have no fear of using it in any way whatsoever.*



