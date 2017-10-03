<!DOCTYPE html>
<html>
<head>
  <title><?php
    if(is_post()) echo get_title().' &bull; ';
    echo blog('name');
  ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
    if(is_post()){
      $description = get_description();
      $keywords = implode(',',get_tags());
    }else{
      $description = get_blog('description');
      $keywords = implode(',', get_blog('keyword'));

    }
  ?>

  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="<?php echo $keywords; ?>">
<?php rain_header();?>


  <style>
  	body{
  		margin: 0;
  		font-family: Arial, sans-serif;
  		font-size: 14px;
  		color: #444;
  		background: #eee;
  	}

  	.container{
  		max-width: 800px;
  		margin: 0 auto;
  	}

  	.sidebar_wide{
  		max-width: 30%;
  		float: left;
  		/*background: #ccc;*/
  		box-sizing: border-box;
  		padding: 20px;
  		padding-top: 30px;
  	}

    .meta{
      font-size: 0.8em;
      margin-bottom: 40px;
    }

  	.content{
  		max-width: 70%;
  		float: left;
  		box-sizing: border-box;
  		padding: 20px;
  		border-left: 1px #ccc dashed;
  	}

    .content > img{
      max-width: 100%;
    }

  	.content p, .content li{
  		line-height: 1.6em;
  		margin-bottom: 2em;
  	}

  	.content li{
  		margin-bottom: 0em;
  	}

  	.content ol, content ul{
  		margin-bottom: 2em;
  	}

  	code{
  		color: #000;
  	}

  	pre{
  		background: #444;
  		box-sizing: border-box;
  		padding: 15px;
  	}

  	pre > code{
  		color: #0F0;
  	}

  	a, a:visited{
  		color: #5c94ff;
  		text-decoration: none;
  		transition: all 0.5s;
  	}

  	a:hover{
  		color: #048;
  	}

  	blockquote{
  		padding: 10px;
  		background: #fefefe;
  		font-style: italic;
  		margin: 0px;
  		border: 0px;
  	}

  	.content blockquote > p{
  		margin: 10px;
  		margin-bottom: 10px;
  	}

  	input.form-control{
  		width: 100%;
  		box-sizing: border-box;
  		padding: 4px 10px;
  		color: #555;
  		border: #ccc solid 1px;
  	}

  	.avatar{
  		width: 100px;
  		/*border-radius: 50%;*/
  	}

  	footer{
  		margin-top: 100px;
  		font-size: 0.8em;
  	}

    ul.pagination{
      margin: 0 auto;
      padding: 0;
      text-align: center;
      width: 100%;
    }

    li.page-item{
      list-style: none;
      display: inline-block;
      margin: 0;
      padding: 0;
    }

    a.page-link, li.active{
      background: #fff;
      padding: 6px 10px;
      margin-right: 2px;
      border: #ddd solid 1px;
    }

    li.active{
      background: none;
      padding: 3px 10px;
    }

	</style>
  
</head>
<body>
<div class="container">
	<div class="sidebar_wide">
		<p>
			<img src="<?php assets('avatar.png');?>" class="avatar">
			<br/>
			<b><a href="/"><i class="glyphicon glyphicon-gear"></i> <?php blog('name');?></a></b>
    </p>
    <p><small><?php blog('description');?></small></p>
		<br/>
    <form method="post" action="/search">
      <b>Search</b>
			<br/>
      <input type="text" name="phrase" class="form-control" placeholder="type and hit enter" value="<?php search_phrase();?>">
    </form>

	</div>
	<div class="content">