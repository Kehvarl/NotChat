<?php

	if(isset($_REQUEST['username']) && !empty($_REQUEST['username']))
	{
		require_once("template_engine/template.php");
		$UID = $_REQUEST['UID'];
		$username = $_REQUEST['username'];
		$chat = $_REQUEST['chat'];
		$color = $_REQUEST['color'];
		$font = $_REQUEST['font'];
		$bgcolor = $_REQUEST['bgcolor'];
		$emot = $_REQUEST['emot'];
		$font_opt = $_REQUEST['font_opt'];
		$bg_opt = $_REQUEST['bg_opt'];
		$logout_message = $_REQUEST['logout_message'];
		$ignore = $_REQUEST['ignore'];

		$main = "show.php?UID=$UID&chat=$chat&color=$color&font=$font&".
				"bgcolor=$bgcolor&emot=$emot&font_opt=$font_opt&".
				"bg_opt=$bg_opt&ignore=$ignore";

		$bottom = "chatform.php?username=$username&UID=$UID&chat=$chat&".
				"color=$color&font=$font&bgcolor=$bgcolor&emot=$emot&".
				"font_opt=$font_opt&bg_opt=$bg_opt&".
				"logout_message=$logout_message&ignore=$ignore";

		$page = new Page('templates/frameset.tpl');
		$page->replace_tags(array(
				'TITLE'		=>	"title.php",
				'MAIN'		=>	$main,
				'BOTTOM'	=>	$bottom
			));

		$page->output();
	}
	else
		header("Location: login.php");
?>