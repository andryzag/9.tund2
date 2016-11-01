<?php 
class Interest {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function saveInterest ($interest) {
		
		$stmt = $this->connection->prepare("INSERT INTO interests (interest) VALUES (?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("s", $interest);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$this->connection->close();
		
	}
	
	function saveUserInterest ($interest) {
		
		$stmt = $this->connection->prepare("
			SELECT id FROM user_interests 
			WHERE user_id=? AND interest_id=?
		");
		$stmt->bind_param("ii", $_SESSION["userId"], $interest);
		$stmt->bind_result($id);
		
		$stmt->execute();
		
		if ($stmt->fetch()) {
			// oli olemas juba selline rida
			echo "juba olemas";
			// pärast returni midagi edasi ei tehta funktsioonis
			return;
			
		} 
		
		$stmt->close();
		
		// kui ei olnud siis sisestan
		
		$stmt = $this->connection->prepare("
			INSERT INTO user_interests
			(user_id, interest_id) VALUES (?, ?)
		");
		
		echo $this->connection->error;
		
		$stmt->bind_param("ii", $_SESSION["userId"], $interest);
		
		if ($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	function saveCar ($plate, $color) {

		$stmt = $this->connection->prepare("INSERT INTO cars_and_colors (plate, color) VALUES (?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $plate, $color);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$this->connection->close();
		
	}
	
} 
?>