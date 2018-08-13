<?php

require_once '../models/ContactRepository.php';
require_once '../models/Contact.php';

class ContactsController
{
    private $repository;

    public function __construct(ContactsRepositoryInterface $repository, $action ='')
    {
        $this->repository = $repository;
        
        switch($action){
            case 'create_contact':
                $this->create_contact($_POST);
                break;
            case 'update_contact':
                $this->update_contact($_POST);
                break;
            case 'delete_contact':
                $this->delete_contact($_POST['id']);
                break;
            case 'select_all_contacts':
                $this->select_all_contacts();
                break;
            case 'select_one':
                $this->select_one($_POST['id']);
                break;
            default:
                break;
        }
    }

    public function create_contact($params)
    {
        if (isset($params)) {
            $contact = new Contact($params['first_name'], $params['last_name'], $params['mobile_number'], $params['email_address']);
            $this->repository->create($contact);
        }
        $this->select_all_contacts();
    }
    
    public function update_contact($params)
    {
        $this->repository->update($params);
        $this->select_all_contacts();
    }
    
    public function delete_contact($id)
    {
       $this->repository->delete($id);
       $this->select_all_contacts();
    }
    
    public function select_all_contacts()
    {
        $contacts_array = $this->repository->selectAll();
        echo json_encode($contacts_array); 
    }
    
    public function select_one($id) {
        $contact_row = $this->repository->selectOne($id);
        echo json_encode($contact_row); 
    }
    
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$repository = new ContactsRepository();
$contact_obj = new ContactsController($repository, $action);

