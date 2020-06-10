<?php

	$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
	require_once($parse_uri[0] . 'wp-load.php');
	
	$radio_ip = fs_get_theme_option( 'radio_ip' );
	$radio_port = fs_get_theme_option( 'radio_port' );
	
	class Radio {

		private $ip;

		private $port;

		public function Data(){

			global $radio_ip;
			global $radio_port;
            
         $this->ip = $radio_ip;
            
         $this->port = $radio_port;

			$stream = $this->ip.':'.$this->port;

			return $stream;

		}

		public function Connection(){

			$stream = self::Data();

			$shoutcast = @simplexml_load_file('https://'.$stream.'/stats?sid=1');

			if($shoutcast):

				$speaker = trim(htmlspecialchars($shoutcast->SERVERTITLE));
				
				$program = utf8_encode(htmlspecialchars($shoutcast->SERVERGENRE));
				
				$listeners = $shoutcast->CURRENTLISTENERS;
				
				$music = utf8_encode(htmlspecialchars($shoutcast->SONGTITLE));

			elseif(!$shoutcast):

				$ch = curl_init('http://'.$stream.'/index.html');

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);

				$default = curl_exec($ch);

				$server = strpos($default, 'Server is currently up and');

				if($server):


					$speaker = explode('Stream Title: </font></td><td><font class=default><b>', $default);

					$speaker = explode('</b>', $speaker[1]);

					$speaker = trim(htmlspecialchars($speaker[0]));

					

					$program = explode('Stream Genre: </font></td><td><font class=default><b>', $default);

					$program = explode('</b>', $program[1]);

					$program = utf8_encode(htmlspecialchars($program[0]));

					

					$listeners = explode('listeners (', $default);

					$listeners = explode(' unique)', $listeners[1]);

					$listeners = $listeners[0];

					

					$music = explode('Current Song: </font></td><td><font class=default><b>', $default);

					$music = explode('</b>', $music[1]);

					$music = utf8_encode(htmlspecialchars($music[0]));
					

				else:

					$speaker = 'Offline';

					$program = 'Offline';

					$listeners = '?';

					$music = 'Offline';

				endif;

			else:

				return false;

			endif;

			$data = new stdClass();

			$data->speaker = $speaker;

			$data->program = $program;

			$data->listeners = $listeners;

			$data->music = $music;

			return $data;

		}

	}
?>