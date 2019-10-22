<?php
	//Parse string for custom format tags (chattags)
	function Chat_Tags($message)
	{
		//replace [command]...[/command] with proper html
		$username = stripslashes($username);
		$username = str_replace("'"," ",$username);
		$message = stripslashes($message);
		$message = htmlspecialchars($message);
        $message = preg_replace( '#\[nobb\](.*)\[/nobb\]#sUe', 'noparse(\'$1\')', $message );
        $message = preg_replace( '#\[noparse\](.*)\[/noparse\]#sUe', 'noparse(\'$1\')', $message );
        $message = preg_replace( '#\[bb\](.*)\[/bb\]#sUe', 'noparse(\'$1\')', $message );
        $message = preg_replace_callback( '#:insult:#', function($m){return insult();}, $message );
        $message = preg_replace_callback( '#:praise:#', function($m){return praise();}, $message );
        $message = preg_replace_callback( '#[Bb]+[.\s]*[Oo]+[.\s]*[Rr]+[.\s]*[Ee]+[.\s]*[Dd]+#', function($m){return bored();}, $message );
		$message = str_replace(":angel:","<img src='images/angel.gif'>",$message);
		$message = str_replace(":beer:","<img src='images/beer.gif'>",$message);
		$message = str_replace(":birthday:","<img src='images/birthday.gif'>",$message);
		$message = str_replace(":blah:","<img src='images/blah.gif'>",$message);
		$message = str_replace(":bomb:","<img src='images/bomb.gif'>",$message);
		$message = str_replace(":book:","<img src='images/book.gif'>",$message);
		$message = str_replace(":bouquet:","<img src='images/bouquet.gif'>",$message);
		$message = str_replace(":brick:","<img src='images/brick.gif'>",$message);
		$message = str_replace(":bsmile:","<img src='images/bsmile.gif'>",$message);
		$message = str_replace(":cake:","<img src='images/cake.gif'>",$message);
		$message = str_replace(":catg:","<img src='images/catgirl.gif'>",$message);
		$message = str_replace(":chair:","<img src='images/chair.gif'>",$message);
		$message = str_replace(":champagne:","<img src='images/champagne.gif'>",$message);
		$message = str_replace(":coffee:","<img src='images/coffee.gif'>",$message);
		$message = str_replace(":cookie:","<img src='images/cookie.gif'>",$message);
		$message = str_replace(":cool:","<img src='images/cool.gif'>",$message);
		$message = str_replace(":cry:","<img src='images/cry.gif'>",$message);
		$message = str_replace(":cup:","<img src='images/cup.gif'>",$message);
		$message = str_replace(":dead:","<img src='images/dead.gif'>",$message);
		$message = str_replace(":rdevil:","<img src='images/devil.gif'>",$message);
		$message = str_replace(":devilfire:","<img src='images/devilfire.gif'>",$message);
		$message = str_replace(":donut:","<img src='images/donut.gif'>",$message);
		$message = str_replace(":drama:","<img src='images/drama.gif'>",$message);
		$message = str_replace(":drunk:","<img src='images/drunk.gif'>",$message);
		$message = str_replace(":duck:","<img src='images/duck.gif'>",$message);
		$message = str_replace(":dude:","<img src='images/dude.gif'>",$message);
		$message = str_replace(":dust:","<img src='images/dust.gif'>",$message);
		$message = str_replace(":easteregg:","<img src='images/easteregg.gif'>",$message);
		$message = str_replace(":err:","<img src='images/err.gif'>",$message);
		$message = str_replace(":fbrick:","<img src='images/fbrick.gif'>",$message);
		$message = str_replace(":fire:","<img src='images/fire.gif'>",$message);
		$message = str_replace(":fneko:","<img src='images/fneko.gif'>",$message);
		$message = str_replace(":frog:","<img src='images/frog.gif'>",$message);
		$message = str_replace(":frum:","<img src='images/frum.gif'>",$message);
		$message = str_replace(":girl:","<img src='images/girl.gif'>",$message);
		$message = str_replace(":glare:","<img src='images/glare.gif'>",$message);
		$message = str_replace(":heart:","<img src='images/heart.gif'>",$message);
		$message = str_replace(":???:","<img src='images/huh.gif'>",$message);
		$message = str_replace(":jail:","<img src='images/jail.gif'>",$message);
		$message = str_replace(":llama:","<img src='images/llama.gif'>",$message);
		$message = str_replace(":lol:","<img src='images/lol.gif'>",$message);
		$message = str_replace(":loveseat:","<img src='images/loveseat.gif'>",$message);
		$message = str_replace(":lunaspin:","<img src='images/senshi/lunaspin.gif'>",$message);
		$message = str_replace(":mad:","<img src='images/mad.gif'>",$message);
		$message = str_replace(":moon:","<img src='images/moon.gif'>",$message);
		$message = str_replace(":moose:","<img src='images/moose.gif'>",$message);
		$message = str_replace(":nana:","<img src='images/nana.gif'>",$message);
		$message = str_replace(":ninja:","<img src='images/ninja.gif'>",$message);
		$message = str_replace(":omg:","<img src='images/omg.gif'>",$message);
		$message = str_replace(":pdevil:","<img src='images/pdevil.gif'>",$message);
		$message = str_replace(":ds:","<img src='images/Peace.gif'>",$message);
		$message = str_replace(":poke:","<img src='images/pokeball.gif'>",$message);
		$message = str_replace(":raven:","<img src='images/raven.gif'>",$message);
		$message = str_replace(":rawr:","<img src='images/rawr.gif'>",$message);
		$message = str_replace(":rose:","<img src='images/rose.gif'>",$message);
		$message = str_replace(":rum:","<img src='images/rum.gif'>",$message);
		$message = str_replace(":run:","<img src='images/run.gif'>",$message);
		$message = str_replace(":sad:","<img src='images/sad.gif'>",$message);
		$message = str_replace(":shroom:","<img src='images/shroom.gif'>",$message);
		$message = str_replace(":smile:","<img src='images/smile.gif'>",$message);
		$message = str_replace(":smoke:","<img src='images/smoke.gif'>",$message);
		$message = str_replace(":snowman:","<img src='images/snowman.gif'>",$message);
		$message = str_replace(":sword:","<img src='images/sword.gif'>",$message);
		$message = str_replace(":tomb:","<img src='images/tomb.gif'>",$message);
		$message = str_replace(":tongue:","<img src='images/tongue.gif'>",$message);
		$message = str_replace(":TT:","<img src='images/TT.gif'>",$message);
		$message = str_replace(":uh:","<img src='images/uh.gif'>",$message);
		$message = str_replace(":wink:","<img src='images/wink.gif'>",$message);
		$message = str_replace(":yay:","<img src='images/yay.gif'>",$message);
		$message = str_replace(":zombie:","<img src='images/zombie.gif'>",$message);
		$message = str_replace(":zzz:","<img src='images/zzz.gif'>",$message);
		$message = str_replace(":dance:","<img src='images/bananaman.gif'>",$message);
		$message = str_replace(":cake:","<img src='images/cake.gif'>",$message);
		$message = str_replace(":gaxe:","<img src='images/gaxe.gif'>",$message);
		$message = str_replace(":shvonka:","<img src='images/shvonka.gif'>",$message);
		$message = str_replace(":wingsani:","<img src='images/senshi/wingsani.gif'>",$message);
		$message = str_replace(":garnetorb:","<img src='images/senshi/garnetorb.gif'>",$message);
        $message = str_replace(":spritz:","<a target='_blank' href='images/spritz.gif'><img src='images/spray_bottle.gif'></a>",$message);
		$message = str_replace("[br]", "<br>", $message);
		$message = str_replace("[turtle]", "<font size=5>", $message);
		$message = str_replace("[/turtle]", "</font>", $message);
		$message = str_replace("[ponies]", "<font style=\"font-size: 72px; font-variant: small-caps;\">", $message);
		$message = str_replace("[/ponies]", "</font>", $message);
		//Link handling
		$message = preg_replace('/(?<![\]\"\=])(((http|https|ftp):\/\/)[a-zA-Z0-9\.\/\&\%\=\+\?\-\#\@\$\^\*\(\)\[\]\{\}\<\>\~\;\:\'\"\`\_\|\,\!]+)/is',
					'[url=\1]\1[/url]', $message);
		//Handle BBCode links
		$message= preg_replace("/\[url](.*?)\[\/url]/i",
				       "<a href='\\1' title='\\1' target='_blank'>\\1</a>",
				       $message);
		$message= preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/i",
				       "<a href='\\1' title='\\1' target='_blank'>\\2</a>",
				       $message);
		
		
		$message = str_replace("[spoiler]", 
				"<b><font color=red>SPOILER WARNING:</font></b><div style='background-color: #000000; color: #000000;'>", 
				$message);
		$message = str_replace("[/spoiler]", "</div><font color=red><b>SPOILER END!</b></font>", $message);
		$message = eregi_replace("\\[nowwtf=([^\\[]*)\\]([^\\[]*)\\[/nowwtf\\]","<font size=\"\\1\">\\2</font>", $message);
		//$message = eregi_replace("\\[color=([^\\[]*)\\]([^\\[]*)\\[/color\\]","<font color=\"\\1\">\\2</font>", $message);
        $message = preg_replace('~\[color=(.*?)\](.*?)\[/color\]~s','<span style="color:$1;">$2</span>',$message);
                $message = eregi_replace("\\[c\\]([^\\[]*)\\[/c\\]","<span style=\"font-variant:small-caps;\">\\1</span>", $message);
		$message = eregi_replace("\\[image=([^\\[\\.]*)\\]", "<img src=\"images/\\1.gif\"/>",$message);
		while($message != preg_replace('/\[([buis])\]([^\1]*?)\[\/\1\]/iu', '<\1>\2</\1>', $message))
			$message = preg_replace('/\[([buis])\]([^\1]*?)\[\/\1\]/iu', '<\1>\2</\1>', $message);
            
        $message = str_replace( array( '*NoParse1*', '*NoParse2*' ), array( '[', ']' ), $message );
        $message = str_replace( array( '*NoParse3*'), array( ':'), $message );
		return $message;
	}
  
    function noparse( $text = null )
    {
        $text  = str_replace( array( '[', ']' ), array( '*NoParse1*', '*NoParse2*' ), $text );
        $text  = str_replace( array( ':'), array( '*NoParse3*'), $text );
        return $text;
    }
?>