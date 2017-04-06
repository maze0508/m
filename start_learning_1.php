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

<script>
//監聽video的各個属性
function init() {  
    document.video = document.getElementById("MovieShow");  
	init_events();  
}
function init_events(){  
if(true) {   
    document.video.addEventListener();  
    }  
}
</script>
<script>
//記錄註記時間
function record(){
    Media =  document.video = document.getElementById("MovieShow");
	$("#anchor_time").text(Math.floor(Media.currentTime));
}
 </script>
 
<style type="text/css">
#eform{
	color:#69C;	
}
#eform label{
	color:#69F;	
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
			 include_once("php/banner_s.php");
		}
?>

</div>
<div id="page">
  <div id="content">
  <img  style="width:20px;" src="../images/test/pic-Tit.png"/>
   <a href="group_study.php" title="學習主題" style="border-bottom:hidden;color:#69F">學習主題 </a>>>
			<?php 
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $url .= $row["url"];			   
					   $ident_catalog .= $row["ident_catalog"];
					   $name .= $row["name"];
					   $source_catalog .= $row["source_catalog"];
					   $title .= $row["title"];
					   $language .= $row["language"];
					   $description .= $row["description"];
					   $keyword .= $row["keyword"];
					   $coverage .= $row["coverage"];
					   $version .= $row["version"];
					   $role_catalog .= $row["role_catalog"];
					   $design_date .= $row["design_date"];
					   $cost .= $row["cost"];
					   $copyright .= $row["copyright"];
					   $ccdescript_catalog .= $row["ccdescript_catalog"];	
					   $found .= strstr($url,"youtube");			   
					}
				}	
			if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
			echo "<script>document.location.href='index.php'</script>";
			$query = "select user_media.url,user_media.title,user_media.media_type,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id' AND user_media.user_media_id = '$user_media_id'";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $user_media_id = $row["user_media_id"];
				   $learning_start = $row["learning_start"];				   
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	
				   $found = strstr($url,"youtube");	
				   $media_type .= $row['media_type']; 	
				   $title = $row["title"];					   
				   	echo "<label style='color:#69F'>$learning_name</label>";					
				}
				mysqli_free_result($result);
				?>	
                
	<div style="width:100%;overflow:auto;border:1px solid #DEF;">
               		<?php
                    if($title && $found){
                        //echo $url;
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				        //print_r($UrlArray); 
				    ?>
				        <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						/*else
						echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; */
						?>
				        <video id="MovieShow" preload="auto" controls loop width="100%" height="100%">
				    <?php
				        if(strstr($media_type,"mp4"))
				            echo "<source src=\"../user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"../user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"../user_movie/".$url.".webm\" type = 'video/webm'>";
				        //else
				            //echo "您的瀏覽器不支援HTML5影片播放";
				    ?>
				        </video>
				    <?php
						}
                    ?>   
            </div>
<!-- 播放器end / 留下註記start -->            
    <span type="text" id="anchor_time">0</span>
	<input type="text" id="anchor_descript"  size="50" maxlength="200" value=" 請將影片暫停在您欲註記的時間點.." />
	<label id="anchor" class='ibutton' style='border-bottom:hidden;background-color:#F60'><a href="javascript:record();">留下註記</a></label>
    
          
<!-- 留下註記end / 整理註記start -->
     <div style="float:right;width:120px">
		<a style='text-decoration: none;' href='group_study_note.php?user_media_id=<?php echo $user_media_id; ?>'><img src="../images/test/stu-cf3.png" /></a>
    </div>
<!-- 整理註記end -->   

  </div>
</div>
 

        
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
$(document).ready(function(){  




$("#anchor").click(function(){
if(member_id.length>=1){
$.post("php/insert_anchor_image_text.php",{member_id:member_id,user_media_id:user_media_id,url:url,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {
action='新增圖文註記'+$("#anchor_descript").val();;
record(member_id,action);
alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
});
}else
alert("請先登入");
})

$(".delete_button").live("click",function(){
	//alert("ok");
	if(member_id.length>=1){
		//var button_type="image";
		var media_anchor_id=$(this).parents('table').attr('id');
		//alert(media_anchor_id);
		//$.post("php/delete_anchor.php",{button_type:button_type,media_anchor_id:media_anchor_id,button:"delete"},function(data) {
		$.post("php/delete_anchor_text.php",{media_anchor_id:media_anchor_id,button:"delete"},function(data) {
			var del_anchor="table#"+media_anchor_id;
			action='刪除圖片註記';
			record(member_id,action);
			 $(del_anchor).remove();  
		});
	}else
	alert("請先登入");
})

//點擊註記會跳轉至相對影片位置
$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("");
})


$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})

function playerReady(obj) {
action='觀看影片-'+title;
record(member_id,action);
($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
	$("div.antime").parents('table').css("background-color","");
	$('#sidebar').scrollTop();
	$("div."+Math.floor(obj.position)).parents('table').css("background-color","#FC9");


//紀錄動作
function record(member_id,action){
	$.post("php/record.php",{member_id:member_id,action:action},function(data) {
	});
	
});
</script>
</body>
</html>
