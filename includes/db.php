<?php
define("HOST", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "tee");

//This class represents the database connection to mysql db
class Database{
    
    private $sqliConnection;
    
    public function __construct(){
        
        //establish connection to database using db-specific driver
        $this->sqliConnection = new mysqli(HOST,USER_NAME, PASSWORD, DB_NAME);
    
        if($this->sqliConnection->connect_error){
        
           die("Connection error " . $this->sqliConnection->connect_error);
        
        }
        
    }
    public function close(){
        
        $this->sqliConnection->close();  
        
    }

    //Excute query and return the result set
    //This result set is meant to be passed in to the fetch_array method
    public function query($sSQL){
         
        $resResult = $this->sqliConnection->query($sSQL);
        
        if(!$resResult){
        
            die("Query fails " . $sSQL);
        
        }
        
        return $resResult; 
    }
    
    //Precondition: the result set passed in must be returned from
    //the query() method
    public function fetch_array($resResult){
        
        return $resResult->fetch_array(MYSQLI_ASSOC);
        
    }  

    //this method returns the last auto-increment number
    public function get_insert_id(){

        return $this->sqliConnection->insert_id;

    }


    //method for filtering input and output
    public function escape_value($value){
        
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysqli_real_escape_string"); // i.e. PHP >= v4.3.0 // fids out if the function exists (doesn't exist in all PHP) // this function is better than addslashes etc
        
        if($new_enough_php){ // PHP v4.3.0 or higher // if that function exists
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if($magic_quotes_active){
                $value = stripslashes($value);
            }

            $value = $this->sqliConnection->real_escape_string($value);
            
        }else{ // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if(!$magic_quotes_active){ // if magic quotes aren't on
                $value = addslashes($value); // update the value to go into the database by escaping with slashes
            }
            // if magic quotes are active, then the slashes already exist
        }
        return $value;
    }

}

?>