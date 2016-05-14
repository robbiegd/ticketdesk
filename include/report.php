<?php
include_once('connect.php');



class report {
	
	private $mysqli;
	private $startDate;
	private $endDate;
	private $user;
	private $clientId;
	private $name;
	
	public function __construct() {
		$this->mysqli = dbConnect();
	}
	
	// gets
	public function getMysqli() {return $this->mysqli;}
	public function getStartDate() {return $this->startDate;}
	public function getEndDate() {return $this->endDate;}
	public function getUser() {return $this->user;}
	public function getClientId() {return $this->clientId;}
	public function getName() {return $this->name;}
	
	// sets
	public function setMysqli($mysqli) { $this->mysqli = $mysqli;}
	public function setStartDate($startDate) {$this->startDate = $startDate;}
	public function setEndDate($endDate) {$this->endDate = $endDate;}
	public function setUser($user) {$this->user = $user;}
	public function setClientId($clientId) {$this->clientId = $clientId;}
	public function setName($name) {$this->name = $name;}
	
	
	public function createReport() {
	 
	    header('Content-Type: text/csv; charset=utf-8');
	    header('Content-Disposition: attachment; filename='. $this->name. '.csv');
	    $output = fopen('php://output', 'w');
	    
	    // output the column headings
	    fputcsv($output, array('User', 'OpenDate','Status','clientId','Category','SubCategory','Notes'));
	    $sql = 'select 
			t.id, 
			t.opendate,
			t.user as opened_by, 
			t.assigneduser as assigned_to, 
			t.comments as ticket_details, 
			ts.status,
			ts.statusdate,
			tn.note, 
			tn.notedate
				from tickets t, ticketnotes tn, categories c, subcategories sc,ticketstatus ts
					where t.id = tn.ticketid
					and ts.ticketid = t.id
					and t.categoryid = c.id
					and t.subcategoryid = sc.id';
	    
	    if ($stmt = mysqli_prepare($this->mysqli, $sql ) ) {
	
	        //mysqli_stmt_bind_param($stmt,"ss", $this->startDate,$this->endDate);
	        $stmt->execute();
	        $result = $stmt->get_result();
	        while ($row = $result->fetch_assoc()) {
	            fputcsv($output, $row);
	        }
	    }
	    mysqli_close($this->mysqli);  
	
	}
	


}


?>