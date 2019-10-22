<?php
	//function to determine if any users have times out
	function IsTimed_Out($chat="Main")
	{
		//open the chatfile, and get all entries
		$tmpchat = $chat . "/" . $chat . "_usr.dat";
		$message_array = file($tmpchat); 
		//Create an Empty String	
		$line="";
		//sort through entries
		//php3-compatible "foreach" loop
		reset ($message_array);
		while ((list(, $line) = each ($message_array))) 
		{
			if (($line != "") && ($line != "\n"))
			{
				list($username,$userid,$Post_Time) = split('[|]', $line, 3);
				//test for Post_Time - Current_Time > 30000 (30 seconds)
				if((trim($Post_Time) != "Lurking") && (trim($Post_Time) != "Away"))
				{
					if (((time() - $Post_Time) > 1900))
					{
						/*
						//Halloween Timeouts
						$msgArray = array(
							"stared too long into the abyss.",
							"got too distracted for their own safety...",
							"vanishes in a flash of lighting and puff of smoke as maddening laughter fills the air.",
							"is pulled screaming into the shadows.",
							"is carried off by some nice young men in clean white coats.",
							"stayed still too long and is dragged away by plot bunnies."
							);
						*/
						
						$msgArray = array(
							"has timed out.",
							"was consumed alive by feral plot bunnies.",
							"was sacrificed to the roleplay gods by a tribe of wild newbies.",
							"was sacrificed to the gods of RPGs by a vicious tribe of rampaging plot bunnies.",
							"got too distracted for their own good...",
							"doesn't post enough.",
							"has been fed to the plot bunnies for failure to participate"
								);
						
						timeout("(Timeout) ".$username, $userid, $chat, $msgArray[array_rand($msgArray)]);
					}
				}
			}
		} 
	}
	
	//User Has Timed Out
	function timeout ($username, $UID, $chat="Main", $logout_message)
	{
		if(empty($chat))
			$chat = "Main";
		$tchat = $chat . "/" . $chat . "_usr.dat";
		//assign userdata entries to array
		$entries = file($tchat);
		//find entry containing UID
		$key = SearchArray($UID,$entries);
		//delete entry containing UID
		if($key <> 999999)
		{
			$entries = RemoveElement($entries, $key);
		}
		//open userdata file
		$FILE = fopen($tchat,"w-");
		//write updated entries
		fputs($FILE,$entries);
		//close userdata file
		fclose($FILE);
		//replaces placeholders with spaces
		$username = str_replace("!~!"," ",$username);
		$username = stripslashes($username);
		$logout_message = str_replace("!~!"," ",$logout_message);
		//post logout to chat
		$time = date("h:i M d");
		$message = "<font size=1 face=verdana>[<font color=red>$username</font> $logout_message]</font>";
		Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
		$entries = file($tchat);
		if (count($entries) == 0)
            {
                //clear the chat
                    $open_file = fopen($chat . "/" . $chat . ".dat", "w");
                    fclose($open_file);
		    $message = "[Chat Cleared by: System::Timeout (No Users)]";
		    $time = date("h:i M d");
			Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,DEFAULT_FONT,$message,$time);
		}
	}
?>