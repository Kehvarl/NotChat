<?php 
 
function maskip($ip) 
{  
    $ipaddy = explode(".",$ip);  
    // take off ".$ipaddy[3]" if you want to ban dynamic addresses too.  
    $ipmask = $ipaddy[0].".".$ipaddy[1].".".$ipaddy[2].".".$ipaddy[3];  
    return $ipmask;  
}  

if ($status == 'ban')  
{  
 $targets[0] = ""; $addys[0] = "";
	foreach($_POST as $key => $value) 
	{ 
		if ($value == on)
		{
			list($user, $IP) = explode(":::", $key);
			array_push($targets, $user);
			array_push($addys, str_replace("_", ".", $IP));
		}
	}  
	// the part below depends how user info is stored
	$fpbanned = fopen ("ip.txt",'a-');
	$chat = file("show.php");
	$chat = array_reverse($chat);
	for ($i = 0; $i < sizeof($targets); $i++)
	{
		$towrite = $addys[$i]."::".$targets[$i]."::".date("Ymd.His")."\n";
		$message = "<font color=999999 face=verdana size=1><b>System Message!!</b> u r teh sux ".
			$targets[$i].", so you have been banned!</font><br>";
		fwrite($fpbanned,$towrite); 
		$chat[sizeof($chat)] = $message; 
	}
	fclose($fpbanned);
	$chat = array_reverse($chat);
	$fchat = fopen("show.php", 'w-');
	for ($i = 0; ($i < sizeof($chat) && $i <= 25); $i++)
	{
		fwrite($fchat, $chat[$i]);
	}
	fclose($fchat);
 } 
 else
 {
$Prisoners = file("ip.txt");
	 foreach($Prisoners as $Felon)
	 {
		list($Prisoner_ID, $Mug_Shot, $Hard_Time) = explode("::", $Felon);
		if ($_SERVER['REMOTE_ADDR'] == $Prisoner_ID)
		{
			$chat = file("show.php");
			$chat = array_reverse($chat);
			$chat[sizeof($chat)] = "<font color=999999 face=verdana size=1><b>System Message!!</b> ".
				$Mug_Shot." has been caught attempting to violate parole! Banned on: ".
				$Hard_Time."<br></font>";
			$chat = array_reverse($chat);
			$fchat = fopen("show.php", 'w-');
			for ($i = 0; ($i < sizeof($chat) && $i <= 25); $i++)
			{
				fwrite($fchat, $chat[$i]);
			}
			fclose($fchat);
			 die("<b>You suck so you were banned. We warned you though, so you deserved it! Try reading the MoonWings policies or listening to people when they yell at you!</b>"); 
	}		
         }
 }

$dir = opendir('logs');
while ($file = readdir($dir)) {
if ($file != '.' && $file != '..') {
$data[] = "$file";
} }
@reset($data); @rsort($data);

if (filesize("logs/$data[0]") > 30000 || !file_exists("logs/$data[0]") || $data[0] == '') { 

$flog = fopen("logs/$time2.log","a");
fwrite($flog,$message);
fclose($flog);

} else {

$flog = fopen("logs/$data[0]","a");
fwrite($flog,$message);
fclose($flog);
}

 ?>