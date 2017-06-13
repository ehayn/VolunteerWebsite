<?php

	echo print_r(find_all_files("../.."));
	deleteDir("../../CMS/bootstrap");
	
	function find_all_files($dir) 
	{ 
		$root = scandir($dir); 
		foreach($root as $value) 
		{ 
			if($value === '.' || $value === '..') {continue;} 
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;} 
			foreach(find_all_files("$dir/$value") as $value) 
			{ 
				$result[]=$value; 
			} 
		} 
		return $result; 
	} 
	

	function deleteDir($dir) {
	foreach(scandir($dir) as $file) {
		if ('.' === $file || '..' === $file) continue;
		if (is_dir("$dir/$file")) deleteDir("$dir/$file");
		else unlink("$dir/$file");
	}
	rmdir($dir);
	}

?> 
