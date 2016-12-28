<?php

class DB {

    private $dbh;

    function __construct(){
        require_once("../dbinfo.php"); // wherever our DB info file will be

        try{
            $this->dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } // constructor

    /*
     * Takes a table name, and optional sql string
     * Prepares and executes the statement
     * @param $objName
     * @param $sqlString
     * @return: $results
     */
    function returnObject($objName, $sqlString=""){
      try{
          $results = array();
              if($sqlString == "") {
                $sqlString = "SELECT * FROM " .$objName;
              }
          $stmnt = $this->dbh->prepare($sqlString);
          $stmnt->execute();
          $stmnt->setFetchMode(PDO::FETCH_CLASS,$objName);
          while($result = $stmnt->fetch()){ // or just fetchALl();
              $results[] = $result;
          }
          return $results;
      }
      catch(PDOException $e){
          echo $e->getMessage();
          die();
      }
    }

    /*
     * Retrieves all projects, returns project objects array
     * @return projects object
     */
    function getAllProjects(){
        return $this->returnObject("Project");
    }


    /*
     * Method that returns all professors (Accounts)
     * @return accounts object
     */
    function getAllAccounts(){
      return $this->returnObject("Account");
    }


    /*
     * Returns all projects based on account ID
     * @param $accountID
     * @return $projects
     */
    function getAccountProjects($accountID){
        try{
        	$projects = array();
        	$stmt = $this->dbh->prepare("select * from Project where AccountID = :id");
          $stmt->execute(array(":id"=>$accountID));
          $stmt->setFetchMode(PDO::FETCH_CLASS,"Project");
    			while ($row = $stmt->fetch()){
    				$projects[] = $row;
    			}
    			return $projects;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }

    /*
     * Returns all accounts associated with a project
     * @param $projectID
     * @return $professors
     */
    function getProjectContributers($projectID){
        try{
        	$professors = array();
        	$stmt = $this->dbh->prepare("select Account.FirstName,Account.LastName from Project,
          Account where ProjectID = :id AND Project.AccountID = Account.AccountID");
          $stmt->execute(array(":id"=>$projectID));
          while ($row = $stmt->fetch())
          {
            $professors[] = $row;
          }
        	return $professors;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Returns all entries associated with a project
     * @param $projectID
     * @return $entries
     */
    function getProjectEntries($projectID){
        try{

	      $entries = array();
		  $stmt = $this->dbh->prepare("select * from Entry where projectID = :id");
          $stmt->execute(array(":id"=>$projectID));
          $stmt->setFetchMode(PDO::FETCH_CLASS,"Entry");
    			while ($row = $stmt->fetch())
          {
    				$entries[] = $row;
    			}
    			return $entries;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Returns array with firstname, lastname and email of an account
     * @param $accountID
     * @return $professor
     */
    function getAccountName($accountID){
        try{
        	$professor = array();
        	$stmt = $this->dbh->prepare("select firstName,lastName, email from Account where accountID = :id");
          $stmt->execute(array(":id"=>$accountID));
    			while ($row = $stmt->fetch())
          {
    				$professor[] = $row;
    			}
        	return $professor;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }

    /*
     * Returns account ID based on email
     * @param $email
     * @return $professor
     */
    function getAccountIDbyLogin($email){
        try{
          $professor = array();
          $stmt = $this->dbh->prepare("SELECT AccountID FROM Account WHERE Email = :id");
          $stmt->execute(array(":id"=>$email));
          while ($row = $stmt->fetch())
          {
            $professor[] = $row;
          }
          return $professor;
        }
        catch(PDOException $e){
          echo $e->getMessage();
          die();
        }
    }


    /*
     * Returns accountID based on projectID
     * @param $projectID
     * @return $projects
     */
    function getAccountIdFromProject($projectID){
        try{
          $projects = array();
          $stmt = $this->dbh->prepare("SELECT AccountID FROM Project WHERE ProjectID = :id");
          $stmt->execute(array(":id"=>$projectID));
          while ($row = $stmt->fetch())
          {
            $projects[] = $row;
          }
          return $projects;
        }
        catch(PDOException $e){
          echo $e->getMessage();
          die();
        }
    }


    /*
     * Returns project object based on project ID
     * @param $projectID
     * @return $project
     */
    function getProject($projectID){
    	try{
        	$project = array();
        	$stmt = $this->dbh->prepare("SELECT * FROM Project WHERE ProjectID = :id");
          $stmt->execute(array(":id"=>$projectID));
          $stmt->setFetchMode(PDO::FETCH_CLASS,"Project");
    			while ($row = $stmt->fetch())
          {
    				$project[] = $row;
    			}
          //var_dump($project);
        	return $project;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Returns entry based on entryID
     * @param $entryID
     * @return $entry
     */
    function getEntry($entryID){
      try{
          $entry = array();
          $stmt = $this->dbh->prepare("SELECT * FROM Entry WHERE EntryID = :id");
          $stmt->execute(array(":id"=>$entryID));
          $stmt->setFetchMode(PDO::FETCH_CLASS,"Entry");
          while ($row = $stmt->fetch())
          {
            $entry[] = $row;
          }
          //var_dump($project);
          return $entry;
        }
        catch(PDOException $e){
          echo $e->getMessage();
          die();
        }
    }

    /*
     * Sorts professors by last name
     * @return $sortedProf
     */
    function sortByProf(){
    	try{
        	$sortedProf = array();
        	$stmt = $this->dbh->prepare("SELECT Project.ProjectID, Project.ProjectName, Project.AccountID, Project.Abstract, Project.PostDate FROM Project,Account WHERE Project.AccountID = Account.AccountID ORDER BY Account.LastName ASC");
        	$stmt->execute();
          while ($row = $stmt->fetch())
          {
            $sortedProf[] = $row;
          }
        	return $sortedProf;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Sorts projects by date
     * @return $sortedDate
     */
    function sortByDate(){
    	try{
        	$sortedDate = array();
        	$stmt = $this->dbh->prepare("SELECT * FROM Project ORDER BY PostDate ASC");
        	$stmt->execute();
          while ($row = $stmt->fetch())
          {
    				$sortedDate[] = $row;
    			}
        	return $sortedDate;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Returns all projects sorted by project name
     * @return $sortedName
     */
    function sortAlpha(){
	    try{
        	$sortedName = array();
        	$stmt = $this->dbh->prepare("SELECT * FROM Project ORDER BY ProjectName ASC");
        	$stmt->execute();
          while ($row = $stmt->fetch())
          {
    				$sortedName[] = $row;
    			}
        	return $sortedName;
        }
        catch(PDOException $e){
        	echo $e->getMessage();
        	die();
        }
    }


    /*
     * Checks to see if password email values match
     * @param $email
     * @param $password
     * @return boolean
     */
    function checkPassword($email, $password){
        try{
          $passwordOutput;
          $stmt = $this->dbh->prepare("SELECT Password FROM Account WHERE Email = :email");
          $stmt->execute(array(":email"=>$email));
          while ($row = $stmt->fetch())
          {
            $passwordOutput = $row;
          }
          echo $passwordOutput[0] . "<br/>";
          if($passwordOutput[0] == $password){
            return true;
          } else {
            return false;
          }
        }
        catch(PDOException $e){
          echo $e->getMessage();
          die();
        }
    }


    /*
     * Searches project results based on string and order by
     * @param $likeString
     * @param $orderBy
     * @return object array
     */
    function searchProjectResults($likeString, $orderBy){
    	try{
    		$order = "";
    		if($orderBy == "FirstName" || $orderBy == "LastName"){
    			$order = "a.".$orderBy;
    		} else {
    			$order = "p.".$orderBy;
    		}

    		return $this->returnObject(
    			"Project",
    			"Select * FROM Project p
    			 INNER JOIN Account a
    			 on a.AccountID = p.AccountID
    			 WHERE p.ProjectName LIKE '%".$likeString."%'
    			 OR    p.Abstract    LIKE '%".$likeString."%'
    			 OR    a.FirstName	 LIKE '%".$likeString."%'
    			 OR	   a.LastName 	 Like '%".$likeString."%'
    			 ORDER BY $order"
    		);

    	}
    	catch(PDOException $e){
    		echo $e->getMessage();
    		die();
    	}
    }


    /*
     * Searches account results for likeString
     * @param $likeString
     * @return object array
     */
    function searchAccountResults($likeString){
    	try{

    		return $this->returnObject(
    			"Account",
    			"Select * FROM Account a
    			 WHERE a.FirstName   LIKE '%".$likeString."%'
    			 OR    a.LastName    LIKE '%".$likeString."%'
    			 OR    a.Email   	 LIKE '%".$likeString."%'"
    		);

    	}
    	catch(PDOException $e){
    		echo $e->getMessage();
    		die();
    	}
    }


    /*
     * Creates a project
     * @param $name
     * @param $abstract
     * @param $accountID
     */
    function createProject($name, $abstract, $accountID){
      try{
            //$accountID = is_null($accountID) ? 1 : $accountID;
            $stmnt = $this->dbh->prepare("INSERT INTO Project (ProjectName, Abstract, AccountID, PostDate) VALUES (:pName, :pAbstract, :pAccountID, NOW())");

            // Sanitize
            $pName = filter_var($name, FILTER_SANITIZE_STRING);
            $pAbstract = filter_var($abstract, FILTER_SANITIZE_STRING);
            $pAccountID = filter_var($accountID, FILTER_SANITIZE_NUMBER_INT);

            // Bind
            $stmnt->bindParam(':pName', $pName, PDO::PARAM_STR);
            $stmnt->bindParam(':pAbstract', $pAbstract, PDO::PARAM_STR);
            $stmnt->bindParam(':pAccountID', $pAccountID, PDO::PARAM_INT);

            $stmnt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }


    /*
     * Updates a project with new values
     * @param $projectID
     * @param $projectName
     * @param $projectAbstract
     */
    function updateProject($projectID, $projectName, $projectAbstract){
      try{
            //$stmnt = $this->dbh->prepare('UPDATE Project SET ProjectName = "'.$projectName.'" ,Abstract = "'.$projectAbstract.'" WHERE ProjectID='.$projectID);

            $stmnt = $this->dbh->prepare("UPDATE Project SET ProjectName = :projectName ,Abstract = :projectAbstract WHERE ProjectID= :projectID");

            // Sanitize Values
            $pName     = filter_var($projectName, FILTER_SANITIZE_STRING);
            $pAbstract = filter_var($projectAbstract, FILTER_SANITIZE_STRING);
            $pId       =  filter_var($projectID, FILTER_SANITIZE_NUMBER_INT);

            // Bind Parameters
			$stmnt->bindParam(':projectName', $pName, PDO::PARAM_STR);
			$stmnt->bindParam(':projectAbstract', $pAbstract, PDO::PARAM_STR);
			$stmnt->bindParam(':projectID', $pId, PDO::PARAM_INT);

            $stmnt->execute();
        }
        catch(PDOException $e){
            echo "Project ID: " . $projectID . "<br>";
            var_dump($stmnt);
            echo $e->getMessage();
            die();
        }
    }

    /*
     * Delete a project
     * @param $projectID
     */
    function deleteProject($projectID){
      	try{
            $sql = "DELETE FROM Project WHERE ProjectID =  :projectID";
            $stmnt = $this->dbh->prepare($sql);
            $stmnt->bindParam(':projectID', $projectID, PDO::PARAM_INT);
            $stmnt->execute();
          }
          catch(PDOException $e){
          	echo $e->getMessage();
          	die();
          }
    }

    /*
     * Delete a Entry
     * @param $entryID
     */
    function deleteEntry($entryID){
      	try{
            $sql = "DELETE FROM Entry WHERE EntryID =  :entryID";
            $stmnt = $this->dbh->prepare($sql);
            $stmnt->bindParam(':entryID', $entryID, PDO::PARAM_INT);
            $stmnt->execute();
          }
          catch(PDOException $e){
          	echo $e->getMessage();
          	die();
          }
    }



    /*
     * Creates an entry
     * @param $projectID
     * @param $accountID
     * @param $entryContent
     * @param $dueDate
     */
    function createEntry($projectID, $accountID, $entryContent, $dueDate){
      try{
            //$accountID = is_null($accountID) ? 1 : $accountID;
            $stmnt = $this->dbh->prepare("INSERT INTO Entry (AccountID, Description, ProjectID, PostDate, DueDate) VALUES (:accountID, :entryContent, :projectID, NOW(), :dueDate)");

            // Sanitize
            $pID        = filter_var($projectID, FILTER_SANITIZE_NUMBER_INT);
            $aID 		= filter_var($accountID, FILTER_SANITIZE_NUMBER_INT);
            $eContent   = filter_var($entryContent, FILTER_SANITIZE_STRING);
            $eDate		= filter_var($dueDate, FILTER_SANITIZE_STRING);

            // Bind params
            $stmnt->bindParam(':accountID', $aID, PDO::PARAM_STR);
            $stmnt->bindParam(':entryContent', $eContent, PDO::PARAM_STR);
            $stmnt->bindParam(':projectID', $pID, PDO::PARAM_INT);
            $stmnt->bindParam(':dueDate', $eDate, PDO::PARAM_STR);

            $stmnt->execute();
        }
        catch(PDOException $e){
            var_dump($stmnt);
            echo "\nPDO::errorInfo():\n";
            echo $e->getMessage();
            die();
        }
    }


    /*
     * Updates an entry with new values
     * @param $entryID
     * @param $entryContent
     * @param $dueDate
     */
    function editEntry($entryID, $entryContent, $dueDate){
      try{
            //$stmnt = $this->dbh->prepare("UPDATE Entry SET Description = '{$entryContent}', DueDate = '{$dueDate}' WHERE EntryID = {$entryID} ");
            $stmnt = $this->dbh->prepare("UPDATE Entry SET Description = :entryContent, DueDate = :dueDate WHERE EntryID = :entryID ");

			// Sanitize - Unsure Date Validation, but we are using a calendar input
			$eId = filter_var($entryID, FILTER_SANITIZE_NUMBER_INT);
			$eDate = filter_var($dueDate, FILTER_SANITIZE_STRING);
            $eContent = filter_var($entryContent, FILTER_SANITIZE_STRING);

            // Bind Params
            $stmnt->bindParam(':entryContent', $eContent, PDO::PARAM_STR);
            $stmnt->bindParam(':entryID', $eId, PDO::PARAM_STR);
            $stmnt->bindParam(':dueDate', $eDate, PDO::PARAM_STR);

            $stmnt->execute();
        }
        catch(PDOException $e){
            echo "Entry ID: " . $entryID . "<br>";
            var_dump($stmnt);
            echo $e->getMessage();
            die();
        }

    }


    /*
     * Creates an account
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @param $accountType
     */
    function createAccount($firstName, $lastName, $email, $password, $accountType){
      try{
            $stmnt = $this->dbh->prepare("INSERT INTO Account (FirstName, LastName, Email, Password, AccountType) VALUES (:firstName, :lastName, :email, :password, :accountType)");

            // Sanitize
            $fname = filter_var($firstName, FILTER_SANITIZE_STRING);
            $lname = filter_var($lastName, FILTER_SANITIZE_STRING);
            $emailp = filter_var($email, FILTER_VALIDATE_EMAIL);
            //$pwd = password_hash($password, PASSWORD_BCRYPT);
            $aType = filter_var($accountType, FILTER_SANITIZE_STRING);

            // Bind
            $stmnt->bindParam(':firstName', $fname, PDO::PARAM_STR);
            $stmnt->bindParam(':lastName', $lname, PDO::PARAM_STR);
            $stmnt->bindParam(':email', $emailp, PDO::PARAM_STR);
            $stmnt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmnt->bindParam(':accountType', $aType, PDO::PARAM_STR);


            $stmnt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }


}
