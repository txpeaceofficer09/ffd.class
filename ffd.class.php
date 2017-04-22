<?php

class ffd {
	public $dbfile;
	
	function __construct($file) {
		$dbfile = $file;
	}
	
	function searchEntry($key, $val) {
		$db = file($dbfile);
		$retVal = false;
		
		foreach ($db AS $line) {
			$data = explode("|", $line);
			
			if ($data[$key] == $val) {
				$retVal = $data;
				break;
			}
		}
		
		return $retVal;
	}
	
	function readEntry($key) {
		$db = file($dbfile);
		
		return explode("|", $db[$key]);
	}
	
	function readDB() {
		return join("\n", file($dbfile));
	}
	
	function newEntry($arr) {
		ksort($arr);
		$entry = join("|", $arr);
		
		$db = file($dbfile);
		array_push($db, $entry);
		$fp = fopen($dbfile, 'w');
		fputs($fp, join("\n", $db));
		fclose($fp);
	}
	
	function deleteEntry($key) {
		$db = file($dbfile);
		
		unset($db[$key]);
		
		$fp = fopen($dbfile, 'w');
		fputs($fp, join("\n", $db));
		fclose($fp);
	}
	
	function updateEntry($arr, $newArr) {
		$db = file($dbfile);
		$oldLine = join("\n", $arr);
		$newLine = join("\n", $newArr);
		
		foreach ($db AS $key=>$line) {
			if ($line == $oldLine) {
				$db[$key] = $newLine;
				break;
			}
		}
		
		$fp = fopen($dbfile, 'w');
		fputs($fp, join("\n", $db));
		fclose($fp);
	}
}

?>