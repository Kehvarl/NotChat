<?php
	require_once("template_engine/template.php");
	require_once("includes/settings.php");
	require_once("includes/logging.php");
	require_once("includes/display.php");
	require_once("includes/userdata.php");
	require_once("includes/timeout.php");

	function MakeColorList()
	{
		$HTML = "";
		$colorfile = file("resources/colorlist.dat");
		foreach($colorfile as $key=>$colorline)
		{
			list($colorid,$color) = explode(",", $colorline);
			if(0 == $key)
			{
				$HTML .= "<option selected ";
			}
			else
			{
				$HTML .= "<option ";
			}
			$HTML .= "value=\"" . $color . "\"style=\"";
			$HTML .= "background-color: ".DEFAULT_BGCOLOR.";color: #";
			$HTML .= $color . ";\">" . $colorid ."</option>\n";
		}

		return $HTML;
	}
	

	if(!isset($_REQUEST['chat']))
		$chat = "Main";
	else
		$chat = $_REQUEST['chat'];

	IsTimed_Out($chat);

	$form = new Page('templates/enterform.tpl');
	$form->replace_tags(array(
			'ACTION'	=>	PATH . "notchat.php",
			'COLORLIST'	=>	MakeColorList(),
			'CHAT'		=>	$chat
		));

	$page = new Page('templates/bottom.tpl');
	$page->replace_tags(array(
			'SCRIPT'	=>	"",
			'ONLOAD'	=>	"",
			'RELOAD'	=>	PATH . "preview.php?chat=".$chat,
			'STATUS'	=>	"",
			'CHAT'		=>	$chat,
			'FORM'		=>	$form->toHTML()
		));

	$page->output();
?>
