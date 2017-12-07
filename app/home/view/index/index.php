<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index 控制器首页模板</title>
	<!--	引入bootstrap-->
	<link rel="stylesheet" href="./static/bs3/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<h2 class="page-header text-primary">Index 控制器首页模板</h2>
        <p class="row"><?php echo $str;?></p>
		<?php foreach ($arr as $v) { ?>
        <p class="row"><?php echo $v;?></p>
		<?php } ?>
	</div>
</body>
</html>