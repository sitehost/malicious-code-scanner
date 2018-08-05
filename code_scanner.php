<?php
/*########################################################################################
	  _             ____           _     _      _ _   _   _       __ _      _     _ 
	 | |           |  _ \         | |   | |    (_) | | | | |     / _(_)    | |   | |
	 | |__  _   _  | |_) |_ __ ___| |_  | |     _| |_| |_| | ___| |_ _  ___| | __| |
	 | '_ \| | | | |  _ <| '__/ _ \ __| | |    | | __| __| |/ _ \  _| |/ _ \ |/ _` |
	 | |_) | |_| | | |_) | | |  __/ |_  | |____| | |_| |_| |  __/ | | |  __/ | (_| |
	 |_.__/ \__, | |____/|_|  \___|\__| |______|_|\__|\__|_|\___|_| |_|\___|_|\__,_|
	 _ 		 __/ |  					 ______    _____  ____  _____                                                               
	| |		|___/     					|___  /   |____ |/ ___||  ___|                    
	| |_ ___  __ _ _ __ ___     / __ \     / /_____   / / /___ |___ \  ___ ___  _ __ ___  
	| __/ _ \/ _` | '_ ` _ \   / / _` |   / /______|  \ \ ___ \    \ \/ __/ _ \| '_ ` _ \ 
	| ||  __/ (_| | | | | | | | | (_| | ./ /      .___/ / \_/ |/\__/ / (_| (_) | | | | | |
	 \__\___|\__,_|_| |_| |_|  \ \__,_| \_/       \____/\_____/\____(_)___\___/|_| |_| |_|
								\____/   
								
		@ Version No.: 1.0
		@ Build No.: 1.0.0
		@ Copyright 2016 by Bret Littlefield
		@ Copyright 2018 by Southern Traders Inc
		@ Created: Fri Aug 1st, 2018
		@ Updated:
	   
	   Before any modification to this script, please read the complete
	   terms and conditions at: http://www.madplex.com/terms
   
########################################################################################*/

ini_set('memory_limit', '-1'); ## Avoid memory errors (i.e in foreachloop)
// Set to your email:
define('SEND_EMAIL_ALERTS_TO','MYEMAIL@DOMAIN.COM');
define('LOG_FILE_FOR_FILES','/root/malicious_code.txt');
new CodeScan('/home');





############################################ START CLASS


class CodeScan {

	public $infected_files = array();
	private $scanned_files = array();
	
	
	function __construct($dir=null) {
		if($dir == null){
		$this->scan(dirname(__FILE__));
		} else {
			$this->scan($dir);	
		}
		$this->sendalert();
	}
	
	
	function scan($dir) {
		$this->scanned_files[] = $dir;
		$files = scandir($dir);
		
		if(!is_array($files)) {
			throw new Exception('Unable to scan directory ' . $dir . '.  Please make sure proper permissions have been set.');
		}
		
		foreach($files as $file) {
			if(is_file($dir.'/'.$file) && !in_array($dir.'/'.$file,$this->scanned_files)) {
				$this->check(file_get_contents($dir.'/'.$file),$dir.'/'.$file);
			} elseif(is_dir($dir.'/'.$file) && substr($file,0,1) != '.') {
				$this->scan($dir.'/'.$file);
			}
		}
	}
	
	
	function check($contents,$file) {
		$this->scanned_files[] = $file;
		if(preg_match('/(?<![a-z0-9_])eval\((base64|eval|\$_|\$\$|\$[A-Za-z_0-9\{]*(\(|\{|\[))/i',$contents)) {
			$this->infected_files[] = $file;
			$fp = fopen(LOG_FILE_FOR_FILES, 'a');
			fwrite($fp, $file."\n");
			fclose($fp);
		}
	}


	function sendalert() {
		if(count($this->infected_files) != 0) {
			$message = "== MALICIOUS CODE FOUND == \n\n";
			$message .= "The following files appear to be infected: \n";
			foreach($this->infected_files as $inf) {
				$message .= "  -  $inf \n";
			}
			mail(SEND_EMAIL_ALERTS_TO,'Malicious Code Found!',$message,'FROM:');

		}
	}


}



