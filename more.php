<?php

header('content-type:text/html; charset=utf8');


$id = $_GET['id'];

$db_server = 'localhost';
$db_user = 'root';
$db_pwd = '123456';
$db_table = 'writer';

$con = mysqli_connect($db_server, $db_user,$db_pwd,$db_table);
$con->query("set names utf8");
$sql = "select * from alltext where id=$id";
// $con->query('set names stf8');
// mysqli_query("SET NAMES 'UTF8'");
$rows = $con->query($sql);
$row = $rows->fetch_assoc();
//            print_r($row);
//        print_r($row);
$concent =$row['content'];
$author = $row['author'];
$tittle = $row['tittle'];
$time = $row['time'];

mysqli_close($con);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $tittle."-".$author;?></title>
    <meta name="keywords" content="个人博客,杨青个人博客,个人博客模板,杨青" />
    <meta name="description" content="杨青个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
    <link href="css/base.css" rel="stylesheet">
    <link href="css/new.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav"><a href="index.php"><span>首页</span><span class="en">Protal</span></a><a href="about.html">

    </nav>
</header>
<article class="blogs">
    <br>
    <h1 class="t_nav"><span><a href="index.php" class="n1">网站首页</a><a href='<?php echo "more.php?id=".$id;?>' class="n2">文章</a></h1>

    <div class="index_about">
        <h2 class="c_titile"><?php echo $tittle;?></h2>
        <p class="box_c"><span class="d_time"><?php echo $time;?></span><span>编辑：<?php echo $author;?></span></p>
        <ul class="infos">
            <p><?php echo $concent;?></p>
        </ul>

        <br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br>
        <div class="keybq">




            <p><span>关键字词</span>：爱情,犯错,原谅,分手</p>

        </div>
        <div class="ad"> </div>
        <div class="nextinfo">
            <p>上一篇：<a href="/news/s/2013-09-04/606.html">程序员应该如何高效的工作学习</a></p>
            <p>下一篇：<a href="/news/s/2013-10-21/616.html">柴米油盐的生活才是真实</a></p>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
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
        </div>
    </div>
    <aside class="right">
        <!-- Baidu Button BEGIN -->
        <!-- Baidu Button END -->
        <div class="blank"></div>
        <div class="news">
            <h3>
                <p>栏目<span>最新</span></p>
            </h3>
            <ul class="rank">
                <?php
//                header('content-type:text/html; charset=utf8');
                $count = 0;

                $con = mysqli_connect($db_server, $db_user,$db_pwd,$db_table);
                $con->query("set names utf8");
                $sql = "select * from alltext";
                 $con->query('set names stf8');
                // mysqli_query("SET NAMES 'UTF8'");
                $rows = $con->query($sql);

                while( $row = $rows->fetch_assoc()) {
                //            print_r($row);
                //        print_r($row);
                if($count>10)break;
                $tittle = $row['tittle'];
                    $id = "more.php?id=".$row['id'];
                    ?>

                    <li><a href=<?php echo $id;?> title=<?php echo $tittle; ?>; target="_blank"><?php echo $tittle; ?></a></li>

                <?php
                $count++;
                }
                mysqli_close($con);

                ?>
            </ul>
            <h3 class="ph">
                <p>偶遇<span>文章</span></p>
            </h3>
            <ul class="paih">
                <?php
                $count =0 ;
                $count = 0;
                $con = mysqli_connect("localhost", "root", "","writer");
                $con->query("set names utf8");
                $sql = "select * from alltext";
                // $con->query('set names stf8');
                // mysqli_query("SET NAMES 'UTF8'");
                $rows = $con->query($sql);

                while( $row = $rows->fetch_assoc()) {
                    //            print_r($row);
                    //        print_r($row);
                    if ($count > 4) break;
                    $tittle = $row['tittle'];
                    $id = "more.php?id=".$row['id'];
                    ?>

                    <li><a href=<?php echo $id;?> title=<?php echo $tittle; ?>; target="_blank"><?php echo $tittle; ?></a></li>

                <?php
                    $count++;
                }
                mysqli_close($con);
                ?>
            </ul>
        </div>
    </aside>
</article>
<footer>
    <p>Design by Embedded training Demo.   动态网页制作</p>
</footer>

<script src="js/silder.js"></script>
</body>
</html>