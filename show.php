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
				if ("lurking" != strtolower(trim($status)))
				{
					$HTML .= "<a href=\"#\" onclick=\"parent.frames[2].setPMTo('"
							. $disp . "')\" class=\"username\">" . $disp;
					if ("away" == strtolower(trim($status)))
					{
						$HTML .= "-Away";
					}
					$HTML .= "</a>, ";
				}
			}	
		}
		return $HTML;
	}

	function newLine($MType, $UFnt, $UCol, $UBG, $UName, $TargName, 
			$UMessage, $time)
	{
		$HTML = "<div style=\"font-family: ";
		$HTML .= $UFnt . ",verdana,serif; color: #" . $UCol . "; ";
		$HTML .= "background-color: #" . $UBG . ";\" class=\"post";

		if(0 == $MType)
		{
			$HTML .= "\"><span class=\"username\">" 
					.$UName . "</span> ";
		}
		elseif(1 == $MType)
		{
			$HTML .= " PM\"><span class=\"username\">PM From: " 
				.$UName . "</span> ";
		}
		else
		{
			$HTML .= " PM\"><span class=\"username\">PM To: " 
					.$TargName . "</span> ";
		}

		$HTML .= $UMessage . " <span class=\"time\">".$time;
		$HTML .= "</span></div>";
		return $HTML;
	}

	function chatPage($chat, $UID, $postfail, $ignoring)
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

				$to_ignore = array_search($SrcID, $ignoring);

				if(($to_ignore === false))
				{
					if($postfail)
							$Umessage = Rot13($Umessage,true, $postfail);
					if($UName != "")
						$UName = $UName.":";
					if(($time != "")&&($time != "\n"))
						$time = "-".$time;

					if($TargID == 0)
					{
						$HTML .= newLine(0, $UFnt, $UCol, $UBG, $UName, $TargName, 
								$UMessage, $time);
					}
					elseif($TargID == $UID)
					{
						$HTML .= newLine(1, $UFnt, $UCol, $UBG, $UName, $TargName,
								Rot13($UMessage), $time);
					}
					elseif($SrcID == $UID)
					{
						$HTML .= newLine(2, $UFnt, $UCol, $UBG, $UName, $TargName,
								Rot13($UMessage), $time);
					}
				}
			}
		}
		return $HTML;
	}

	$UID = $_REQUEST['UID'];
	$username = $_REQUEST['username'];
	$chat = trim($_REQUEST['chat']);
	$color = $_REQUEST['color'];
	$font = $_REQUEST['font'];
	$bgcolor = $_REQUEST['bgcolor'];
	$emot = $_REQUEST['emot'];
	$font_opt = $_REQUEST['font_opt'];
	$bg_opt = $_REQUEST['bg_opt'];
	$ignoring = explode("!~!", $_REQUEST['ignore']);

	if (!isset($chat) || empty($chat) || !file_exists($chat . "/" . $chat . ".dat"))
		header("Location: error.php");

	//Create an Empty String	
	$uList = userList($chat);

	//determine frequency of post display failure
	$postfail = postfix(file("Admin/postfix.dat"));

	$cPage = chatPage($chat, $UID, $postfail, $ignoring);

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