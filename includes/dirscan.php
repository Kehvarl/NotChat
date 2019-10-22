<?php
	function dirscan($dir, $sortorder=0)
	{
		if(!function_exists('scandir'))
			scandir($dir, $sortorder);
		else
		{
			if(is_dir($dir) && $dirlist = @opendir($dir)) 
			{
				while(($file = readdir($dirlist)) !== false)
				{
					$files[] = $file;
				}
				closedir($dirlist);
				($sortorder == 0) ? 
						sort($files) : asort($files); 
						// arsort was replaced with rsort
				return $files;
			} 
			else 
				return false;
		}
	}
?>