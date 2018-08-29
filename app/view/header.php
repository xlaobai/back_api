<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>留言_xxx个人博客 - 一个站在web前端设计之路的女技术员个人博客网站</title>
    <meta name="keywords" content="个人博客,xxx个人博客,个人博客模板,xxx" />
    <meta name="description" content="xxx个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        window.onload = function ()
        {
            var oH2 = document.getElementsByTagName("h2")[0];
            var oUl = document.getElementsByTagName("ul")[0];
            oH2.onclick = function ()
            {
                var style = oUl.style;
                style.display = style.display == "block" ? "none" : "block";
                oH2.className = style.display == "block" ? "open" : ""
            }
        }
    </script>
    <link href="/static/css/styles.css" rel="stylesheet"></head>
<body>
<header>
    <div class="tophead">
        <div class="logo"><a href="/">xxx个人博客</a></div>
        <div id="mnav">
            <h2><span class="navicon"></span></h2>
            <ul>
                <li><a href="index.html">网站首页</a></li>
                <li><a href="about.html">关于我</a></li>
                <li><a href="share.html">模板分享</a></li>
                <li><a href="list.html">学无止境</a></li>
                <li><a href="info.html">慢生活</a></li>
                <li><a href="gbook.html">留言</a></li>
            </ul>
        </div>
        <nav class="topnav" id="topnav">
            <ul>
                <li><a href="index.html">网站首页</a></li>
                <li><a href="about.html">关于我</a></li>
                <li><a href="share.html">模板分享</a></li>
                <li><a href="list.html">学无止境</a></li>
                <li><a href="info.html">慢生活</a></li>
                <li><a href="gbook.html">留言</a></li>
                <?php
                    foreach ( $cate as $value) {
                        echo '<li><a href="gbook.html">'.$value['catename'].'</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>