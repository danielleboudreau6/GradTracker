<?php

/* 
 * DbHandler.php
 * Class to handle all database operations
 * This class will have all the CRUD methods:
 * C - Create
 * R - Read
 * U - Update
 * D - Delete
 */

class DbHandler{
    
    //private variable to hold the connection
    private $conn;
    
    //Constructor object - will run automatically when class is instantiated
    function __construct() {
        //Initialize the database 
        require_once dirname(__FILE__.'/DbConnect.php');
        //Open db Connection
        try{
            $db = new DbConnect();
            $this->conn = $db->connect();
            
        } catch (Exception $ex) {
            $this::dbConnectError($ex->getCode());
        }
        
    }//End of constructor
    
    //Create a static function called dbConnectError
    //A static function can be called without instantiating the class
    //in other words no need to use the new keyword
    private static function dbConnectError($code){
        switch ($code) {
            case 1045:
                echo "A database access error has occurred.";
                break;
            case 2002:
                echo "A database server error has occurred.";
                break;            
            default:
                echo "A server error has occurred.";
                break;
        }//end of swith        
    }//End of dbConnectError function
    
    
    /**
     * getCategoryList() function
     * Get a list of categories for creating menu
     */
    
    // ---------------------------------------------- DATABASE QUERIES ----------------------------------------------
    
    public function getStudents(){
        $sql = "select concat(fname, ' ', lname) as Name, gradyear as 'Grad Year', company_name as 'Company', title_name as Title
                      from grads join employment on grads.grad_id = employment.grad_id
                      join companies on employment.company_id = companies.company_id
                      join titles on employment.title_id = titles.title_id
                      order by gradyear desc, name;";
        try{
            $stmt = $this->conn->query($sql);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Create an array to hold success|failure
            //data|message
            $data = array('error'=>false,
                          'items'=>$students
                         );
            
        } catch (PDOException $ex) {
            $data = array('error'=>true,
                          'message'=>$ex->getMessage()
                         );
        }//end of try catch
        
        //Return data back to calling environment
        return $data;
        
    }//end of getStudents Method
    
    
    public function getCompanies(){
        $sql="SELECT company_name as Company, city as City, website as Website from companies order by 1;";
        
        try{
            $stmt = $this->conn->query($sql);
            $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Create an array to hold success|failure
            //data|message
            $data = array('error'=>false,
                          'items'=>$sql
                         );
            
        } catch (PDOException $ex) {
            $data = array('error'=>true,
                          'message'=>$ex->getMessage()
                         );
        }//end of try catch
        
        //Return data back to calling environment
        return $data;
        
    }//End of getCompanies
    
    
    public function addCompany($company_name){
        //First check if company already exists in table
        if(!$this->isCompanyExists($company_name)){
            //Company does not exist - continue

            // insert a new company to the database
            
            $stmt = $this->conn->prepare("insert into companies (company_name)
                                          values (:company_name)");
            // bind parameters
            $stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR);
//            $stmt->bindValue(':pass', $password_hash, PDO::PARAM_STR);
//            $stmt->bindValue(':fname', $first_name, PDO::PARAM_STR);
//            $stmt->bindValue(':lname', $last_name, PDO::PARAM_STR);
//            $stmt->bindValue(':active', $active, PDO::PARAM_STR);
            
            // execute the statement 
            $result = $stmt->execute();
            
            // prepare the array of results
            if($result) {
                // success - build success message
                $data=array(
                            'error'=>false, 
                            'message'=>'COMPANY_ADD_SUCCESS'
                           );
                
            }
            else {
                // fail - build fail message
                $data=array(
                            'error'=>true, 
                            'message'=>'COMPANY_ADD_FAIL'
                           );
            }
            
        }
        else{
            // company already exists - return error and message
            $data=array('error'=>true,                
                        'message'=>'COMPANY_ALREADY_EXISTS'
            );
            
        }
        
        //Return one final data array
        return $data;
    }//End of addCompany
    
    
    
    // ---------------------------------------------- REGISTER USER ----------------------------------------------
    
        public function createUser($email, $password, $first_name, $last_name) {
        //First check if user already exists in table
        if (!$this->isUserExists($email)) {
            //User does not exist - continue
            //Generate password hash'
            $password_hash = PassHash::hash($password);
            //Generate random activation code
            $active = md5(uniqid(rand(), true));
            //Insert user in database using prepared statement
            //Note:  set date_expires to yesterday (until they activate account)
            $stmt = $this->conn->prepare("INSERT INTO members(email,password,first_name,last_name,active)
                                          VALUES(:email, :password, :fname, :lname, :active)");
            //Bind parameters
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':fname', $first_name, PDO::PARAM_STR);
            $stmt->bindValue(':lname', $last_name, PDO::PARAM_STR);
            $stmt->bindValue(':active', $active, PDO::PARAM_STR);
            //Execute statement
            $result = $stmt->execute();
            //Prepare array for result
            if ($result) {
                // User successfully inserted
                $data = array(
                    'error' => false,
                    'message' => 'USER_CREATE_SUCCESS',
                    'active' => $active
                );
            } else {
                // Failed to create user
                $data = array(
                    'error' => true,
                    'message' => 'USER_CREATE_FAIL',
                );
            }
        } else {
            //User already exists - return error and message
            $data = array('error' => true,
                'message' => 'USER_ALREADY_EXISTS'
            );
        }
        //Return one final data array
        return $data;
    }
//End of createUser

    
    private function isUserExists($email){
       $stmt=$this->conn->prepare("SELECT COUNT(*)
                                   FROM members
                                   WHERE email=:email"); 
       $stmt->bindValue(':email',$email, PDO::PARAM_STR);
       $stmt->execute();
       $num_rows = $stmt->fetchColumn();
       
       return $num_rows>0;
       
    }
    
    
    private function isCompanyExists($company_name){
       $stmt=$this->conn->prepare("SELECT COUNT(*)
                                   FROM companies
                                   WHERE company_name=:company_name"); 
       $stmt->bindValue(':company_name',$company_name, PDO::PARAM_STR);
       $stmt->execute();
       $num_rows = $stmt->fetchColumn();
       
       return $num_rows>0;
       
    }
    
    public function activateUser($email, $active) {
    if ($this->isUserExists($email)) {
        //User exists in database - update table (date_expires and active)      
        $stmt = $this->conn->prepare("UPDATE members SET active=NULL 
                                     WHERE email=:email AND active = :active");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':active', $active, PDO::PARAM_STR);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        //Check for successfull update
        if ($count > 0) {
            //User successfully activated
            $data = array('error' => false,
                'message' => 'USER_ACTIVE_SUCCESS');
        } else {
            //Failed to activate user
            $data = array('error' => true,
                'message' => 'USER_ACTIVE_FAIL');
        }
    } else {
        //Account does not exist in database
        $data = array('error' => true,
            'message' => 'USER_ACTIVE_FAIL');
    }
    return $data;
}


//End activateUser

public function checkLogin($email,$password){
        // check if email is in the database
        if($this->isUserExists($email)){
            // email exists, now check the email password combination
            $stmt=$this->conn->prepare("SELECT pass 
                                        FROM users 
                                        WHERE email =:email");
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
            $stmt->execute();
            
            // fetch record as pdo object
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            
            //check hash against form password
            if(PassHash::check_password($row->pass,$password)){
                // password is a match
                return true;
            }else{
                return false;
            }
            
        }else{
            // email was not found
            return false;
        }
        
        
        
    }
    
    public function getUserByEmail($email){
        // retrieve all info by user
        // should use try catch when going to database 
        try{
            $stmt=$this->conn->prepare("SELECT id, type, email, first_name, last_name, 
                                         IF(date_expires<=NOW(),true,false) as expired,
                                         IF(type='admin',true,false) as admin
                                         FROM users
                                         WHERE email=:email");
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
            if($stmt->execute()){
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data = array(
                    'error'=>false,
                    'items'=>$user
                );
                return $data;
            }else{
                return null;
            }            
            
        }catch(PDOException $ex){
            return null;
        }
        
        
    }

//public function checkLogin($email, $password) {
//    // fetching user by email
//    //var_dump($email);
//    //var_dump($password);
//    //var_dump(PassHash::hash($password));
//    //exit();
//    //1. Check if email exists
//    $stmt = $this->conn->prepare("SELECT COUNT(*) from users WHERE email = :email");
//    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//    $stmt->execute();
//    $num_rows = $stmt->fetchColumn();
//    //var_dump($num_rows);
//    //exit();
//    if ($num_rows > 0) {
//        //2. Actual query
//        $stmt = $this->conn->prepare("SELECT pass from users WHERE email = :email");
//        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//        $stmt->execute();
//        $row = $stmt->fetch(PDO::FETCH_OBJ);
//        if (PassHash::check_password($row->pass, $password)) {
//            // User password is correct
//            return TRUE;
//        } else {
//            // user password is incorrect
//            return FALSE;
//        }
//    } else {
//        // user not existed with the email
//        return FALSE;
//    }
//}//End checkLogin
//
//public function getUserByEmail($email) {
//    try {
//        $stmt = $this->conn->prepare("SELECT id, type, email, first_name, last_name, 
//                                     IF(date_expires>=NOW(),true,false) as notexpired,
//                                     IF(type='admin',true,false)as admin
//                                     FROM users WHERE email = :email");
//        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//        if ($stmt->execute()) {
//            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            //return $user;
//            $data = array('error' => false,
//                'items' => $user);
//            return $data;
//        } else {
//            return NULL;
//        }
//    } catch (PDOException $e) {
//        return NULL;
//    }
//}
//
//
//
//    }

    
    
//    public function getArticle($id){
//        try{
//            //Prepare our sql query with $id param coming from 
//            //outside environment
//            $stmt=$this->conn->prepare("SELECT title,description,content
//                                        FROM pages 
//                                        WHERE id=:id");
//            //Bind our parameter
//            $stmt->bindValue(':id',$id,PDO::PARAM_INT);
//            
//            //Execute the query
//            $stmt->execute();
//            
//            //Fetch the data as an associative array
//            $page = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            
//            //Return array of data items
//            $data = array(
//                'error' =>false,
//                'items'=>$page
//            );
//            
//        } catch (PDOException $ex) {
//                $data = array('error'=>true,
//                              'message'=>$ex->getMessage()
//                             );
//        }//end of try catch
//        
//        //Return final data array
//        return $data;
//        
//    }//end of getArticle
//    
//    
//     public function getArticles(){
//  
//            //build our sql query
//            $sql = "SELECT id, title, description FROM pages ORDER BY title";
//
//            try{
//                $stmt=$this->conn->query($sql);
//                $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                //Return array of data items
//                $data = array(
//                    'error' =>false,
//                    'items'=>$articles
//                );               
//                
//            } catch (PDOException $ex) {
//                $data = array('error'=>true,
//                              'message'=>$ex->getMessage()
//                             );
//            }//end of try catch
//        
//        //Return final data array
//        return $data;
//        
//    }//end of getArticles
    
     
//End of Class