<?php
	error_reporting(E_ALL);
	require_once("template_engine/template.php");
	require_once("includes/rot13.php");
	require_once("includes/dirscan.php");

	function logEntry($filename, $column)
	{
		$HTML = "><li class=\"column" . $column . "\" >";

		$HTML .= "<a href=\"" . $_SERVER['PHP_SELF'] . "?mode=index&view=" . 
				$filename . "\">" . 
				$filename . 
				"</a>";

		$HTML .= "<a href=\"" . $_SERVER['PHP_SELF'] . "?mode=delete&delete=" .
				$filename . "\">" . 
				"[ delete ]</a>\n";

		$HTML .="</li";

		return $HTML;
	}

	function logList()
	{
		$column = 1;
		$HTML = "<div class=\"loglist\"><ul";

		if(!$dir = dirscan('logs/'))
			die('could not read logs directory.');

		while($dir[0] == "." || $dir[0] == "..")
			array_shift($dir);
		
		for($i = 0; $i<count($dir); $i++)
		{
			$HTML .= logEntry($dir[$i], $column);
		}


		$HTML .= "></ul></div>";

		return $HTML;
	}

	function newLine($MType, $UFnt, $UCol, $UBG, $UName, $TargName, 
			$UMessage, $time, $IP, $decode)
	{
		$HTML = "<div class=\"post\" style=\"font-family: ";
		$HTML .= $UFnt . ",verdana,serif; color: #" . $UCol . "; ";
		$HTML .= "background-color: #" . $UBG . ";\">";

		if(0 == $MType)
		{
			$HTML .= "<span class=\"username\">" 
					.$UName . " </span> ";
		}
		else
		{
			$HTML .= "<span class=\"username\">PM From: " 
				.$UName . " To: " . $TargName . " </span> ";
			if($decode)
				$HTML .= "[" . rot13($UMessage). "]  ";
		}

		$HTML .= $UMessage . " <span class=\"time\">".$time;
		$HTML .= "</span> <span class=\"IP\">" . $IP . "</span></div>";
		return $HTML;
	}

	function chatPage($logfile, $decode)
	{
		$HTML = "";
		$tchat = "logs/" . $logfile;

		if(file_exists($tchat))
			$message_array = file($tchat);
		else
			return "";

		foreach($message_array as $line)
		{
			list($TargID,$SrcID,$UName,$TargName,$UBG,$UCol,$UFnt,
					$UMessage,$time, $IP) = explode("!~!",$line);


			if($UName != "")
				$UName = $UName.":";
			if(($time != "")&&($time != "\n"))
				$time = "-".$time;

			$UBG = str_replace("\"","",$UBG);
			$UCol = str_replace("\"","",$UCol);

			if($TargID == 0)
			{
				$HTML .= newLine(0, $UFnt, $UCol, $UBG, $UName, $TargName, 
						$UMessage, $time, $IP, $decode) . "\n";
			}
			else
			{
				$HTML .= newLine(1, $UFnt, $UCol, $UBG, $UName, $TargName, 
						$UMessage, $time, $IP, $decode) . "\n";
			}
		}

		return $HTML;
	}
	
//    This starts off the cases by setting the $mode if it isn't already.
// If $mode is not defined, set $mode to index
if(isset($_REQUEST['mode']))
	$mode = $_REQUEST['mode'];
if (empty($mode))
	$mode= 'index';

if(isset($_REQUEST['view']))
	$view = $_REQUEST['view'];
else
{
	$dir = dirscan('logs/');
	if(isset($dir[2]))
		$view = $dir[2];
	else
		$view = "";
	unset($dir);
}

if(isset($_REQUEST['decode']))
	$decode = $_REQUEST['decode'];
else
	$decode = false;

if(isset($_REQUEST['delete']))
	$delete = $_REQUEST['delete'];

//    Here is where we start switching the $mode and script the first case.
switch($mode) 
{
	case 'delete': 
	{
		//    If $delete is set or isn't empty, unlink (delete) the file.
		if ($delete != '' || isset($delete)) 
		{ 
			unlink("logs/" . $delete); 
		}
		header("Location: " . $PHP_SELF);
		break;
	}

	case 'index':
	{
		$page = new Page('templates/log.tpl');
		$page->replace_tags(array(
				'LIST'	=>	loglist(),
				'PAGE'	=>	chatPage($view, $decode)
			));
		$page->output();
		break;
	}

	default:
	{
		header("Location: " .  $_SERVER['PHP_SELF'] . "?mode=index");
	}
}

?>
