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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<link href="../css/uploadify.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {
    $(".menu").click(function() {
        $(this).toggleClass("active");
        $(".nav").slideToggle();
    });
    $(".nav > ul > li:has(ul) > a").append('<div class="arrow-bottom"></div>');
});
</script>
<style type="text/css">

.media_uploadify{
color:#69C;
font-family:"微軟正黑體";
width:100%;
float:left;
margin-top:15px;
margin-bottom:15px;
}

.youtube_uploadify{
color:#69C;
font-family:"微軟正黑體";
width:100%;
float:left;
margin-top:15px;
margin-bottom:15px;

}

</style>

</head>

<body>
<!---選單與LOGO-->
<div id="banner">
<span class="menu"></span>
<img src="../images/logo1.png" id="logo"/>
<?php 
        include_once("../php/root.php");
        if($_SESSION['account']){
			 include_once("php/banner_t.php");
		}
?>

</div>
<div id="page">
  <div id="content">
 <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
<label style="color:#69F;border-bottom:1px solid #DEF;">新增影片</label>
<!---上傳檔案-->
<div class="post">
	<div class="media_uploadify">
    	<h2>上傳影片</h2>
		<input type="file" name="uploadify" id="uploadify" /><br/>
        <p style="font-size:15px;">檔名請勿使用中文!<br/>僅接受 *.mp4、*.ogg、*.webm之檔案格式<br/></p>
		<input type="button" onclick="javascript:$('#uploadify').uploadifyUpload();" value="開始上傳">
		<input type="button" onclick="javascript:$('#uploadify').uploadifyClearQueue()" value="清空佇列">
	</div>
 	<div id="fileQueue"></div>
    <div id="filesUploaded"></div>
   
 </div>
  <br/><hr/>
<!---上傳youtube-->
<div class="post">
    <div class="youtube_uploadify">
      	<h2>匯入Youtube影片</h2>
         <div class="entry">
			<form name="insertmedia" method="post" action="php/insert_tube.php">
			<input type="text" id="beurl" name="url" value="請在這裡貼上Youtube影片的網址列" size="50">
			<input type="hidden" name="member_id" value=<?php echo($_SESSION['member_id']); ?>>
			<input type="hidden" name="public_date" value=<?php echo(date("Y-m-d",time())); ?>>
			<button type="submit" value="匯入" name="btn" id="download">匯入</button>
			</form>
		</div>
	</div>
</div>
<!---END content-->  
  </div>
</div>
<script type="text/javascript" src="../js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$("#uploadify").uploadify({
		'buttonText'	 : 'Browser',
		'uploader'       : 'swf/uploadify.swf',
		'script'         : 'uploadify.php',
		'cancelImg'      : './images/cancel.png',
		'queueID'        : 'fileQueue',
		'sizeLimit'		 : '8925684',	//8925684--8.8MB
		'fileDesc'    	 : '影片檔',
		'fileExt'  		 : '*.mp4;*.webm;*.ogg',
		'scriptData'	 : {'member_id':member_id},    /*這行是可以帶value到後端，但會有亂碼，所以前面才要base64編碼*/
		'auto'           : false,
		'multi'          : true,
		'queueSizeLimit' :'5',
		'onSelect'       :function(e, queueId, fileObj){
		if(fileObj.size > 8925684){
		alert(fileObj.name+"檔案太大，限制為8mb");
		$('#uploadify').fileUploadClearQueue(e);}
		},
		'onAllComplete'  :function(e, queueId, fileObj){
			alert('上傳成功，請至草稿夾發佈');
			window.location = 'php/uploadify.php';
		}
});
    

$("#download").click(function(){
	//var test = /http:\/\/www.youtube.com/.test($('#beurl').val());
	if($('#beurl').val()=="")
		alert("格式錯誤");
})

})

</script>
</body>
</html>
