Welcome To Rain
===

![Photo by Mike Kotsch on Unsplash](/media/welcome-rain.jpg)

The main reason Rain was developed is to create a blog engine that is really integrated to my current workflow in developing Web Application. Said workflow is: `Write in Text Editor -> Git Commit -> Git Push.`

And the rest is taken up by `Continuous Integration` setup.

As i'm already writing extensively in markdown format for documentations, and once in a while post in my wordpress blog as markdown format too, then why not make a blog engine completely from ground up with Git And Markdown at its core.

Thus `Rain` was born.

Written from scratch in `PHP` with **no framework**, **no database** and only 1 library (Parsedown, excellent tool!) disregarding any new convention and cool programming paradigm.

Yep, not even `OOP` (except for [Parsedown](http://parsedown.org) anyway).

Which means: 1) It is very easy to start hacking Rain functionality away and 2) It is not the most beautiful code in existence. Imagine the beauty of [Laravel](http://laravel.com) source code, and now only take 1% of it, that is Rain. :-D

Well, the only thing that it has is `theme` engine, which is quite minimal too. Take a look at this `index.php` file that you are looking at:

Hell yeah blogging gets so simple!

Another point: without database in place, all of the post write up and its metadata is saved as plain text file. Posts is saved as `.md` while metada is saved as `.json` as you guessed it, json format.

This effectively made it very fast and nimble for small and personal project. (Going to benchmark it soon).

List
---

Requirements to use Rain:
1. PHP 5
2. Apache (NGINX soon)
3. Git
4.[Good text editor](http://www.sublimetext.com) (Pick your poison)

What Rain did not have:
1. User login online.
2. Category. but we do have tags
3. Dashboard. This is not `Wordpress`</a>
4. WYSIWYG editor. Again, this is not `Wordpress`!
5. Comments. Use [Disqus](http://disqus.com)</a> instead.

What i've planned for Rain:
1. CDN compatible
2. Simple Analytics
3. Subscription / Newsletter with AWS integration

Which brings this <strike>rant</strike> post to its main caveat: if you are not web developer, and not familiar with git workflow, most likely Rain is not for you.

For 1% of you that fall in that little spot: hey buddies!

Install
---

We have two routes to install Rain. First, the easiest and preferred method: via Composer. Last is via plain download and extract to your directory.

Composer method:
1. cd to your web root. Create new one if necessary.
2. Initite git: `git init`
3. Add robotys/rain as remote rain: `git remote add rain git@github.com:robotys/rain.git`
4. Pull latest code: `git pull rain master`
5. Open your directory in browser.

Done!

(If you have problems with composer though, please do some googling. (Composer homepage is quite good for starter. It gets quite frustrating for the first timer. My go to command is `composer dump-autload`. And NEVER USE composer as `sudo`. You've been warned ).

Download method:

1. Download zip from github page. Or just [click here](https://github.com/robotys/rain/archive/master.zip) to download latest version.
2. Extract it inside your root directory
3. Run your webserver (apache)
4. Open it from your browser

If any of above steps is mindboggling to you, then please stop now and read some more on managing local web server. [Digital Ocean article](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04) is good for that.


Thank you for trying Rain!

![Izwan Robotys Cute Face](/media/avatar.jpg)<br/>`Izwan Robotys`<br/><small>Kuala Lumpur</small>

*ps: If you have any suggestion to further simplify Rain, please do so in github issues. Better yet: fork and pull request. <br> pps: Rain was released under [MIT opensource](https://en.wikipedia.org/wiki/MIT_License) license. Have no fear of using it in any way whatsoever.*



