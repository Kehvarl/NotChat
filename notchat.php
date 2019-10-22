<?php

require_once("includes/settings.php");
require_once("includes/logging.php");
require_once("includes/display.php");
require_once("includes/userdata.php");
require_once("includes/timeout.php");
require_once("includes/chattags.php");
require_once("includes/rot13.php");
require_once("includes/boredlist.php");

define(AdminPassword, "pugbutts42");
define(hunter2, "hunter2");
define(replace, "*******");

$kissTemplates = array(
  "{chatter} makes out with {target}.",
  "{chatter} snogs {target}'s brains out.",
  "{chatter} drags {target} into a closet for 7 Minutes in Heaven.",
  "{target} finds themselves helpless to resist {chatter}'s steamy kiss.",
  "{chatter} licks {target}'s face!"
);

$meanTemplates = array(
    "{chatter} is mean to {target}.",
    "{chatter} picks on {target}.",
    "{target} is the subject of {chatter}'s insult.",
    "\"{target} sucks\" -{chatter}",
	"\"{target} smells\" -{chatter}",
	"{chatter} has a very important message for {target}: \"You're lame!\""
);

$lickTemplates = array(
  "{chatter} licks {target}.",
  "{chatter} proceeds to enjoy {target}'s flavor."
);

$insult = array(
  array("artless", "bawdy", "beslubbering", "bootless", "churlish",
                     "cockered", "clouted", "craven", "currish", "dankish",
                     "dissembling", "droning", "errant", "fawning", "fobbing",
                     "froward", "frothy", "gleeking", "goatish", "gorbellied",
                     "impertinent", "infectious", "jarring", "loggerheaded",
                     "lumpish", "mammering", "mangled", "mewling", "paunchy",
                     "pribbling", "puking", "puny", "quailing", "rank", "reeky",
                     "roguish", "ruttish", "saucy", "spleeny", "spongy",
                     "surly", "tottering", "unmuzzled", "vain", "venomed",
                     "villainous", "warped", "wayward", "weedy", "yeasty"),
  array("base-court", "bat-fowling", "beef-witted",
                     "beetle-headed", "boil-brained", "clapper-clawed",
                     "clay-brained", "common-kissing", "crook-pated",
                     "dismal-dreaming", "dizzy-eyed", "doghearted",
                     "dread-bolted", "earth-vexing", "elf-skinned",
                     "fat-kidneyed", "fen-sucked", "flap-mouthed", "fly-bitten",
                     "folly-fallen", "fool-born", "full-gorged", "guts-griping",
                     "half-faced", "hasty-witted", "hedge-born", "hell-hated",
                     "idle-headed", "ill-breeding", "ill-nurtured",
                     "knotty-pated", "milk-livered", "motley-minded",
                     "onion-eyed", "plume-plucked", "pottle-deep",
                     "pox-marked", "reeling-ripe", "rough-hewn",
                     "rude-growing", "rump-fed", "shard-borne",
                     "sheep-biting", "spur-galled", "swag-bellied",
                     "tardy-gaited", "tickle-brained", "toad-spotted",
                     "urchin-snouted", "weather-bitten"),
  array("apple-john", "baggage", "barnacle", "bladder", "boar-pig",
                     "bugbear", "bum-bailey", "canker-blossom", "clack-dish",
                     "clotpole", "coxcomb", "codpiece", "death-token",
                     "dewberry", "flap-dragon", "flax-wench", "flirt-gill",
                     "foot-licker", "fustilarian", "giglet", "gudgeon",
                     "haggard", "harpy", "hedge-pig", "horn-beast",
                     "hugger-mugger", "jolthead", "lewdster", "lout",
                     "maggot-pie", "malt-worm", "mammet", "measle", "minnow",
                     "miscreant", "moldwarp", "mumble-news", "nut-hook",
                     "pigeon-egg", "pignut", "puttock", "pumpion", "ratsbane",
                     "scut", "skainsmate", "strumpet", "varlet", "vassal",
                     "whey-face", "wagtail"),
);

$praise = array(
  array("airy","amorous","balmy","bespiced","beteeming","blazoning","bonny",
        "brisky","candied","celestial","chafeless","choicely","courtly","dainty",
        "daisied","damasked","enchanting","engilded","fettled","honeysuckle",
        "jovial","leavened","lusty","mannerly","marbled","meek","nonpareil",
        "orbed","palmy","posied","replenished","sightly","silken","sovereign",
        "sphery","sterling","sturdy","taffeta","tenderful","virginal","virtuous",
        "worthy","rare","sweet","fruitful","brave","sugared","flowering","precious",
        "gallant","delicate","celestial"),
  array ("honey-tongued","well-wishing","fair-faced","best-tempered","tender-hearted",
         "tiger-booted","smooth-faced","thunder-darting","sweet-suggesting",
         "young-eyed","all-hollown","alms-deed","burly-boned","cheek-roses",
         "crow-flowered","choice-drawn","deed-achieving","eagle-sighted",
         "ear-kissing","ear-bussing","even-preached","eye-beaming","face-royal",
         "fairy-gold","fertile-fresh","full-acorned","gallant-springing",
         "heaven-hued","honey-bagged","leaping-time","love-springing",
         "life-rendering","marble-constant","May-morn","nimble-pinioned","nose-herb",
         "parti-coloured","proud-pied","right-drawn","silver-shredding","smoothy-pated",
         "softly-sprighted","sweet-seasoned","tender-smelling","trice-crowned",
         "tiger-footed","top-gallant","truest-mannered","weeping-ripe","well-breathed",
         "well-breathed","young-eyed"),
  array ("smilet","toast","cukoo-bud","nose-herb","wafer-cake","pigeon-egg",
         "welsh cheese","song","true-penny","valentine","aglet-baby","argosy",
         "bawcock","bona-roba","bully rook","chuck","coach-fellow","crystal-button",
         "cuckoo-bud","dewberry","eglantine ","esquire","flax-wench","fondling","gamester",
         "handy-dandy","heartling","homager","juvenal","kicksy-wicksy","kid-fox","lambskin",
         "lodestar","madonna","minstrel","nicety","nymph","pew-fellowed","pittikins","prizer",
         "primrose","rarity","ringlet","shoulder-clapper","sweet-meat","thunder-maker",
         "time-pleaser","turtle-dove","wafer-cake","whiffler","wit-snapper","velvet guard")
);

$bored = array(
    "boring",
    "lame",
    "bland",
    "unoriginal",
    "snood",
    "a dwarf",
    "stale",
    "an elf",
    "stuffy",
    "an archer",
    "lazy",
    "an orc",
    "a goblin",
    "weary",
    "tiring",
    "a little teapot"
);

$dateTemplates = array(
    "{chatter}, does this look like a dating service to you?",
    "{chatter} might be feeling a bit lonely.",
    "{chatter} went looking for {type}... They have not been seen since."
);

$rulebreakerLogins = array(
    "has been stripped of their special characters. Tried to log in as {user}"
);

// This is the public list of random Logout Messages.

$logoutMessages = array(
    "has logged out.",
    "fled in terror.",
    "melts away.",
    "is off to feed the plot bunnies.",
    "is off to rescue a damsel in distress!",
    "escapes to a secret lair!"
	);

//Halloween Replacements
/*
$logoutMessages = array(
    "has been taken by the monster under the bed.",
    "fled in terror.",
    "melts away.",
    "cackles madly as the lightning flashes.",
    "is experimenting on plot bunnies.",
    "howls in the moonlight.",
    "trick or...",
    "is off to put a damsel in distress!",
    "scurries to a hidden lab!"
	);
*/

//These messages may only be accessed using the /logout_2 command
$secretLogoutMessages = array(
    "is off to rescue a damsel from her dress.",
    "is off to guard the hoard of a dragon."
	);

//These messages only apply to Stephanie/Elyd/Elydanie
$stephanieLogoutMessages = array(
    "waggles her fingers and poofs.",
    "put a spell on you.",
    "psychs you out in the end."
	);

//These messages only apply to Gibs
$gibsLogoutMessages = array(
    "is off to AXE someone a question.",
    "was here, now he's gone to play with an axe.",
    "introduces the new, improved BanAxe with extra sharpness.",
    "sneers at your wall-hangers.",
    "violences in your general direction."
	);

//These messages only apply to Esthalia --  Requested 9/12/2013
$esthaliaLogoutMessages = array(
    "is off to teach the bishes how its done.",
    "steals your breath away.",
    "seduces the masses and leaves them hanging!",
    "flaunts what she's got.",
    "explodes into the flames of passion.",
    "is carried off by her harem.",
    "will see you in your dreams"
	);

$esthaliaLoginMessages = array(
        "A fanboy squeals with delight.",
        "Why aren't you all in the Inn?!",
        "Roll Will vs Charm... You failed.",
        "Stop drooling, you'll make a mess of the chat"
);

//These messages only apply to Dawn
$dawnLogoutMessages = array(
    "wiggles away to put a dent in the hero's plans.",
    "was the turkey all along!",
    "skitters up into the air vent and out of sight.."
	);

//These messages only apply to Jared555
$jaredLogoutMessages = array(
    "will turn off the server in 3... 2... 1...",
//    "knows you want <a href='https://www.iwakuroleplay.com/pages/hosting/'>hosting</a> from the hostman.",
    "has more fun over there."
	);

//These messages only apply to Tribs
$tribsLogoutMessages = array(
    "is the monster you were always warned about.",
    "- gentleman butler by day, charismatic villain by moonlight",
    "informs his resin minions to jumpstart the plot bunnies.",
    "saunters right on out.",
    "leaves a trail of golden glitter as he goes"
	);

$dianaLogoutMessages = array(
    "jumps out of the window.",
    "is off to be a damsel in distress.",
    "is going to strangle a muse.",
    "was here, and now is not here.",
    "throws teal paint on everything.",
    "runs away cackling wickedly.",
    "skitters away leaving mayhem and terror.",
    "slinks back into the admin box.",
    "flounces away."
	);

$elleLogoutMessages = array(
    "is distracted by Meme.",
    "scatters Dust Bunnies everywhere and escapes in the confusion!",
    "chirp chirp chirp."
    );

$butterflyLoginMessages= array(
    "GLITTER EXPLODES EVERYWHERE.",
    "{chatter} is always watching, sometimes even during sex.",
    "AND SO THE OWLCAT COMETH.",
    "You can run, and you can hide, but {chatter} probably already peed there!",
    "{chatter} bursts into tears."
	);

//Usernames that cannot be selected randomly by /spin or /kiss
$spinExclusions = array(
  "Kehvarl",
  "Ocha",
  "Vay",
  "jared555"
);

//define all functions prior to first reference (just incase they're not running PHP4)
 //login to chat
    function login ($username, $login_message, $logout_message, $chat, 
            $color="000000", $font="Courrier New", $bgcolor="000000", $emot=1, 
            $font_opt=1, $bg_opt=1)
    {
	global $logoutMessages;
	$logout_message = $logoutMessages[array_rand($logoutMessages)];
	
        $username = str_replace("!~!"," ",$username);
	
	if($username == "Gibs")
	{
	    global $gibsLogoutMessages;
	    $logout_message = $gibsLogoutMessages[array_rand($gibsLogoutMessages)];
	}
	
	if(($username == "Stephanie") || ($username == "Elyd") ||($username == "StElydphanie"))
	{
	    global $stephanieLogoutMessages;
	    $logout_message = $stephanieLogoutMessages[array_rand($stephanieLogoutMessages)];
	}
	
	if($username == "Esthalia")
	{
	    global $esthaliaLogoutMessages;
	    $logout_message = $esthaliaLogoutMessages[array_rand($esthaliaLogoutMessages)];
	}
	
	if($username == "Diana")
	{
	    global $dianaLogoutMessages;
	    $logout_message = $dianaLogoutMessages[array_rand($dianaLogoutMessages)];
	}
	
	if($username == "Dawn")
	{
	    global $dawnLogoutMessages;
	    $logout_message = $dawnLogoutMessages[array_rand($dawnLogoutMessages)];
	}
	
	if(($username == "Jared555") || ($username == "jared555"))
	{
	    global $jaredLogoutMessages;
	    $logout_message = $jaredLogoutMessages[array_rand($jaredLogoutMessages)];
	}
	
	if(($username == "Tribs") || ($username == "Tribulum"))
	{
	    global $tribsLogoutMessages;
	    $logout_message = $tribsLogoutMessages[array_rand($tribsLogoutMessages)];
	}
	
	if($username == "Elle")
	{
	    global $elleLogoutMessages;
	    $logout_message = $elleLogoutMessages[array_rand($elleLogoutMessages)];
	}
        
        if("main" == strtolower($chat) && preg_match('/[^A-Za-z0-9 ]/',$username))
        {
            global $rulebreakerLogins;
            $oldname = $username;
            $username = preg_replace('/[^A-Za-z0-9 ]/', '', $username);
            $login_message = $rulebreakerLogins[array_rand($rulebreakerLogins)];
            $login_message = str_ireplace("{user}", $oldname, $login_message);
        }
        
    if((stripos($username, "Auken")!== false))
    {
        header("Location: https://www.iwakuroleplay.com/");
    }
    
	if((stripos($username, "Konata")!== false))
        {
            $login_message = "thinks they're so smart...";
            $logout_message = "thought they were hot stuff.";
        }
	
	$color = trim($color);
	if(strtolower($color) == "ffffff")
	    $color = randomColor();
	$bgcolor=DEFAULT_BGCOLOR;
	$emot=1;
	$font_opt=1;
	$bg_opt=1;

        //Random Failure Starts Here
		$failures = file("Admin/rf.dat");
		$failed = false;
		foreach($failures as $failureline)
		{
			list($failurename, $loginfail, $postfail) =
					explode("|", $failureline);
			if(trim(strtolower($username)) == $failurename)
			{
				if($loginfail >= rand(1,10))
				{
					header("HTTP/1.0 404 Not Found");
					$failed = true;
					break;
				}
			}
		}
		if($failed)
			exit(0);
        //Random Failure Ends Here

        $tchat = $chat . "/" . $chat."_usr.dat";
        //generate UID (last UID + random number)
        $UID = GetOldUID($tchat) + rand(1,32767);
        //assemble entry
        $entry = $username."|".$UID."|".time()."\n";
        //store old userdata file
        $old_data = file($tchat);
	
	if((stripos($username, "Kehv")!== false) ||
	   (stripos($username, "Kitti")!== false) ||
	   (stripos($username, "Vay")!== false) ||
	   (stripos($username, "Gibs")!== false) ||
	   (stripos($username, "Jared")!== false) ||
	   (stripos($username, "Diana")!== false))
	{
	    array_unshift($old_data, $entry);
	}
	else
        {
	    $old_data[] = $entry;
	}
	        
	//open userdata file
        $FILE = fopen ($tchat, "w-");
	
	fputs($FILE , join("" , $old_data));
        //close file
        fclose($FILE);
        //post login to chat
        $login_message = stripslashes(str_replace("!~!"," ",$login_message));
        $time = date("h:i M d");

        $message = "[$username $login_message]";
        //$message = preg_replace_callback( '#[Bb]+[Oo]+[Rr]+[Ee]+[Dd]+#', function($m){return bored();}, $message );
        
        Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,
                "Courrier New",$message,$time);
	
	if(stripos($username, "Diana") !== false)
	{
	    global $butterflyLoginMessages;
	    $message = $butterflyLoginMessages[array_rand($butterflyLoginMessages)];
	    $message = str_ireplace("{chatter}", $username, $message);
	    Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,CCFF00,
			 "Verdana",$message,$time);
	}
    
	if(stripos($username, "Esthalia") !== false)
	{
	    global $esthaliaLoginMessages;
	    $message = $esthaliaLoginMessages[array_rand($esthaliaLoginMessages)];
	    $message = str_ireplace("{chatter}", $username, $message);
	    Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,CCFF00,
			 "Verdana",$message,$time);
	}
	
	if((stripos($username, "Konata")!== false))
	{
	    logout($username, $UID, $chat, $logout_message);
	}

        //replaces spaces with placeholder
        $username = str_replace(" ","!~!",$username);
	$logout_message = str_replace(" ","!~!",$logout_message);
	$color = str_replace(array(" ","\n","\\"), array("","",""), stripslashes($color));
        //go to chat
	$location = "frame.php?"."username=$username&UID=$UID&chat=$chat&".
	    "font=$font&bgcolor=$bgcolor&logout_message=$logout_message&color=$color&".
	    "emot=$emot&font_opt=$font_opt&bg_opt=$bg_opt";
	$loc = str_replace(array(" ","\n","\\"), array("","",""), stripslashes($location));
        header("Location: " . $loc);
    }

	//logout of chat
    function logout ($username, $UID, $chat, $logout_message)
    {
        $tchat = $chat . "/" . $chat . "_usr.dat";
        //assign userdata entries to array
        $entries = file($tchat);
        //find entry containing UID
        $key = SearchArray($UID,$entries);
        //delete entry containing UID
        if($key <> 999999)
        {
            $entries = RemoveElement($entries, $key);
            //open userdata file
            $FILE = fopen($tchat,"w-");
            //write updated entries
            fputs($FILE,$entries);
            //close userdata file
            fclose($FILE);
            //replaces placeholders with spaces
        $username = stripslashes($username);
            $username = str_replace("!~!"," ",$username);
            $logout_message = str_replace("!~!"," ",$logout_message);
            //post logout to chat
            $time = date("h:i M d");
            $message = "<font size=1 face=verdana>[<font color=red>(Logout) $username".
					"</font> $logout_message]</font>";
            Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,
					DEFAULT_TEXT_COLOR,DEFAULT_FONT,$message,"(($time))");
            $entries = file($tchat);
            if (count($entries) == 0)
            {
                //clear the chat
				$open_file = fopen($chat . "/" . $chat .".dat", "w");
				fclose($open_file);
				$message = "[Chat Cleared by: System::Timeout ".
						"(THERE IS NO ONE IN THIS BOX. KIDNAP SOMEONE AND MAKE IT LIIIIIVE.)]";
				$time = date("h:i M d");
						Display_Text($chat,0,0,"","",
								DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,
								DEFAULT_FONT,$message,$time);
				if (date("m.d") == "5.14")
				{
							$message = rot13("UNCCL ZBBAJVATF OVEGUQNL, ".
									"QVNAN!! <3 Xruil");
							$time = date("h:i M d");
							Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,
									DEFAULT_TEXT_COLOR,DEFAULT_FONT,
									$message,$time, "[SYSTEM]");
				}
            }
            IsTimed_Out($chat);
        }
        header("Location: http://triadsoftware.net/Chat/");
    }
	//post message to chat
	function Post_Message($username, $UID, $message, $logout_message, 
			$chat="Main", $color="FFFFFF", $font="verdana", $bgcolor=DEFAULT_BGCOLOR, 
			$emot=1, $font_opt=1, $bg_opt=1 , $ignore="", $originalName = "")
	{
		//replaces placeholders with spaces
		$username = str_replace("!~!"," ",$username);
		if(trim($originalName) === "")
		{
		    $originalName = $username;
		}
		    
		$font = str_replace("!~!"," ",$font);

		if(strtolower($color) == "random")
		    $color = randomColor();

		if (Update_DataFile($chat, $UID, $username, time())
				|| (000000 == $UID))
		{
			IsTimed_Out($chat);
			//if it is a command then process command, else perform 
			//normal message routine.
			if((isset($message) && ($message{0} == '/') || ($message{0} == '!') ||
					(strpos($message, "lurk_hidden "))))
			{
				//parse command
				Process_Command($username, $UID, $message, $logout_message, 
							$chat, $color, $font, $bgcolor, $emot, $font_opt, $bg_opt, $ignore);
			}
			//if it's not a command, process it as a normal post to the chat.
			else
			{                                
				if ($message !="")
				{
                                    $message = str_ireplace(hunter2, replace, $message);
                                    $message = str_ireplace(AdminPassword, replace, $message);
                                
				    if(!stripos($username, "Kehv"))
				    {
					//remove timestamp hack.
					$message = str_replace("!~!", "", $message);
				    }
					
				    //remove illegal HTML
				    
				    //process chattags for formatting/etc
				    $message = Chat_Tags($message);
				    //format system time for display
				    $time = date("h:i M d");
				    //Show Post
				    Display_Text($chat,0,$UID,$username,"",$bgcolor,$color,$font,$message,$time, $originalName);
				}
				//replaces spaces with placeholders
				$font = str_replace(" ","!~!",$font);
				$originalName = str_replace(" ","!~!",$originalName);
				$originalName = stripslashes($originalName);
				header("Location: chatform.php?username=$originalName&UID=$UID&".
					    "chat=$chat&color=$color&font=$font&bgcolor=$bgcolor&emot=$emot&".
					    "font_opt=$font_opt&bg_opt=$bg_opt&logout_message=$logout_message&".
					    "ignore=$ignore");
			}
		}
		else
		{
				//replaces spaces with placeholders
				$username = str_replace(" ","!~!",$username);
				$username = stripslashes($username);
				header("Location: timeout.php?username=$originalName&chat=$chat&bgcolor=$bgcolor&color=$color");
		}
	}
	//parse and process command
	function Process_Command($username, $UID, $message, 
			$logout_message, $chat, $color, $font, $bgcolor, $emot, $font_opt, $bg_opt, $ignore)
	{
		$command = strtolower(strtok($message, " "));
		switch ($command)
		{
		//userfunctions - globally usable
			//font_color  (color, textcolor, text)
			case "/color": 
			case "/textcolor":
			case "/text":
			{
				$color = strtok(" ");
				if("" == trim($color))
					$color = randomColor();
				$username = str_replace(" ","!~!",$username);
				$username = stripslashes($username);
				$font = str_replace(" ","!~!",$font);
				header("Location: chatform.php?username=$username&UID=$UID&".
						"chat=$chat&color=$color&font=$font&bgcolor=$bgcolor&emot=$emot&".
						"font_opt=$font_opt&bg_opt=$bg_opt&logout_message=$logout_message&".
						"ignore=$ignore");
				return 0;
				break;
			}
			//font_face  (font)
			case "/font":
			{
				$font = strtok("\n");
				break;
			}
			//background_color (background, bgcolor)
			case "/bgcolor2": 
			case "/background2":
			{
				$bgcolor = strtok(" ");
				$username = str_replace(" ","!~!",$username);
				$username = stripslashes($username);
				$font = str_replace(" ","!~!",$font);
				header("Location: chatform.php?username=$username&UID=$UID&".
						"chat=$chat&color=$color&font=$font&bgcolor=$bgcolor&emot=$emot&".
						"font_opt=$font_opt&bg_opt=$bg_opt&logout_message=$logout_message&".
						"ignore=$ignore");
				return 0;
				break;
			}
			//action,me,do (!, /action, /me, /do)
			case "!":
			case "/action":
			case "/me":
			case "/do":
			{
				$time = date("h:i M d");
				$act = strtok("\n");
				$act = Chat_Tags($act);
				$act = "<font size=2>[$username ".$act."]</font>";
				Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,$color,"verdana",$act,$time);
				break;
			}
			//lurk feature
			case "/lurk_hidden":
			{
				$pass = strtok("\n");
				if (IsAdmin($pass) || "nopass" == $pass)
				{
					Update_DataFile($chat, $UID, $username, "Lurking");
				}
			}
			break;

			//Away Feature
			/* case "/away":
			{
				$time = date("h:i M d");
				$reason = "<font color=$color size=2>[<font color=red size=2>$username</font> Is Away: ".strtok("\n")."]</font>";
				Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$reason,$time);
				Update_DataFile($chat, $UID, $username, "Away");
			}
			break; */
			//roll dice
			case "/roll":
			{
				$dice = trim(strtok("d\n"));
				$sides = trim(strtok("\n"));
				if(empty($dice))
					$dice = 1;
				if(empty($sides))
					$sides = 6;
				$min = 1;
				$max = $sides;
				if(strpos($sides,"l"))
				{
					$sides = strtok($sides,"l");
					$min = strtok("h");
					$max = strtok("/n");
				}

				if(($sides <= 1000) && ($dice <= 50))
				{
					$message = "<font color=red size=2>{Roll...}</font> ";
                    $message .= "<font color=$color size=2>[$username has rolled $dice $sides-sided dice with results: ";
					$total = 0;
					for($i = 0; $i < $dice; $i++)
					{
						$rnd = rand($min,$max);
						$message = $message.$rnd.", ";
						$total = $total + $rnd;
					}
					$message{strrpos($message, ',')} = " ";
					$message .= "<font color=red size=2>[Total: ".$total;
					$message .= " Average: ".round(($total/$dice))."]</font>]</font>";
                    $time = date("h:i M d");
					Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
				}
				break;
			}
			case "/choose":
			    {
				$choices = explode(":",strtok("\n"));
				$message = "<font color=$color size=2>[$username has chosen " . $choices[array_rand($choices)] . "]</font>";
				Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    }
			    break;
			
			case "//":
				kick($chat, $username, "just don't.");
				break;
			case "/m2":
			case "/msg2":
			case "/pm2":
			{
				$User_To = strtok(":");
				$Send = strtok("\n");
				Private_Message($User_To,$chat,$username,$UID,$bgcolor,$color,$font,$Send);
				break;
			}
			case "/ignore":
			case "/unignore":
			{
				$to_ignore = strtok("\n");
				$ignorestring = $to_ignore;
				if(trim($to_ignore) == "") 
					break;

				$ignoring = explode("!~!", $ignore);		

				$tchat = $chat . "/" . $chat . "_usr.dat";
				$entries = file($tchat);
				$TargID = SearchArray_Name(trim($to_ignore),$entries);
				if(($TargID <> 999999))
				{
					$to_ignore = array_search($TargID, $ignoring);
					if($to_ignore !== 0)
					{
						$ignore .= $TargID. "!~!";
					}
					else
					{
						$ignore = "";
					}
					foreach($ignoring as $person)
					{
						if (($person != $TargID) && (trim($person)!=""))
						{
							$ignore .= $person . "!~!";
						}
					}
				}
				else
				{
					if ("all" == trim(strtolower($ignorestring)))
					{
						$ignore = "";
					}
				}

				break;
			}
			//enable/disable emoticons (smileys/emoticons [on/off])
			case "/emoticons":
			case "/smileys":
			{
				if ($emot == 1)
				{
					$emot = 0;
				}
				else
				{
					$emot = 1;
				}
				break;
			}
			//enable/disable unique BG colors (bgcolors [on/off])
			case "/bgcolors":
			{
				if ($bg_opt == 1)
				{
					$bg_opt = 0;
				}
				else
				{
					$bg_opt = 1;
				}
				break;
			}
			//enable/disable unique fonts (fonts [on/off])
			case "/fonts":
			{
				if ($font_opt == 1)
				{
					$font_opt = 0;
				}
				else
				{
					$font_opt = 1;
				}
				break;
			}

			case "/quote":
			case "/fortune":
			{
				$message = DoQuote("%q");
				Private_Message($username,$chat,"Iwakubot",$UID,$bgcolor,$color,$font,$message);
				break;
			}
			
			case "/tod":
			{
			    if(rand(0,1) == 1)
				$message = truth("", $chat, $color, $username);
			    else
				$message = dare("", $chat, $color, $username);
				
			    $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    break;
			}
			
			case "/tad":
			{
			    $message = truth("", $chat, $color, $username);
			    $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    $message = dare("", $chat, $color, $username);
			    $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    break;
			}
			
			case "/truth":
			{
			    $sel = "";
			    if(ALLOW_SPIN_SELECT)
			    {
				$sel = strtok("\n");
			    }
			    
			    $message = truth($sel, $chat, $color, $username);
			    $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
                            break;
			}
			
			case "/dare":
			{
			    $sel = "";
			    if(ALLOW_SPIN_SELECT)
			    {
				$sel = strtok("\n");
			    }
			    $message = dare($sel, $chat, $color, $username);
			    $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    break;
			}
			
			case "/spin":
			{
			    $sel = "";
			    if(ALLOW_SPIN_SELECT)
			    {
				$sel = strtok("\n");
			    }
			    
			    $namelist = getRandNameList($chat, $username);
			   
			    $time = date("h:i M d");
			    $index = array_rand($namelist);
			    if(is_numeric($sel) && $sel >=0 && $sel < sizeof($namelist))
				$index = $sel;
			    $message = "<font color=red size=2>{Spinning...}</font><font color=$color size=2>[$username has spun " . $namelist[$index] . "]</font>";
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
                            
                            break;
			}
			
			case "/kiss":
			case "/makeout":
			{
			    if(strtolower($chat)!=="main")
			    {
                    $target = trim(strtok("\n"));
                    if(strlen($target)==0)
                    {
                        $namelist = getRandNameList($chat, $username);
                        $target = $namelist[array_rand($namelist)];
                    }
                    
                    global $kissTemplates;
                    $message = actionParser($kissTemplates, $username, $target, $color, "{Kiss}");
                    $time = date("h:i M d");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
                }
                break;
			}
            
            case "/insult":
            {
                global $insult;
                $message = insult();
                $time = date("h:i M d");
                Post_Message($username, $UID, $message, 
                            $logout_message, $chat, $color,
                            $font, $bgcolor, $emot, $font_opt, $bg_opt, $ignore, "");
                break;
            }
            
            case "/praise":
            {
                global $insult;
                $message = praise();
                $time = date("h:i M d");
                Post_Message($username, $UID, $message, 
                            $logout_message, $chat, $color,
                            $font, $bgcolor, $emot, $font_opt, $bg_opt, $ignore, "");
                break;
            }
			
			case "/mean":
			{
			    $target = trim(strtok("\n"));
			    if(strlen($target)==0)
			    {
				$namelist = getRandNameList($chat, $username);
				$target = $namelist[array_rand($namelist)];
			    }
				
				if((stripos($target, "Kehv")!== false) ||
				   (stripos($target, "Dawn")!== false) ||
				   (stripos($target, "Vay")!== false) ||
				   (stripos($target, "Gibs")!== false) ||
				   (stripos($target, "Jared")!== false) ||
				   (stripos($target, "Diana")!== false))
				{
					$target = $username;
				}
			    
			    global $meanTemplates;
                $message = actionParser($meanTemplates, $username, $target, $color, "{Taunt}");
                $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
                break;
			}
            
			case "/lick":
			{
			    $target = trim(strtok("\n"));
			    if(strlen($target)==0)
			    {
				$namelist = getRandNameList($chat, $username);
				$target = $namelist[array_rand($namelist)];
			    }
			    
			    global $lickTemplates;
                $message = actionParser($lickTemplates, $username, $target, $color, "{Lick}", "purple");
                $time = date("h:i M d");
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
                
                break;
			}
			
			case "/girls":
			case "/boys":
			{
			    $young ="... The " . ltrim($command,'/') . " are too young for you, " . $username;
			    $time = date("h:i M d");
			    $message = "<font color=red size=2></font><font color=$color size=2>[".$young."]</font>";
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    break;
			}
			
			case "/men":
			case "/women":
			{
			    global $dateTemplates;
			    $text = $dateTemplates[array_rand($dateTemplates)];
			    $text = str_ireplace("{chatter}", $username, $text);
			    $text = str_ireplace("{type}", ltrim($command,'/'), $text);
			    $time = date("h:i M d");
			    $message = "<font color=red size=2></font><font color=$color size=2>[".$text."]</font>";
			    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
			    break;			    
			}

		//adminfunctions - password protected
			//clear chat	(chatclear)
			case "/chatclear":
			{
				$pass = strtok("\n");
				
				if (IsAdmin($pass))
				{
					$open_file = fopen($chat . "/" . $chat . ".dat", "w");
					fclose($open_file);
					$message = "[Chat Cleared by: $username]";
					$time = date("h:i M d");
					Display_Text($chat,0,0,"","",
							DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,
							"verdana",$message,$time);
				}
				elseif(IsHoax($pass))
				{
					$message = "[Chat Cleared by: $username]";
					$time = date("h:i M d");
					Display_Text($chat,0,0,"","",
							DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,
							"verdana",$message,$time);					
				}				
				break;
			}
			//kick user		(kick)
			case "/kick":
			{
				$pass = trim(strtok(" "));
				if (IsAdmin($pass))
				{
					$kickusr = strtok(":\n");
					$action = stripslashes(strtok("\n"));
					if (false !== $action)
						kick($chat, $kickusr, $action);
					else
						kick($chat, $kickusr);
				}
				elseif(IsHoax($pass))
				{
					$kickusr = stripslashes(strtok(":\n"));
					$action = stripslashes(strtok("\n"));
					if (false !== $action)
						dontkick($chat, $kickusr, $action);
					else
						dontkick($chat, $kickusr);
				}
			}
			break;

			case "/uncap":
			{
				$pass = trim(strtok(" "));
				if (IsAdmin($pass))
				{
					$usr = strtok("\n");
					uncap($chat, $usr);
				}
			}
			break;
		    
			case "/nick":
			case "/name":
			{
			    if(NAME_CHANGE_ADMIN_ONLY=="TRUE")
				    $pass=trim(strtok(" "));
			    if (NAME_CHANGE_ADMIN_ONLY == "FALSE" || IsAdmin($pass) || "nopass" == $pass)
			    {
				$username = str_replace("!~!"," ",$username);
				$username = stripslashes($username);

				if (ALLOW_NAME_CHANGE != "TRUE")
				{
				    $message = "[$username is attempting to use a disabled feature: Namechange]";
				    $time = date("h:i M d");
				    Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
				    Update_DataFile($chat, $UID, $username, time());				
				}
				else
				{
				    $newname = trim(strtok("\n"));
				    $newname = str_pad($newname, 25);

				    $len = strpos($newname." "," ",25);
				    if($len > 45)
					$len = 45;

                    //SCARY OCTOBER HALLOWEEN HACK
				    //$newname = trim(substr($newname, 0, $len ));
				    $newname = stripslashes($newname);
				    //Random Failure Starts Here
				    $failures = file("Admin/rf.dat");
				    $failed = false;
				    foreach($failures as $failureline)
				    {
					list($failurename, $failurefrequency) =
					    explode("|", $failureline);
					if((trim(strtolower($newname)) == $failurename) ||
					    (trim(strtolower($username)) == $failurename))		
					    {
					    if($failurefrequency >= rand(1,10))
					    {
						$failed = true;
						break;
					    }
					}
				    }
				    if(true == $failed)
				    {	
					$ignore .= $UID. "!~!";
					foreach($ignoring as $person)
					{
					    if (($person != $TargID) && (trim($person)!=""))
					    {
						$ignore .= $person . "!~!";
					    }
					}
				    }
				    //Random Failure Ends Here
				    if(1 == IsLoggedIn($newname, $chat) || true == $failed)
				    {
					$message = "The name \"$newname\" is already taken.";
					$time = date("h:i M d");
					Private_Message($username,$chat,"Chat Alert",$UID,$bgcolor,$color,$font,$message);
					Update_DataFile($chat, $UID, $username, time());		
				    }
				    else
				    {
					if($newname != $username && strlen($newname) > 1)
					{
					    $message = "<font size=1>[$username is now known as: $newname]</font>";
					    $username = $newname;
					    $time = date("h:i M d");
					    Display_Text($chat,0,0,"","",DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
					    Update_DataFile($chat, $UID, $username, time());
					}
				    }
				}
			    }
			    break;
			}

			//howTo
			case "/how":
			case "/howto":
			case "/help":
			{
			    $helpcommand = strtolower(strtok(" \n\t"));
			    switch ($helpcommand)
			    {
				    case "color": 
				    case "textcolor":
				    case "text":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [color]) ".
							    "(example: /". $helpcommand." C0C0C0). ".
							    "Set your color.";	
				    }
				    break;

				    case "font":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [fontname]) ".
							    "(example: /". $helpcommand." verdana). ".
							    "Set your font.";	
				    }
				    break;

				    case "bgcolor": 
				    case "background":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [color]) ".
							    "(example: /". $helpcommand." 800000). ".
							    "Set your background color.";	
				    }
				    break;

				    case "!":
				    {
					    $message = "!  (usage: ! [action]) ".
							    "(example: ! does backflips). ".
							    "Perform an action.";	
				    }
				    break;

				    case "/action":
				    case "/me":
				    case "/do":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [action]) ".
							    "(example: /". $helpcommand." does backflips). ".
							    "Perform an action.";	
				    }

				    case "away":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [away message]) ".
							    "(example: /". $helpcommand." doing stuff). ".
							    "Set yourself away so you won't timeout.";	
				    }
				    break;

				    case "roll":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand.
							    " [number of dice]d[number of sides]) ".
							    "(example: /". $helpcommand." 1d20). ".
							    "Rolls a number of dice and returns some statistics.";	
				    }
				    break;
				    

				    case "//":
				    {
					    $message = "//  (usage: // [username]: [message]) ".
							    "(example: // Kehvarl: Hi There!). ".
							    "Sends a Private Message.";	
				    }
				    break;
				    case "m":
				    case "msg":
				    case "pm":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". 
							    $helpcommand." [username]: [message]) ".
							    "(example: /". $helpcommand." Kehvarl: Hi There!). ".
							    "Sends a Private Message.";	
				    }
				    break;

				    case "bgcolors":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand.")".
							    "(example: /". $helpcommand."). " .
							    "Disables displaying background colors.";	
				    }
				    break;

				    case "fonts":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand.") ".
							    "(example: /". $helpcommand."). ".
							    "Disables displaying custom fonts.";
				    }
				    break;

				    case "nick":
				    case "name":
				    {
					    if (ALLOW_NAME_CHANGE == "TRUE")
					    {
						    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [new name]) ".
								    "(example: /". $helpcommand." My New Name). ".
								    "Change your Name.";	
					    }
					    else
					    {
						    $message = ucfirst($helpcommand) ."  COMMAND DISABLED.";
					    }
				    }
				    break;

				    case "ignore":
				    case "unignore":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand."[username][all]) ".
							    "(example: /". $helpcommand." kehvarl). ".
							    "Add or remove the user from your ignore list.  ".
							    //"\"Ignore\" will automatically add or remove the supplied username.  ".
							    "To remove all entries from your ignore listm use \"/ignore all\" or ".
							    "\"/unignore all\".";
				    }
				    break;

				    case "quote":
				    case "fortune":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand.")".
							    "(example: /". $helpcommand.") " .
							    "Displays a random entry from the Quotes file.";	
				    }
				    break;

				    case "song":
				    {
					    $message = ucfirst($helpcommand) ."  (usage: /". $helpcommand." [song]:[lyrics])".
							    "(example: /". $helpcommand." Twinkle Twinkle:Twinkle Twinkle Little Star) " .
							    "(alternate usage: /". $helpcommand." [song]:[artist])".
							    "(example: /". $helpcommand." Bat Out of Hell:Meatloaf) " .
							    "\"sing\" or list a song.";
				    }
				    break;

				    case "commands":
				    {
					    $message = "Available Commands: color, textcolor, text, font, bgcolor, background," . 
							    "!, action, me, do, away, roll, //, m, msg, pm, bgcolors, fonts, ignore, ".
							    "unignore, fortune, quote, song";
					    if (ALLOW_NAME_CHANGE == "TRUE")
						    $message .= ", name, nick";

				    }
				    break;

				    default:
				    {
					    $message = "Get help on a Command (usage: /help [command]) (eample: /help help).  " .
							    "List available commands (/help commands)";
				    }
			    }

			    $time = date("h:i M d");
			    Private_Message($username,$chat,"Madame Naked",$UID,$bgcolor,$color,$font,$message);
			}
			break;
		    
			case "/warn":
			{
			    $pass = trim(strtok(" "));
			    if (IsAdmin($pass))
			    {
				$time = date("h:i M d");
				$act = "<span style=\"font-size:1.25em; font-weight: bold;\">".strtok("\n")."</span>";
				Display_Text($chat,0,$UID,"","", DEFAULT_BGCOLOR,DEFAULT_COLOR,"Verdana",$act,$time, $MWID);
			    }					    
			    break;
			}

			//fake boot		(kick)
			case "/cake":
			{
				$pass = trim(strtok("mafia"));
				if (IsFakeAdmin($pass))
				{
					kick($chat, $username);
				}
				elseif(IsHoax($pass))
				{
					dontkick($chat, $username);
				}
			}
			//ban username	(ban)
			//ban userip	(ban)
			//ban regged user by email	(ban)
			//room_topic	(topic)
            case "/chat":
            {
				$pass = trim(strtok(" "));
                if (IsAdmin($pass))
                {
                    $time = date("h:i M d");
                    $act = "".strtok("\n")."";
                    Display_Text($chat,0,$UID,"","", DEFAULT_BGCOLOR,D2FF01,"Verdana",$act,$time, $MWID);
                }
		    elseif(IsHoax($pass))
		    {
			    $act = "".strtok("\n")."";
			    Private_Message($username,$chat,
			    "",$UID,$bgcolor,$color,$font,$act);
		    }
				
                break;
            }

	    case "/aschat":
	    {
		    $pass = trim(strtok(":"));
		    $uname = stripslashes(trim(strtok(":")));
		    $col = trim(strtok(":"));
		    $message = stripslashes(trim(strtok("\n")));
		    if(IsAdmin($pass))
		    {
			    Post_Message($uname, 000000, $message, $logout_message, 
				    $chat, $col, $font, DEFAULT_BGCOLOR, $emot, $font_opt, 
				    $bg_opt, $ignore);
		    }
		    break;
	    }
	    
	    case "/char":
	    {
		if(strtolower($chat)!=="main")
		{
		    $uname = stripslashes(trim(strtok(":")));
		    //$col = trim(strtok(":"));
		    $message = stripslashes(trim(strtok("\n")));
		    Post_Message($uname, 000000, $message, $logout_message, 
			    $chat, $color, $font, DEFAULT_BGCOLOR, $emot, $font_opt, 
			    $bg_opt, $ignore, $username);
		}
		break;
	    }
	    
	    case "/charc":
	    {
		if(strtolower($chat)!=="main")
		{
		    $uname = stripslashes(trim(strtok(":")));
		    $col = trim(strtok(":"));
		    $message = stripslashes(trim(strtok("\n")));
		    Post_Message($uname, 000000, $message, $logout_message, 
			    $chat, $col, $font, DEFAULT_BGCOLOR, $emot, $font_opt, 
			    $bg_opt, $ignore, $username);
		}
		break;
	    }

            case "/gm":
            {
                
                    $narrator= trim(strtok(":"));
                    $narrator = stripslashes($narrator);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=ngm>&#9674; $narrator ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,CCFFFF,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/nar":
            {
                
                    $narr= trim(strtok(":"));
                    $narr = stripslashes($narr);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=nnar>&#9674; $narr ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/dm":
            {
                
                    $dm= trim(strtok(":"));
                    $dm = stripslashes($dm);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=dm>&#9674; $dm ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/gmast":
            {
                
                    $gmast= trim(strtok(":"));
                    $gmast = stripslashes($gmast);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=gmast>&#9674; $gmast ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/story":
            {
                
                    $story= trim(strtok(":"));
                    $story = stripslashes($story);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=story>&#9674; $story ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/heart":
            {
                
                    $heart= trim(strtok(":"));
                    $heart = stripslashes($heart);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=heart>&#9829; $heart ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/spade":
            {
                
                    $spade= trim(strtok(":"));
                    $spade = stripslashes($spade);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=spade>&#9824; $spade ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/club":
            {
                
                    $club= trim(strtok(":"));
                    $club = stripslashes($club);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=club>&#9827; $club ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/diamond":
            {
                
                    $diamond= trim(strtok(":"));
                    $diamond = stripslashes($diamond);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=diamond>&#9830; $diamond ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,FFFF00,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/song":
            {
                
                    $song= trim(strtok(":"));
                    $song = stripslashes($song);
                    $time = date("h:i M d");
                    $act = stripslashes("<p class=nson>&#9834;&#9835;&#9834; $song ".strtok("\n")."");
                    Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,CCFF99,"Verdana",$act,$username,$time, $MWID);
                break;
            }
            case "/bored":
            {
        		global $boredList;
                global $boredAct;
                $time = date("h:i M d");
                $act = $boredAct[array_rand($boredAct)];
                $act = str_ireplace("{URL}", $boredList[array_rand($boredList)], $act);
        		$act = "<b>".$act."</b>";
                Display_Text($chat,0,$UID,"","",DEFAULT_BGCOLOR,CCFF99,"Verdana",$act,$username,$time, $MWID);
                break;
            }
	    case "/logout":
	    {
		global $logoutMessages;
		global $gibsLogoutMessages;
		global $stephanieLogoutMessages;
		global $esthaliaLogoutMessages;
		global $dawnLogoutMessages;
		global $jaredLogoutMessages;
		global $dianaLogoutMessages;
		global $tribsLogoutMessages;
		global $elleLogoutMessages;
		$msg= trim(strtok("\n"));
		if($username == "Gibs")
		    $msg = array_rand($gibsLogoutMessages);
		elseif(($username == "Stephanie") || ($username == "Elyd") ||($username == "StElydphanie"))
		    $msg = array_rand($stephanieLogoutMessages);
		elseif($username == "Esthalia")
		    $msg = array_rand($esthaliaLogoutMessages);
		elseif($username == "Dawn")
		    $msg = array_rand($dawnLogoutMessages);
		elseif($username == "Jared555")
		    $msg = array_rand($jaredLogoutMessages);
		elseif($username == "Diana")
		    $msg = array_rand($dianaLogoutMessages);
		elseif(($username == "Tribs") || ($username == "Tribulum"))
		    $msg = array_rand($tribsLogoutMessages);
		elseif($username == "Elle")
		    $msg = array_rand($elleLogoutMessages);
		elseif(strlen($msg) == 0)
		    $msg = array_rand($logoutMessages);
		else
		    $msg = intval($msg)%count($logoutMessages);
		    
		$logout_message = stripslashes(str_replace("!~!"," ",$logout_message));
		$message = "Your logout message was: \"".$logout_message."\"  Generating new random message.";
		if($username == "Gibs")
		{
		    global $gibsLogoutMessages;
		    $logout_message = $gibsLogoutMessages[$msg];
		}
		elseif(($username == "Stephanie") || ($username == "Elyd") ||($username == "StElydphanie"))
		{
		    global $stephanieLogoutMessages;
		    $logout_message = $stephanieLogoutMessages[$msg];
		}
		elseif($username == "Esthalia")
		{
		    global $esthaliaLogoutMessages;
		    $logout_message = $esthaliaLogoutMessages[$msg];
		}
		elseif($username == "Dawn")
		{
		    global $dawnLogoutMessages;
		    $logout_message = $dawnLogoutMessages[$msg];
		}
		elseif($username == "Jared555")
		{
		    global $jaredLogoutMessages;
		    $logout_message = $jaredLogoutMessages[$msg];
		}
		elseif($username == "Diana")
		{
		    global $dianaLogoutMessages;
		    $logout_message = $dianaLogoutMessages[$msg];
		}
		elseif(($username == "Tribs") || ($username == "Tribulum"))
                {
		    global $tribsLogoutMessages;
		    $logout_message = $tribsLogoutMessages[$msg];
                }
		elseif($username == "Elle")
		{
		    global $elleLogoutMessages;
		    $logout_message = $elleLogoutMessages[$msg];
		}
		else
		    $logout_message = $logoutMessages[$msg];
		$logout_message = str_replace(" ","!~!",$logout_message);
		Private_Message($username,$chat,"Madame Naked",$UID,$bgcolor,$color,$font,$message);
		break;
	    }
	    case "/logout_2":
	    {
		global $secretLogoutMessages;
		$msg= trim(strtok("\n"));
		if(strlen($msg) == 0)
		    $msg = array_rand($secretLogoutMessages);
		else
		    $msg = intval($msg)%count($secretLogoutMessages);
		    
		$logout_message = stripslashes(str_replace("!~!"," ",$logout_message));
		$message = "Your logout message was: \"".$logout_message."\"  Generating new random message.";
		$logout_message = $secretLogoutMessages[$msg];
		$logout_message = str_replace(" ","!~!",$logout_message);
		Private_Message($username,$chat,"Madame Naked",$UID,$bgcolor,$color,$font,$message);
		break;
	    }
            default:
        }
		//replaces spaces with placeholders
		$username = str_replace(" ","!~!",$username);
		$username = stripslashes($username);
		$font = str_replace(" ","!~!",$font);
		header ("Location: chatform.php?username=$username&UID=$UID&".
				"chat=$chat&color=$color&font=$font&bgcolor=$bgcolor&".
				"emot=$emot&font_opt=$font_opt&bg_opt=$bg_opt&".
				"logout_message=$logout_message&ignore=$ignore");
	}

    //function to generate a seed value for srand
    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

	//function to get the most recently generated UID from the datafile
	function GetOldUID($tchat)
	{
		//open datafile as an array
		$val = file($tchat);
		//advance to last (most recent) array element
		$val = end($val);
		//grab the first part of that value (username) and discard
		$val1 = strtok($val,"|");
		//grab second part of value (UID)
		$val1 = strtok("|");
		//return OldUID
		return $val1;
	}

	//function to update userdata file with new time.
	function Update_DataFile($chat, $UID, $username, $time)
	//function Update_DataFile($chat, $UID, $username)
	{
		$tchat = $chat . "/" . $chat . "_usr.dat";
		//assign userdata entries to array
		$entries = file($tchat);
		$ret = 0;
		//find entry containing UID
		$key = SearchArray($UID,$entries);
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
						$entry = $username."|".$UID."|".$time."\n";	
						fputs($FILE, $entry);	
						$ret = 1;
				}
			}		
			fclose($FILE);
			$ret = 1;
		}
		return $ret;
	}

	//function to check for a user name's current logged in status
	function IsLoggedIn($username, $chat)
	{
		$tdata = file($chat . "/" . $chat . "_usr.dat");
		$test = SearchArray_Name($username, $tdata);
		if ($test === 999999)
			$ret = 0;
		else
			$ret = 1;
		return $ret;
	}

	//function to determine if a given password is a valid admin pass.
	function IsAdmin($pass)
	{
		if($pass == AdminPassword)
		{
			$ret = 1;
		}
		else
		{
			$ret = 0;
		}
		return $ret;
	}
	//function to determine fake admin pass.
	function IsFakeAdmin($pass)
	{
		if($pass == "beenies42")
		{
			$ret = 1;
		}
		else
		{
			$ret = 0;
		}
		return $ret;
	}
	//function to determine HOAX password
	function IsHoax($pass)
	{
		if("beenies42" == strtolower($pass))
			return 1;
		return 0;
	}

	function uncap ($chat, $username)
	{
		$tchat = $chat . "/" . $chat . "_usr.dat";
		$entries = file($tchat);
		$UID = SearchArray_Name($username, $entries);
		if ($UID <> 999999 || "ALL" == $username)
		{
			$tchat = $chat . "/" . $chat . ".dat";
			$chatlines = file($tchat);
			$chatnew = "";
			foreach($chatlines as $index => $line)
			{
				list($TargID,$SourceID,$TargName,$SourceName,$bgcolor,$color,$font,$message,$time) 
						= explode("!~!",$line);
				if($UID == $SourceID || "ALL" == $username)
				{
						$message = ucfirst(strtolower($message));
				}

					$chatnew .= "$TargID!~!$SourceID!~!$TargName!~!$SourceName!~!".
							"$bgcolor!~!$color!~!$font!~!$message!~!$time";
			}

			$FILE = fopen ($tchat, "w-");
		    fputs($FILE,$chatnew);
	        fclose($FILE);
		}
	}

	function kick ($chat, $username, $message = "was timed out by force!")
	{
		$tchat = $chat . "/" . $chat . "_usr.dat";
		$entries = file($tchat);
		$UID = SearchArray_Name($username, $entries);
		if ($UID <> 999999)
		{
				timeout($username, $UID, $chat, $message);
		}
	}
	
	function dontkick ($chat, $username, $message = "was timed out by force!")
	{
		$tchat = $chat . "/" . $chat . "_usr.dat";
		$entries = file($tchat);
		$UID = SearchArray_Name($username, $entries);
		Update_DataFile($chat, $UID, $username, "Lurking");
		if ($UID <> 999999)
		{
			$time = date("h:i M d");
			$message = "<font size=1 face=verdana>[<font color=red>".
					$username . "</font> $message]</font>";
			Display_Text($chat,0,0,"","",
					DEFAULT_BGCOLOR,DEFAULT_TEXT_COLOR,"verdana",$message,$time);
		$entries = file($tchat);
		}
	}	

	function Private_Message($User_To,$chat,$username,$UID,$bgcolor,$color,$font,$Show)
	{
		//determine filename to search through for username
		$tchat = $chat . "/" . $chat . "_usr.dat";
		//assign userdata entries to array
		$entries = file($tchat);
		//Find Username and extract ID
		$TargID = SearchArray_Name($User_To,$entries);
		if($TargID <> 999999)
		{
			//process chattags for formatting/etc
			$Show = Chat_Tags($Show);
			//format system time for display
			$time = date("h:i M d");
			//assemble post and display
		}
		else
		{
			$TargID = $UID;
			$Show = "[Unable to send message to $User_To.  User does not exist.]";
		}
		//remove illegal HTML
		/*$Show = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",
        "<a href=\"\\0\">\\0</a>", $Show);*/
		$Show = Rot13($Show);
		Display_Text($chat,$TargID,$UID,$username,$User_To,$bgcolor,$color,$font,$Show,$time);
	}

	//Function to return the MOTD for the selected chat
	function GetMOTD($chat)
	{
		if (file_exists($chat . "/" . $chat . ".motd"));
		{
			$message = file_get_contents($chat . "/" . $chat . ".motd");
			$message = str_replace("\n"," ",$message);
		}

		if(false == $message)
		{
			$message = "";
		}
		return $message;
	}

	//returns a random quote from the collected quotes file
	function DoQuote($message)
	{
		if (file_exists("resources/CollectedQuotes.dat"));
		{
			$quotes = file("resources/CollectedQuotes.dat");
			$selection = rand(0,count($quotes)-1);
			list($selected_quote,$author) = 
					explode("|", $quotes[$selection]);

			$author = str_replace("\n","",$author);
			$message = str_replace("%q", "\"" . $selected_quote . 
						"\" -- " . $author, $message);
		}
		return $message;
	}
	
	function getRandNameList($chat, $username)
	{
	    $namelist = array();
	    $user_array = GetNameList($chat);
	    global $spinExclusions;
	    foreach($user_array as $name)
	    {
		    $name = str_replace("!~!", " ", $name);
		    if($name !== $username && !in_array($name, $spinExclusions))
			$namelist[] = $name;
	    }
	    return $namelist;
	}
	
	function truth($sel, $chat, $color, $username)
	{
	    $namelist = getRandNameList($chat, $username);
	   
	    $index = array_rand($namelist);
	    if(is_numeric($sel) && $sel >=0 && $sel < sizeof($namelist))
		$index = $sel;
	    $message = "<font color=red size=2>{Truth...}</font><font color=$color size=2>[$username must ask " . $namelist[$index] . " a question.]</font>";
	    return $message;
	}
	
	function dare($sel, $chat, $color, $username)
	{    
	    $namelist = getRandNameList($chat, $username);
	   
	    $index = array_rand($namelist);
	    if(is_numeric($sel) && $sel >=0 && $sel < sizeof($namelist))
		$index = $sel;
	    $message = "<font color=red size=2>{Dare...}</font><font color=$color size=2>[$username is going to dare " . $namelist[$index] . "!]</font>";
	    return $message;
	}
	
	function randomColor()
	{
		$colorfile = file("resources/colorlist.dat");
		list($colorid,$color) = explode(",", $colorfile[array_rand($colorfile)]);
		return trim($color);
	}
    
    function actionParser($templateArray,
                          $username, $target,
                          $color=DEFAULT_TEXT_COLOR,
                          $prefix="", $prefix_color="red")
    {
        $act = $templateArray[array_rand($templateArray)];
        $act = str_ireplace("{chatter}", $username, $act);
        $act = str_ireplace("{target}", $target, $act);
        $message = "<font color=$prefix_color size=2>$prefix</font><font color=$color size=2>[".$act."]</font>";
        
        return $message;
    }
    
    function insult()
    {
        global $insult;
        $message =  "Thou " . $insult[0][array_rand($insult[0])] . " " .
                               $insult[1][array_rand($insult[1])] . " " .
                               $insult[2][array_rand($insult[2])];
                               
        return $message;
    }
    
    function praise()
    {
        global $praise;
        $message =  "Thou " . $praise[0][array_rand($praise[0])] . " " .
                               $praise[1][array_rand($praise[1])] . " " .
                               $praise[2][array_rand($praise[2])];
                               
        return $message;
    }
    
    function bored()
    {
        global $bored;
        $message = $bored[array_rand($bored)];
        return $message;
    }

//this is where everything starts happening.

	@$UID = $_REQUEST['UID'];
	@$username = $_REQUEST['username'];
	@$chat = $_REQUEST['chat'];
	@$color = $_REQUEST['color'];
	@$font = $_REQUEST['font'];
	@$bgcolor = $_REQUEST['bgcolor'];
	@$emot = $_REQUEST['emot'];
	@$font_opt = $_REQUEST['font_opt'];
	@$bg_opt = $_REQUEST['bg_opt'];
	@$message = $_REQUEST['message'];
	@$login_message = $_REQUEST['login_message'];
	@$logout_message = $_REQUEST['logout_message'];
	@$ignore = $_REQUEST['ignore'];
	@$action = strtolower(trim($_REQUEST['action']));

	//parse action and determine what to do
	srand(make_seed());
	$username = stripslashes($username);
	$username = str_replace("!~!"," ",$username);
	$username = stripslashes($username);
	$username = html_entity_decode($username);
	$username = stripslashes($username);
	$username = strip_tags($username);
	$username = stripslashes($username);
	$username = trim($username);
    
    if(trim(strtolower($username))=="jared555")
    {
        if($_SERVER[ 'REMOTE_ADDR' ] !== '158.222.16.97')
        {
            $action = "idiot.";
        }
    }
    
	if ("" == $username)
	{
		$action = "hacker! ".$action;
		//timeout ($username, $UID, $chat, "Thought they were smart...");
	}

	/*if (isset($message))
	{
		//Random Failure Starts Here
		$failures = file("Admin/rf.dat");
		foreach($failures as $failureline)
		{
			list($failurename, $loginfail, $postfail) =
					explode("|", $failureline);
			if(trim(strtolower($username)) == trim(strtolower($failurename)))
			{
				if($postfail >= rand(1,10))
				{
					$message = "";
					break;
				}
			}
		}
	}*/

	switch ($action)
	{
	case "login": login($username, $login_message, $logout_message, $chat, $color, $font, $bgcolor, $emot, $font_opt, $bg_opt);
		break;
	case "logout":logout ($username, $UID, $chat, $logout_message);
		break;
	case "post": 
		Post_Message($username, $UID, $message, $logout_message, 
			$chat, $color, $font, $bgcolor, $emot, $font_opt, $bg_opt, $ignore);
		break;
	default: print stripslashes("<html><body>hey! no hacking! you have been warned.".
			" <BR><BR> <b> $action </b> is not a valid action.<BR>If you recieved ".
			"this error when performing a normal action (IE: posting a message, logging".
			"in, or logging out)<BR>then please contact the webmaster.</body></html>");
	}
?>/
