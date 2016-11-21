<?php

class RpmChatDb {
  private $dbConnection;
  
  public function __construct() {
	try {
	    $this->dbConnection = new PDO("sqlite:/var/Databases/chat.sqlite"); //tietokanta
	    //$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	    //$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	   $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex) {
	    echo "ErrMsg to enduser!<hr>\n";
	   echo "CatchErrMsg: " . $ex->getMessage() . "<hr>\n";
	    logError($ex->getMessage());
	}
  }



  /******************************************  getMessages   ******************************** *****/
  public function getMessages() {
    $messages = array();
    $query = <<<SQL
        SELECT 
          `chat`.`message`, 
          `chat`.`sent_on`,
          `users`.`id`, 
          `users`.`username`
        FROM `users`
        JOIN `chat`
          ON `chat`.`user_id` = `users`.`id`
        ORDER BY `sent_on` DESC
SQL;
    
    $resultObj = $this->dbConnection->query($query);

    while ($row = $resultObj->fetch(PDO::FETCH_ASSOC)) {
      $messages[] = $row;
    }
    
    return $messages;
  }

  /******************************************  getUser   ******************************** *****/
  public function getUser() {
    $users = array();
    $query = <<<SQL
        SELECT 
          `users`.`id`, 
          `users`.`username`
        FROM `users`
          WHERE `users`.`id` = :session_user_id
SQL;
    
    $resultObj = $this->dbConnection->prepare($query);
    $resultObj->bindValue(':session_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $resultObj->execute();
    
    while ($row = $resultObj->fetch(PDO::FETCH_ASSOC)) {
      $users[] = $row;
    }
    
    return $users;
  }


  /******************************************  getAllUsers   ******************************** *****/
  public function getAllUsers() {
    $users = array();
    $query = <<<SQL
        SELECT 
          `users`.`id`, 
          `users`.`username`
        FROM `users`
SQL;
    
    $resultObj = $this->dbConnection->prepare($query);
    $resultObj->execute();
    
    while ($row = $resultObj->fetch(PDO::FETCH_ASSOC)) {
      $users[] = $row;
    }
    
    return $users;
  }



  /******************************************  addMessage   ***********************************/

  public function addMessage($userId, $message) {
    $addResult = 0;
    
    $cUserId = (int) $userId;
    
    $query = <<<SQL
      INSERT INTO `chat`(`user_id`, `message`)
      VALUES (:userid, :message)
SQL;

    $result = $this->dbConnection->prepare($query);
    $result->bindValue(':userid', $cUserId, PDO::PARAM_INT);
    $result->bindValue(':message', $message, PDO::PARAM_STR);
    $result->execute(); 


    if ($result->rowCount() == 1) {
      $addResult = $this->dbConnection->lastInsertId();
    } else {
      echo $this->dbConnection->error;
    }
    
    return $addResult;
  }


}
