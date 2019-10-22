<?php
/*
    function Log_Chat($chat,$mlog)
    {
	    $logdir = "logs";
    
		$time2 = date('Ymd.His');
    
	    $dir = opendir($logdir);
	    $data = array();
    
	    while ($file = readdir($dir))
	    {
	        if ($file != '.' && $file != '..' && stristr($file, $chat) )
	        {
	            $data[] = $file;
	        }
	    }
	    
	    reset($data);
		rsort($data);
    
		if (filesize("$logdir/$data[0]") > 30000 || 
				!file_exists("$logdir/$data[0]") || 
				count($data) == 0)
	    {
	        $flog = fopen($logdir."/".$chat."-".$time2.".log","a+");
			$time = date("h:i M d");
			fwrite($flog, 
					"0!~!0!~!CHATLOG!~!CHATLOG!~!000000!~!FFFFFF!~!".
					"Verdana!~!New Logfile Successfully Created!~!".
					"$time!~!SEVERR\n");
	        fwrite($flog,$mlog);
	        fclose($flog);
    
	    }
	    else
	    {
	        $flog = fopen("$logdir/$data[0]","a+");
	        fwrite($flog,$mlog);
	        fclose($flog);
	    }
    }
	*/
    function Log_Chat($chat,$mlog)
    {
	  $logdir = "logs";
    
	    $time2 = date('Ymd.His');
    
	    $dir = opendir($logdir);
	    $data = array();
    
	    while ($file = readdir($dir))
		{
	        if ($file != '.' && $file != '..' && stristr($file, $chat) )
	        {
	            $data[] = $file;
	        }
	    }
    
	    reset($data);
	    rsort($data);
    
	    if (filesize("$logdir/$data[0]") > 30000 || !file_exists("$logdir/$data[0]") || count($data) == 0)
	    {
	        $flog = fopen("$logdir/$chat-$time2.log","a");
	        fwrite($flog,$mlog);
	        fclose($flog);
	    
		}
	    else
	    {
	        $flog = fopen("$logdir/$data[0]","a");
	        fwrite($flog,$mlog);
	        fclose($flog);
	    }
    }
?>