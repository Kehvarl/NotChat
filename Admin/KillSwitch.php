<?php
	require_once("../includes/userdata.php");
	require_once("../includes/timeout.php");

	//function to update userdata file with new time.
	function Kill($chat, $username)
	//function Update_DataFile($chat, $UID, $username)
	{
		$tchat = "../" . $chat . "/" . $chat . "_usr.dat";
		//assign userdata entries to array
		$entries = file($tchat);
		$ret = 0;
		//find entry containing UID
		$UID = SearchArray_Name($username,$entries);
		$key = SearchArray($UID, $entries);
		if ($key != 999999)
		{
			//open file
			$FILE = fopen($tchat,  "w-");
			//write all entries, keeping non-changing entries intact while updating
			//the entry that changes.
			reset ($entries);
			while ((list($index, $line) = each ($entries))) 
			{
				if ($index != $key && !empty($line))
				{
					fputs($FILE, $line);
				}
				else
				{
						$entry = $username."|".($UID - 1)."|".time()."\n";	
						fputs($FILE, $entry);	
						$ret = 1;
				}
			}		
			fclose($FILE);
			$ret = 1;
		}
		return $ret;
	}

	Kill($_REQUEST['chat'], str_replace("!~!", " ", $_REQUEST['name']));
	echo "Success";
	
?>