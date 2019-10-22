<?php 
	require_once("template_engine/template.php");
	require_once("includes/settings.php");

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

	$onload = "onload=\"SetFocusMessage()\"";

	$show = PATH . 
			"show.php?UID=$UID&bgcolor=$bgcolor&font=$font&color=$color&".
			"chat=$chat&emot=$emot&bg_opt=$bg_opt&font_opt=$font_opt&".
			"ignore=$ignore\n";

	$script = new Page('templates/chatformscript.tpl');
	$script->replace_tags(array(
			'RESFRESH'	=> $show
			));

	$form = new Page('templates/chatform.tpl');
	$form->replace_tags(array(
			'ACTION'	=>	PATH . "notchat.php",
			'USERNAME'	=>	$username,
			'UID'		=>	$UID,
			'BGCOLOR'	=>	$bgcolor,
			'COLOR'		=>	$color,
			'FONT'		=>	$font,
			'CHAT'		=>	$chat,
			'EMOT'		=>	$emot,
			'BGOPT'		=>	$bg_opt,
			'FONTOPT'	=>	$font_opt,
			'IGNORE'	=>	$ignore,
			'LOGOUT'	=>	$logout_message
		));

	$page = new Page('templates/bottom.tpl');
	$page->replace_tags(array(
			'SCRIPT'	=>	$script->toHTML(),
			'ONLOAD'	=>	$onload,
			'RELOAD'	=>	$show,
			'STATUS'	=>	"Logged in as: " . $username,
			'FORM'		=>	$form->toHTML()
		));

	$page->output();

