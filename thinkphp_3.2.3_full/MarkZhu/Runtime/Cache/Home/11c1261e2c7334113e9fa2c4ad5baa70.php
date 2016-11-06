<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标题</title>
</head>
<body>
    <div id="nav">
        <a href="#">首页</a> | <a href="#">新闻</a> |<a href="#">个人中心</a>
    </div>
<?php echo ($name); ?>
<button>click</button>
<p>this is a test. colleague</p>
<hr>
<?php
 echo $name.'<br />'; echo $age.'<br />'; echo $sex.'<br />'; ?>
    <div id="footer">
        京
    </div>
</body>
</html>