<?php
	require_once("template_engine/template.php");

	$page = new Page('templates/top.tpl');
	$page->replace_tags(array(
			'POSTS'		=>	"",
			'AD'		=>	"",
			'TITLE'		=>	"rpgchats",
		));

	$page->output();

?>