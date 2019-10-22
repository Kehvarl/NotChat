<?php
	require_once("template_engine/template.php");
	require_once("includes/rot13.php");
	require_once("includes/postfix.php");

	function userList($chat)
	{
		$HTML = "";
		$ulist = $chat . "/" . $chat."_usr.dat";
		if(file_exists($ulist))
		{
			$user_array = file("$ulist"); 

			foreach($user_array as $line)
			{
				list($disp,$id,$status) = explode("|",$line);
				if ("lurking" != strtolower($status))
				{
					$HTML .=  $disp;
					if ("away" == strtolower($status))
					{
						$HTML .= "-Away";
					}
					$HTML.=", ";
				}
			}	
		}
		return $HTML;
	}

	function newLine($MType, $UFnt, $UCol, $UBG, $UName, $TargName, 
			$UMessage, $time)
	{
		$HTML = "<div class=\"post\" style=\"font-family: ";
		$HTML .= $UFnt . ",verdana,serif; color: #" . $UCol . "; ";
		$HTML .= "background-color: #" . $UBG . ";\">";

		if(0 == $MType)
		{
			$HTML .= "<span class=\"username\">" 
					.$UName . "</span> ";
		}

		$HTML .= $UMessage . " <span class=\"time\">".$time;
		$HTML .= "</span></div>";
		return $HTML;
	}

	function chatPage($chat)
	{
		$HTML = "";
		$tchat = $chat . "/" .$chat.".dat";
		if(file_exists($tchat))
		{
			$message_array = file($tchat);

			foreach($message_array as $line)
			{
				list($TargID,$SrcID,$UName,$TargName,$UBG,$UCol,$UFnt,
						$UMessage,$time) = explode("!~!",$line);


				if($UName != "")
					$UName = $UName.":";
				if(($time != "")&&($time != "\n"))
					$time = "-".$time;

				if($TargID == 0)
				{
					$HTML .= newLine(0, $UFnt, $UCol, $UBG, $UName, $TargName, 
							$UMessage, $time);
				}
			}
		}
		return $HTML;
	}

	$chat = trim($_REQUEST['chat']);

	if (!isset($chat) || empty($chat) || !file_exists($chat . "/" . $chat . ".dat"))
		header("Location: error.php");

	//Create an Empty String	
	$uList = userList($chat);

	$cPage = chatPage($chat);

	$chat = new Page('templates/chat.tpl');
	$chat->replace_tags(array(
			'USERLIST'	=>	$uList,
			'CHAT'		=>	$cPage
		));

	$page = new Page('templates/main.tpl');
	$page->replace_tags(array(
			'CONTENT'	=>	$chat->toHTML()
		));

	$page->output();
?>