<?
	if($_GET[eng_title] != "")
	{
		$breadcrumbs->create_breadcrumbs("video", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
		
		/*
		echo "<div  style='float:right; width:230px;'>
		".$functions->create_content("video_right")."
		</div>";
		*/
	
		echo $video->one_video;
	}
	else
	{
		$breadcrumbs->create_breadcrumbs("video", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
		
		echo "<div  style='float:right; width:230px;'>
		".$functions->create_content("video_right")."
		</div>";
		
		echo $functions->create_content("video_top");;
		
		echo $photos->photo_list;
		
		echo $functions->create_content("video_bottom");
		echo $video->video_list;
	}
?>