<?php
include_once('connect.php');


class system {
	private $id;
	private $name;
	private $value;
	private $mysqli;
	
	
	function __consturct() {
		$this->mysqli = dbConnect();
	}
	
	
	public function getSystemSetting($id) {
		$this->id = $id;
		$sql = "select * from system where id =" . $this->id;
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->name = $row['name'];
				$this->value = $row['value'];
			}
		}
	
	}
	public static function displaySettings() {
		$mysqli = dbConnect();
		$sql = "select * from system";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			echo '<table class="table"><th>Name</th><th>Value</th><th></th>';
			while($row = $result->fetch_assoc()) {
		       		echo '<tr><td>' .$row['name'] . 
		       		'</td><td>' . $row['value'] .
		       		'</td><td><button class="btn btn-success">Edit</button> </td></tr>';
			}
			echo '</table>';
		} else {
			echo "No system settings... Woops.";
		}  
	
	}
	
	public function getId() { return $this->id; }
	public function getName() {return $this->name;}
	public function getValue() {return $this->value;}
	
	public function setId($id) { $this->id = $id; }
	public function setName($name) {$this->name = $name;}
	public function setValue($value) {$this->value = $value;}
	
	
	
}

?>