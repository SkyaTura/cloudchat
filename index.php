<?php
include "WebSocket.php";

class Server extends WebSocket {
	public function onConnect($socket, $ip){
		$broadcast = json_encode(array('type'=>'system', 'message'=>$ip.' connected')); //prepare json data
		$this->broadcast($broadcast);
		echo "New connection from $ip\r\n";
	}
	public function onDisconnect($socket, $ip){
		$broadcast = json_encode(array('type'=>'system', 'message'=>$ip.' disconnected')); //prepare json data
		$this->broadcast($broadcast);
		echo "Disconnected from $ip\r\n";
	}
	public function onReceive($socket, $ip, $text){
		$tst_msg = json_decode($text); //json decode 
		$user_name = $tst_msg->name; //sender name
		$user_message = $tst_msg->message; //message text
		$user_color = $tst_msg->color; //color
		
		$broadcast = json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message, 'color'=>$user_color));
		$this->broadcast($broadcast);
	}
}

new Server();

?>