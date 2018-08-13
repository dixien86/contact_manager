<?php
//namespace repository;
require_once '../models/Db.php';

interface ContactsRepositoryInterface
{
    public function create(Contact $contact);
    public function update($params);
    public function delete($id);
    public function selectAll();
    public function selectOne($id);
}

class ContactsRepository implements ContactsRepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function create(Contact $contact)
    {
        $sql =<<<SQL
            INSERT INTO `contacts` (`first_name`, `last_name`, `mobile_number`, `email_address`) 
            VALUES (:first_name, :last_name, :mobile_number, :email_address)
SQL;
        $statement = $this->db->connect()->prepare($sql);
        $statement->bindParam(":first_name", $contact->get_first_name(), PDO::PARAM_STR);
        $statement->bindParam(":last_name", $contact->get_last_name(), PDO::PARAM_STR);
        $statement->bindParam(":mobile_number", $contact->get_mobile_number(), PDO::PARAM_STR);
        $statement->bindParam(":email_address", $contact->get_email_address(), PDO::PARAM_STR);

        try {
            $statement->execute();            
        }catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
    
    public function update($params)
    {
        $sql =<<<SQL
            UPDATE `contacts`
            SET 
                `first_name` = :first_name,
                `last_name` = :last_name,
                `mobile_number` = :mobile_number,
                `email_address` = :email_address
            WHERE id = :id
SQL;
        $statement = $this->db->connect()->prepare($sql);
        $statement->bindParam(":first_name", $params['first_name'], PDO::PARAM_STR);
        $statement->bindParam(":last_name", $params['last_name'], PDO::PARAM_STR);
        $statement->bindParam(":mobile_number", $params['mobile_number'], PDO::PARAM_STR);
        $statement->bindParam(":email_address", $params['email_address'], PDO::PARAM_STR);
        $statement->bindParam(":id", $params['id'], PDO::PARAM_INT);

        try {
            $statement->execute();            
        }catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
    
    public function delete($id)
    {
        $success = false;
        $sql =<<<SQL
            DELETE 
            FROM
                `contacts` 
            WHERE 
                id = :id     
SQL;
        $statement = $this->db->connect()->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        try {
            $statement->execute();
            $success = true;            
        }catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
        
        return $success;
    }
    
    public function selectAll(){
        
        $sql =<<<SQL
            SELECT 
                `id`, `first_name`, `last_name`, `mobile_number`, `email_address` 
            FROM 
                `contacts`
SQL;
        $statement = $this->db->connect()->prepare($sql);
       
        try {
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC); 
            (empty($rows)) ? $results = [] : $results = $rows;
            return  $results;
        }catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
        }  
    }
    
    public function selectOne($id){
        $sql =<<<SQL
            SELECT 
                `id`, `first_name`, `last_name`, `mobile_number`, `email_address` 
            FROM 
                `contacts`
            WHERE `id` = :id
SQL;
        $statement = $this->db->connect()->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);  
            (empty($row)) ? $result = [] : $result = $row;
            return  $result;
        }catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
        }  
    }
}

?>

