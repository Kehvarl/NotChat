<?php 
	require_once("template_engine/template.php");
	require_once("includes/settings.php");

	function MakeColorList($current)
	{
		$found = false;
		$HTML = "";
		$colorfile = file("resources/colorlist.dat");
		foreach($colorfile as $key=>$colorline)
		{
			list($colorid,$color) = explode(",", $colorline);
			if(trim($color) == trim($current))
			{
				$HTML .= "<option selected ";
				$found = true;
			}
			else
			{
				$HTML .= "<option ";
			}
			$HTML .= "value=\"" . trim($color) . "\"style=\"";
			$HTML .= "background-color: #".DEFAULT_BGCOLOR.";color: #";
			$HTML .= $color . ";\">" . $colorid ."</option>\n";
		}

		if(!$found)
		{
			$HTML .= "<option selected ";
			$HTML .= "value=\"" . trim($current) . "\"style=\"";
			$HTML .= "background-color: #".DEFAULT_BGCOLOR.";color: #";
			$HTML .= trim($current) . ";\">Custom Color</option>\n";
		}

		return $HTML;
	}

	$UID = $_REQUEST['UID'];
	$username = $_REQUEST['username'];
	$chat = $_REQUEST['chat'];
	$color = trim($_REQUEST['color']);
	$font = $_REQUEST['font'];
	$bgcolor = $_REQUEST['bgcolor'];
	$emot = $_REQUEST['emot'];
	$font_opt = $_REQUEST['font_opt'];
	$bg_opt = $_REQUEST['bg_opt'];
	$logout_message = $_REQUEST['logout_message'];
	$ignore = $_REQUEST['ignore'];

	$onload = "onload=\"SetFocusMessage()\"";

	$show = PATH . 
			"show.php?UID=".$UID.
			"&bgcolor=".$bgcolor.
			"&font=".$font.
			"&color=".$color.
			"&chat=".$chat.
			"&emot=".$emot.
			"&bg_opt=".$bg_opt.
			"&font_opt=".$font_opt.
			"&ignore=".$ignore;

	$script = new Page('templates/chatformscript.tpl');
	$script->replace_tags(array(
			'REFRESH'	=> $show
			));

	$form = new Page('templates/chatform.tpl');
	$form->replace_tags(array(
			'ACTION'	=>	PATH . "notchat.php",
			'USERNAME'	=>	$username,
			'UID'		=>	$UID,
			'BGCOLOR'	=>	$bgcolor,
			'COLORLIST'		=>	MakeColorList($color),
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
			'CHAT'		=>	$chat,
			'STATUS'	=>	"Logged in as: " . $username,
			'FORM'		=>	$form->toHTML()
		));

	$page->output();

