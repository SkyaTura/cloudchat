<?php
/*
	////////////// How to use ///////////////
	Include this file and create a class extending WebSocket.
	It REQUIRES to have 3 default event functions to work.
	See the example:
	
include "WebSocket.php";

class Server extends WebSocket {
	public function onConnect($socket, $ip){
		echo "New connection from $ip\r\n";
	}
	public function onDisconnect($socket, $ip){
		echo "Disconnected from $ip\r\n";
	}
	public function onReceive($socket, $ip, $text){
		
	}
}

new Server;
*/


abstract class WebSocket {
	private $socket;
	private $clients;
	
	private $host = 'localhost';
	private $port = 9001;
	
	private $max_connections = 0;
	private $reuseable_socket = true;
	
	
	// Internal Events
	public function __construct($configs = []){
		$acceptable_configs = [
			'host',
			'port',
			'max_connections',
			'reuseable_socket',
		];
		foreach ($configs as $cfg=>$val)
			if(in_array($cfg, $acceptable_configs))
				$this->$cfg = $val;
		
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		
		if ($this->reuseable_socket)
			socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
		
		socket_bind($socket, 0, $this->port);
		socket_listen($socket);
		
		$this->socket = $socket;
		$this->clients = array($socket);
		
		while (true)
			$this->loop();
		socket_close($this->socket);
	}
	protected function loop(){
		$null = null;
		$socket = &$this->socket;
		$clients = &$this->clients;
		
		//manage multipal connections
		$changed = $this->clients;
		//returns the socket resources in $changed array
		socket_select($changed, $null, $null, 0, 10);
		
		//check for new socket
		if (in_array($socket, $changed)) {
			$socket_new = socket_accept($socket); //accpet new socket
			$this->clients[] = $socket_new; //add socket to client array
			
			$header = socket_read($socket_new, 1024); //read data sent by the socket
			$this->perform_handshaking($header, $socket_new); //perform websocket handshake
			
			$this->trigger('onConnect', $socket_new); //get ip address of connected socket
			
			//make room for new socket
			$found_socket = array_search($socket, $changed);
			unset($changed[$found_socket]);
		}
			//loop through all connected sockets
		foreach ($changed as $changed_socket) {	
			
			//check for any incomming data
			while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
			{
				$this->trigger('onReceive', $changed_socket, $this->unmask($buf));
				break 2; //exist this loop
			}
			
			$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
			if ($buf === false) { // check disconnected client
				// remove client for $clients array
				$found_socket = array_search($changed_socket, $clients);
				unset($clients[$found_socket]);
				$this->trigger('onDisconnect', $found_socket);
			}
		}
	}
	protected function trigger($function, $socket, $param = null){
		$ip = null;
		if (gettype($socket) == "resource")
			socket_getpeername($socket, $ip);
		$this->$function($socket, $ip, $param);
	}

	// External Events
	abstract function onConnect($socket, $ip);
	abstract function onReceive($socket, $ip, $text);
	abstract function onDisconnect($socket, $ip);
	
	// Internal Procedures
	public function sendMessage($socket, $msg){
		$msg = $this->mask($msg);
		@socket_write($socket,$msg,strlen($msg));
		return true;
	}
	public function broadcast($msg){
		$clients = &$this->clients;
		foreach($clients as $changed_socket)
		{
			$this->sendMessage($changed_socket, $msg);
		}
		return true;
	}
	
	protected function unmask($text) {
		//Unmask incoming framed message
		$length = ord($text[1]) & 127;
		if($length == 126) {
			$masks = substr($text, 4, 4);
			$data = substr($text, 8);
		}
		elseif($length == 127) {
			$masks = substr($text, 10, 4);
			$data = substr($text, 14);
		}
		else {
			$masks = substr($text, 2, 4);
			$data = substr($text, 6);
		}
		$text = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$text .= $data[$i] ^ $masks[$i%4];
		}
		return $text;
	}

	protected function mask($text){
		//Encode message for transfer to client.
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($text);
		
		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$text;
	}

	protected function perform_handshaking($receved_header,$client_conn)	{
		//handshake new client.
		$host = $this->host;
		$port = $this->port;
		
		$headers = array();
		$lines = preg_split("/\r\n/", $receved_header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
			{
				$headers[$matches[1]] = $matches[2];
			}
		}

		$secKey = $headers['Sec-WebSocket-Key'];
		$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		//hand shaking header
		$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
		"Upgrade: websocket\r\n" .
		"Connection: Upgrade\r\n" .
		"WebSocket-Origin: $host\r\n" .
		"WebSocket-Location: ws://$host:$port/chat/server.php\r\n".
		"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
		socket_write($client_conn,$upgrade,strlen($upgrade));
	}
}

?>