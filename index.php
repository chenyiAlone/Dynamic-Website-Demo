<?php
    $db_server = 'localhost';
    $db_user = 'root';
    $db_pwd = '123456';
    $db_table = 'writer';

    $con = mysqli_connect($db_server, $db_user,$db_pwd,$db_table);
    $con->query("set names utf8");
    $sql = "select * from alltext";
    // $con->query('set names stf8');
    // mysqli_query("SET NAMES 'UTF8'");
    $rows = $con->query($sql);
    mysqli_close($con);

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>文字 word 心情 mood</title>
    <meta name="keywords" content="" />
    <meta name="description" content="主题的个人博客模板，优雅、稳重、大气,低调。" />
    <link href="css/base.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="index.php"></a></div>
    <nav class="topnav" id="topnav"><a href="index.php"><span>首页</span>
            <span class="en">Protal</span>
        </a><a href="publish.php"><span>上传</span><span class="en">Pusblish</span></a></nav>
    </nav>
</header>
<div class="banner">
    <section class="box">
        <ul class="texts">
            <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
            <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
            <p>加了锁的青春，不会再因谁而推开心门。</p>
        </ul>
    </section>
</div>
<div class="template">
    <div class="box">
        <h3>
            <p><span>文字 word </span>  心情 mood</p>
        </h3>
        <ul>

    </div>
</div>
<article>
    <h2 class="title_tj">
        <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">

        <?php
            header('content-type:text/html; charset=utf8');

            while( $row = $rows->fetch_assoc()) {
                //            print_r($row);
                //        print_r($row);
                $concent = mb_substr(strip_tags($row['content']),0,100,"UTF8");
                $author = $row['author'];
                $tittle = $row['tittle'];
                $time = $row['time'];
                $id = "more.php?id=".$row['id'];

        ?>

                <h3><?php echo $tittle;?></h3>
        <figure><img src="images/001.png"></figure>
        <ul>
            <a title="/" href=<?php echo $id;?>; target="_blank" class="readmore">阅读全文>></a>
            <p><?php echo $concent?>...</p>
        </ul>
        <p class="dateview"><span><?php echo $time?></span><span>作者：<?php echo $author?></span></p>


        <?php
            }
        ?>


    </div>
    <aside class="right">
        <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
        <div class="news">

            <h3>
                <p>最新<span>文章</span></p>
            </h3>

            <ul class="paih">
                <?php
                $count = 0;

                $con = mysqli_connect($db_server, $db_user,$db_pwd,$db_table);
                $con->query("set names utf8");
                $sql = "select * from alltext";
                // $con->query('set names stf8');
                // mysqli_query("SET NAMES 'UTF8'");
                $rows = $con->query($sql);
                while( $row = $rows->fetch_assoc()) {
                //            print_r($row);
                //        print_r($row);
                if($count>4)break;
                $author = $row['author'];
                $tittle = $row['tittle'];
                    $id = "more.php?id=".$row['id'];
                    ?>




                    <li><a href=<?php echo $id;?> title=<?php echo $tittle; ?>; target="_blank"><?php echo $tittle; ?></a></li>

                <?php
                    $count++;
                }

                ?>
            </ul>

</article>
<br><br><br><br><br><br><br><br>
<footer>
    <p>Design by Embedded training Demo.   动态网页制作</p>
</footer>
<script src="js/silder.js"></script>
</body>
</html>
