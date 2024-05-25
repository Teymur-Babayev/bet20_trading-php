<?php

Class Database{
	private $host   = "localhost";
	private $user   = "root";
	private $pass   = "";
	private $dbname = "sunt";
	
	
	public $link;
	public $error;
        
        public $msg;


        public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
	  $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	if(!$this->link){
		$this->error ="Connection fail".$this->link->connect_error;
		return false;
	}
 }
	
	// Select or Read data
	
	public function select($query){
	$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($query){
	$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($insert_row){
            return $insert_row;
	} else {
            return FALSE;
	}
  }
  
    // Update data
  	public function update($query){
	$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($update_row){
            $this->msg="Data Updated successfully";
	
                return $update_row;
	} else {
		die("Error :(".$this->link->errno.")".$this->link->error);
	}
  }
  
  // Delete data
   public function delete($query){
	$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($delete_row){
	    $this->msg="Data Deleted successfully";
                return $delete_row;
	} else {
		die("Error :(".$this->link->errno.")".$this->link->error);
	}
  }

 
 
}

