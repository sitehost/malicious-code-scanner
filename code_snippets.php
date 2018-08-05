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
?>

# looks for .php files that changed in the past 7 days and prints the found data to screen

find /home -type f -name '*.php' -mtime -7 | xargs grep -PHn "(eval\(.*\);)"


http://www.gregfreeman.io/2013/how-to-tell-if-your-php-site-has-been-compromised/

find /home -type f -name '*.php' -mtime -7 | | xargs grep -l "eval *(" --color
find /home -type f -name '*.php' -mtime -7 | | xargs grep -l "base64_decode *(" --color
find /home -type f -name '*.php' -mtime -7 | | xargs grep -l "gzinflate *(" --color


https://codex.wordpress.org/User:Hakre/Grep_And_Friends
~ grep -r --include=*.php -PHn "(eval\(.*\);)" .