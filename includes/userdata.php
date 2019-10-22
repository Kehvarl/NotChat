<?php
	
	//function to search the elements in a UserData Array for a specified UID
	//	and return the Key for that element.
	function SearchArray($UID,$entries)
	{
		$done = 0;
		$ret = 999999;
		reset ($entries);
		while ((list($index, $line) = each ($entries)) && ($done == 0)) 
		{
			$val = strtok($line,"|");
			$val = strtok("|");
			if($val == $UID)
			{
				$ret = $index;
				$done = 1;
			}
		}
		return $ret;
	}

	//function to search the elements in a UserData Array for a specified 
	//	user name and return the UID for that user.
	function SearchArray_Name($User,$entries)
	{
		$done = 0;
		$ret = 999999;
		reset ($entries);
		while ((list($index, $line) = each ($entries)) && ($done == 0)) 
		{
			$val = strtok($line,"|");
			if(strtolower($val) == strtolower($User))
			{
				$ret = strtok("|");
				$done = 1;
			}
		}
		return $ret;
	}
	
	//function to take an array and a key and write all elements except for the element
	//	refered to by key to a variable. then return the variable.
	function RemoveElement($entries, $key)
	{
		$new_entries = "";
		reset ($entries);
		while ((list($index, $line) = each ($entries))) 
		{
			if ($index != $key)
			{
				$new_entries = $new_entries.$line;
			}
		}		
		return $new_entries;
	}
	
	function GetNameList($chat)
	{
		$ret = array();
		$ulist = $chat . "/" . $chat."_usr.dat";
		if(file_exists($ulist))
		{
			$user_array = file("$ulist"); 
	
			foreach($user_array as $line)
			{
				list($disp,$id,$status) = explode("|",$line);
				if ("lurking" != strtolower(trim($status)))
				{
					if ("away" != strtolower(trim($status)))
					{
						$ret[] = $disp;
					}
				}
			}	
		}
		return $ret;
	}

	/* Moved to includes/userdata.php
	//function to search the elements in a UserData Array for a specified UID
	//	and return the Key for that element.
	function SearchArray($UID,$entries)
	{
		$done = 0;
		$ret = 999999;
		reset ($entries);
		while ((list($index, $line) = each ($entries)) && ($done == 0)) 
		{
			$val = strtok($line,"|");
			$val = strtok("|");
			if($val == $UID)
			{
				$ret = $index;
				$done = 1;
			}
		}
		return $ret;
	}
	//function to search the elements in a UserData Array for a specified 
	//	user name and return the UID for that user.
	function SearchArray_Name($User,$entries)
	{
		$done = 0;
		$ret = 999999;
		reset ($entries);
		while ((list($index, $line) = each ($entries)) && ($done == 0)) 
		{
			$val = strtok($line,"|");
			if(strtolower($val) == strtolower($User))
			{
				$ret = strtok("|");
				$done = 1;
			}
		}
		return $ret;
	}
	//function to take an array and a key and write all elements except for the element
	//	refered to by key to a variable. then return the variable.
	function RemoveElement($entries, $key)
	{
		$new_entries = "";
		reset ($entries);
		while ((list($index, $line) = each ($entries))) 
		{
			if ($index != $key)
			{
				$new_entries = $new_entries.$line;
			}
		}		
		return $new_entries;
	}
	*/
?>