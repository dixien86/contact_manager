<?php
//namespace contact;

class Contact
{

    private $first_name;
    private $last_name;
    private $mobile_number;
    private $email_address;

    public function __construct($firstname,$lastname,$mobile,$email)
    {
        $this->first_name = $firstname;
        $this->last_name = $lastname;
        $this->mobile_number = $mobile;
        $this->email_address = $email;
    }

    public function get_first_name()
    {
        return $this->first_name;
    }

    public function set_first_name($f_name)
    {
        $this->fisrt_name = $f_name;
    }
    
    public function get_last_name()
    {
        return $this->last_name;
    }

    public function set_last_name($l_name)
    {
        $this->last_name = $l_name;
    }
    
    public function get_mobile_number()
    {
        return $this->mobile_number;
    }

    public function set_mobile_number($m_number)
    {
        $this->mobile_number = $m_number;
    }

    public function get_email_address()
    {
        return $this->email_address;
    }

    public function set_email_address($email)
    {
        $this->email_address = $email;
    }
}

?>

