<?php 
class Get {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function getAllInterests() {

		$stmt = $this->connection->prepare("
			SELECT id, interest
			FROM interests
		");
		echo $this->connection->error;
		
		$stmt->bind_result($id, $interest);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->id = $id;
			$i->interest = $interest;
		
			array_push($result, $i);
		}
		
		$stmt->close();
		$this->connection->close();
		
		return $result;
	}
	
	function getAllUserInterests() {
		
		$stmt = $this->connection->prepare("
			SELECT interest FROM interests
			JOIN user_interests 
			ON interests.id=user_interests.interest_id
			WHERE user_interests.user_id = ?
		");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		
		$stmt->bind_result($interest);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->interest = $interest;
		
			array_push($result, $i);
		}
		
		$stmt->close();
		$this->connection->close();
		
		return $result;
	}

	function getAllCars() {

		$stmt = $this->connection->prepare("
			SELECT id, plate, color
			FROM cars_and_colors
			WHERE deleted IS NULL
		");
		echo $this->connection->error;
		
		$stmt->bind_result($id, $plate, $color);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$car = new StdClass();
			
			$car->id = $id;
			$car->plate = $plate;
			$car->carColor = $color;
			
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $car);
		}
		
		$stmt->close();
		$this->connection->close();
		
		return $result;
	}

} 
?>