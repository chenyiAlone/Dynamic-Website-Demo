<?php
    $count = 0;
    $db_server = 'localhost';
    $db_user = 'root';
    $db_pwd = '123456';
    $db_table = 'writer';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的文章</title>
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
    <h1 class="t_nav"><span><a href="index.php" class="n1">网站首页</a><a href="" class="n2">写作</a></h1>

    <div class="index_about">
        <h2 class="c_titile">开始你的写作：</h2>
        <p class="box_c"><span class="d_time">相遇总是猝不及防，而离别多是蓄谋已久，总有一些人会慢慢淡出你的生活，你要学会接受而不是怀念</span></p>
        <ul class="infos">
        	
        	<link rel="stylesheet" href="./kindeditor-4.0.6/themes/default/default.css" />
            <link rel="stylesheet" href="./kindeditor/plugins/code/prettify.css" />
            <script charset="utf-8" src="./kindeditor/kindeditor-all-min.js"></script>
            <script charset="utf-8" src="./kindeditor/lang/zh_CN.js"></script>
            <script charset="utf-8" src="./kindeditor//plugins/code/prettify.js"></script>
            <script>
                KindEditor.ready(function(K) {
                    var editor1=K.create('textarea[name="description"]',{//name=form中textarea的name属性
                        cssPath : './kindeditor/plugins/code/prettify.css',
                        uploadJson : './kindeditor/php/upload_json.php',
                        fileManagerJson : './kindeditor/php/file_manager_json.php',
                        allowFileManager : true,
                        afterCreate : function() {
                            var self = this;
                            K.ctrl(document, 13, function() {
                                self.sync();
                                K('form[name=myform]')[0].submit(); // name=form表单的name属性
                            });
                            K.ctrl(self.edit.doc, 13, function() {
                                self.sync();
                                K('form[name=myform]')[0].submit(); // name=form表单的name属性
                            });
                        }
                    });
                    prettyPrint();
                });
            </script>
            <div align="center">
              <form name="myform" method="post" action="preview.php">
                <textarea name="description" style="width:700px;height:700px;">
                </textarea>
                (提交快捷键: Ctrl + Enter)
                <br><br><br>
                <input type="submit"  name="button" value="全屏预览" />
            </form>
            </div>
            <br><br><br><br><br><br><br>

        	
        	
        
        
        
        
        
        
        <div class="keybq">
            <p><span>关键字词</span>：   </p>

        </div>
        <div class="ad"> </div>
        <div class="nextinfo">
        </div>
        <div class="otherlink">
            <h2>推荐文章</h2>
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
                    if($count>5)break;
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
//                                header('content-type:text/html; charset=utf8');
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

                $con = mysqli_connect($db_server, $db_user,$db_pwd,$db_table);
                $con->query("set names utf8");
                $sql = "select * from alltext";
                // $con->query('set names stf8');
                // mysqli_query("SET NAMES 'UTF8'");
                $rows = $con->query($sql);
                $count = 0;
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