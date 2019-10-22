<?php
	function postfix($failures)
	{
		$postrate = false;
		foreach($failures as $failureline)
		{
			list($failurename, $failureip, $failurefrequency,$postrate) =
				explode("|", $failureline);
			if(($_SERVER['REMOTE_ADDR'] == $failureip))
			{
				if($failurefrequency >0)
				{
					$postrate = 10;
					break;
				}
			}
		}	
		return $postrate;
	}
?>