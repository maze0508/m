<?php 

        echo "<link href='mobile_css.css' rel='stylesheet' type='text/css'/>
<nav class='nav'><ul><li id='ald' style='height:50px;'><h3>".$_SESSION['user_name']." 同學</h3></li>
        <li>
            <a href='#' accesskey='2' title='學習主題'>學習主題</a>
            <ul>
                <li><a href='start_learning_0_2.php'>小組主題</a></li>
                <li><a href='group_study.php'>個人主題</a></li>
            </ul>
        </li>
        <li>
        	 <a href='start_learning_0_3.php' accesskey='2' title='我的收藏'>我的收藏</a>    
        </li>
		<li><a href='learning_books_list.php' accesskey='4' title='筆記本'>筆記本</a></li>       
		<li><a href='../php/logout.php' title='登出'>登出</a></li>               
    </ul></nav>"
	?>