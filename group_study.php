<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Video Learning</title>

<link href="mobile_css.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});
</script>


</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<nav class="nav">
 <?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
        echo "<p><span id='ald'>".$_SESSION['user_name']." 同學</span></p>";
        }
        ?>
    <ul>
    <li></li>
 
        <li>
            <a href='#' accesskey='2' title='學習主題'>學習主題</a>
            <ul>
                <li><a href='group_study.php'>小組主題</a></li>
                <li><a href='start_learning_0_2.php'>個人主題</a></li>
            </ul>
        </li>
        <li>
        	 <a href='start_learning_0_3.php' accesskey='2' title='我的收藏'>我的收藏</a>    
        </li>
		<li><a href='learning_books_list.php' accesskey='4' title='筆記本'>筆記本</a></li>       
		<li><a href='../php/logout.php' title='登出'>登出</a></li>               
    </ul>
</nav>

</div>
<div id="page">
  <div id="content">

  </div>
</div>
  
</body>
</html>
