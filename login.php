<?php
	require_once('template_engine/template.php');
	require_once('includes/settings.php');

	if(isset($_REQUEST['chat']))
		$chat = $_REQUEST['chat'];
	else
		$chat = "Main";

	$page = new Page('templates/frameset.tpl');

	$title = "title.php?chat=".$chat;
	$main = "blank.html";//"preview.php?chat=".$chat;
	$bottom = "enter.php?chat=".$chat;

	$page->replace_tags(array(
			'TITLE'		=>	$title,
			'MAIN'		=>	$main,
			'BOTTOM'	=>	$bottom
		));

	$page->output();
?>