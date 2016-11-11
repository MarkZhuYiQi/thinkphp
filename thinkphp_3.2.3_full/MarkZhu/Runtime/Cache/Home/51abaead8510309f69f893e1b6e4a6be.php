<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="/Public/bs/css/bootstrap.css" />
    <script src="/Public/bs/js/jquery.js"></script>
    <script src="/Public/bs/js/bootstrap.js"></script>
</head>
<body>



<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                
                

                
                <!-- <?php  $navbar=M("nav"); $nav=$navbar->where(" nav_isShow = 1 ")->order("nav_index")->select(); foreach($nav as $item) { echo "<li><a href=".$item["nav_href"].">".$item["nav_title"]."</a></li>"; } ?> -->

                <!--用tp自带模板引擎方式加载导航栏-->
                <!--用行为扩展方式加载导航栏-->
                <?php if(is_array($nav)): foreach($nav as $key=>$navbar): ?><li><a href="<?php echo ($navbar["nav_href"]); ?>"><?php echo ($navbar["nav_title"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($global_user): ?>
<li><a href=""><?php echo ($global_user); ?></a></li>
<li><a href="">注销</a></li>
<?php else: ?>
<li><a href="">登录</a></li>
<li><a href="">注册</a></li>
<?php endif; ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

    这个页面需要登录

<hr>

    <div id="footer">
        京ICP
    </div>
     <?php  echo "这是我自己的功能，试试看！<br />"; echo "ZhuYiQi里写的标签"; ?> 
</body>
</html>