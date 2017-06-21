<?php 	
//This file is a mirror file of dbconnect.php
//This file is not being used anywhere, but dbconnect.php is being used for database connectivity and contains all kinds of functions being used
class Database
{
    private static $dbName = 'database name here' ;
    private static $dbHost = 'database host here' ;
    private static $dbUsername = 'database username here';
    private static $dbUserPassword = 'database password here';
     
    private static $cont  = null;
     
    public function __construct() {
        
        die('Init function is not allowed');
    }
     
    //Connecting & Disconnecting from database

    public static function connect()    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()    {
        
        self::$cont = null;
    }

    //Admin Register, Login, Sessions, Password recovery , Change password

    public static function adminregister($username,$password,$mobileno,$email)    {
    	
        //some predefined values
        $usertype = "admin";
        $active = 1;
        $deptcode = "adm";
    	//inserts data in admin registration database
    	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username,password,email,mobileno,usertype,active,deptcode) values(?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$password,$email,$mobileno,$usertype,$active,$deptcode));
        Database::disconnect();
    }

    public static function adminlogin($username,$password)	{

    	//data validation
    	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT password,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the password matches
        if($data['password']==$password && $data['usertype']=='admin')	{
            return 1;
        }
    }

    public static function adminsession($user_check)	{

    	//data validation
    	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_check));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether username exists
        if($data['username'] == $user_check && $data['usertype']=='admin')	{
        	return 1;
        }
    }

    public static function adminrecovery($username,$mobileno,$email)	{

    	//Recovering admin password
    	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype,email,mobileno FROM admin WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['username'] == $username && $data['email'] == $email && $data['mobileno'] == $mobileno && $data['usertype'] == "admin")	{
        	return 1;
        }
    }

    public static function adminchangepassword($username,$newpassdb)	{

    	//changing admin password
    	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE admin SET password = ? WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($newpassdb,$username));
        Database::disconnect();

        return 1;
    }


    //Department Register, Login, Sessions, Password recovery , Change password

    public static function departmentlogin($username,$password)  {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT password,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the password matches
        if($data['password']==$password && $data['usertype']=='superuser')  {
            return 1;
        }
    }

    public static function departmentsession($user_check)    {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_check));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether username exists
        if($data['username'] == $user_check && $data['usertype']=='superuser')  {
            return 1;
        }
    }

    public static function departmentchangepassword($username,$newpassdb)    {

        //changing admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($newpassdb,$username));
        Database::disconnect();

        return 1;
    }

    public static function departmentrecovery($username,$mobileno,$email)    {

        //Recovering admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype,email,mobileno FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['username'] == $username && $data['email'] == $email && $data['mobileno'] == $mobileno && $data['usertype'] != "admin")    {
            return 1;
        }
    }


    //Functions for fetching data from database

    public static function registereddepartments()  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT count(username) AS total FROM users where usertype = "normaluser"';
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        echo $data['total'];
        Database::disconnect();
    }

    public static function registereddepartmentsdetails()  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,deptcode,created FROM `users` WHERE `usertype` = 'normaluser' order by created ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        //$data = $q->fetch(PDO::FETCH_ASSOC);
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            Database::departmentsname($data['deptcode']);
            echo "</td><td>";
            echo $data['username'];            
            echo "</td><td>";
            echo $data['created'];
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    public static function publishedelectives() {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) AS total FROM subjects_published";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        echo $data['total'];
        Database::disconnect();
    }

    public static function publishedelectivesdetails() {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT deptcode,subj_code,subject_name,total_seats,semester  FROM `subjects_published` order by subj_code ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        //$data = $q->fetch(PDO::FETCH_ASSOC);
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            Database::departmentsname($data['deptcode']);
            echo "</td><td>";
            echo $data['subj_code'];
            echo "</td><td>";
            echo $data['subject_name'];            
            echo "</td><td>";
            echo $data['semester'];
            echo "</td><td>";
            echo $data['total_seats'];
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    public static function departmentsname($name)    {
        switch ($name) {

            //CSE
            case 'csed':
            $name = "Computer Science & Engineering";
            break;

            //Chemical
            case 'ched':
            $name = "Chemical Engineering";
            break;

            //Civil
            case 'civi':
            $name = "Civil Engineering";
            break;

            //ECE
            case 'eced':
            $name = "   Electronics and Communication Engineering";
            break;

            //EEE
            case 'eeed':
            $name = "Electrical Engineering";
            break;

            //Mechanical
            case 'med':
            $name = "Mechanical Engineering";
            break;

            //Materials Science and Engineering
            case 'msed':
            $name = "Materials Science and Engineering";
            break;

            //Architecture
            case 'arch':
            $name = "Architecture";
            break;

            //default case
            default:
            $name = "Unknown Department";
            break;
        }
        echo $name;
    }


}
?>