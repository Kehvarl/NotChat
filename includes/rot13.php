<?php
	//ROT13 encoding function
	function Rot13($str, $ovr=false, $rate=5) 
	{ 
		$from = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$to = array(
				'nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM',
				'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
				'nopqrstuvwNOPQRSTUVWXYZABCDEFGHIJKLMxyzabcdefghijklm',
				'abuvwxyzABCDEFGSTijklmHIJcdefPQRghqrstKLMNOnopUVWXYZ',
				'mlkjihgfedcbazyxwvutsrqponMLKJIHGFEDCBAZYXWVUTSRQPON',
				'zyxwvutsrqponmlkjihgfedcbaZYXWVUTSRQPONMLKJIHGFEDCBA',
				'1@$@1314%^#67545*^&%*&*(^(^857856774656534%@$@#$1!$@'
				); 

		if ((true === $ovr))
		{
			if($rate >= rand(1,10))
			{
				$index = rand(1,count($to)-1);
			}
		}
		else
			$index = 0;

		return strtr($str, $from, $to[$index]); 
	}
?>