<?php
  // To save some time we are going to create a class to hold the database connection information.
  // As mentioned in the PDF we will define our class using the class keyword followed by the name of our class.
  class Database
  {
    // A private keyword, as the name suggests is the one that can only be accessed from within the class in which it is defined. 
    // All the keywords are by default under the public category unless they are specified as private or protected.
    private $connection;
    //A constructor allows you to initialize an object's properties upon creation of the object. 
    //If you create a __construct() function, 
    //PHP will automatically call this function when you create an object from a class.
    function __construct(){
      // In PHP, $this keyword references the current object of the class. 
      //The $this keyword allows you to access the properties and methods of the current object within the class using the object operator
      $this->connect_db();
    }
    // The public access modifier allows you to access properties and methods from both inside and outside of the class.
    public function connect_db(){
      $this->connection = mysqli_connect('localhost', 'root', '', 'grades');
      if(mysqli_connect_error()){
        die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_error());
      }
    }
    public function create($grade, $assignment, $student, $fileAddress)
    {
      $sql = "INSERT INTO grades_table (grade, assignment, student, image) VALUES ('$grade', '$assignment', '$student', '$fileAddress')";
      $res = mysqli_query($this->connection, $sql);
      if($res)
      {
	 		  return true;
		  }
      else
      {
			  return false;
		  }
    }

    public function createAdmin($username,$password)
    {
      $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
      $res = mysqli_query($this->connection, $sql);
      if($res){
	 		    return true;
		  }
      else{
			    return false;
		  }
    }
    public function deleteEntry($index)
    {
      $sql = "DELETE FROM grades_table WHERE id = $index;";
      $res = mysqli_query($this->connection, $sql);
    }
    public function alterEntry($index, $grade, $assignment, $student, $fileAddress)
    {
      $sql = "UPDATE grades_table SET grade = '$grade', assignment = '$assignment', student = '$student', image ='$fileAddress' WHERE id = $index";
      $res = mysqli_query($this->connection, $sql);
      if($res)
      {
	 		  return true;
		  }
      else
      {
			  return false;
		  }
    }
    public function queryRequest($q)
    {
      $res = mysqli_query($this->connection, $q);
      return $res;
    }

    public function read($id=null)
    {
		    $sql = "SELECT * FROM grades_table";
		    if($id){
          $sql .= " WHERE id='$id'";
        }
 		    $res = mysqli_query($this->connection, $sql);
 		    return $res;
	  }
    public function readAdmin($username=null,$password=null)
    {
      $sql = "SELECT user_id FROM admins";

      if($username && $password)
      {
        $sql .= " WHERE username = '$username' AND password = '$password'";
      }

      $res = mysqli_query($this->connection, $sql);
      return $res;
  }
  
    /*
      This function has two parameters:
        The $inputs parameter is an associative array. It can be $_POST, $_GET, or a regular associative array.
        The $fields parameter is an array that specifies a list of fields with rules.
      The sanitize() function returns an array that contains the sanitized data.
    */
   /* public function sanitize($var){
      $return = mysqli_real_escape_string($this->connection, $var);
      return $return;
    }*/
  }

  $database = new Database();
?>
