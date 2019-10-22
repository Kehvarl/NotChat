<?php
//display message to chat
function Display_Text( $chat, $TargID, $SourceID, $TargName, $SourceName, $bgcolor, $color, $font, $message, $time, $originalName = "" )
{
    //convert chat name to chat data file name.
    $tchat = $chat . "/" . $chat . ".dat";
    //remove oldest line from chat (if total lines greater than 30)
    $Old   = Chat_Manip( $tchat );
    //assemble new entry
    if(trim(strtolower($TargName)) == trim(strtolower($originalName)))
	$originalName = "";
	
    $post  = "$TargID!~!$SourceID!~!$TargName!~!$SourceName!~!$bgcolor!~!$color!~!$font!~!$message!~!$time $originalName\n";
    $IP    = $_SERVER[ 'REMOTE_ADDR' ];
    $log   = "$TargID!~!$SourceID!~!$TargName!~!$SourceName!~!$bgcolor!~!$color!~!$font!~!$message!~!$time $originalName!~!$IP\n";
    //open chat message file
    $FILE  = fopen( $tchat, "w-" );
    //and add new entry
    fputs( $FILE, $post );
    //append the old data
    fputs( $FILE, $Old );
    //close file
    fclose( $FILE );
    
    Log_Chat( $chat, $log );
}

//take a chat data file and strip off the oldes line(s) if total is greater than 30
function Chat_Manip( $tchat )
{
    $message_array = file( $tchat );
    //Create an Empty String    
    $old_messages  = "";
    //or two
    $line          = "";
    $countpost     = 0;
    $counttotal    = 0;
    
    foreach ( $message_array as $line )
    {
        $Newline = $Line;
        $targ    = strtok( $Newline, "!~!" );
        if ( 0 == $targ )
        {
            $countpost++;
            $counttotal++;
            if ( ( 30 >= $countpost ) )
            {
                $old_messages .= $line;
            }
        }
        else
        {
            $counttotal++;
            if ( ( 30 >= $countpost ) )
            {
                $old_messages .= $line;
            }
        }
    }
    
    return $old_messages;
}
?>