<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller 
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('input');
        $this->load->model('cron_model');
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function updateAge()
    {            
        // is_cli_request() is provided by default input library of codeigniter
        if($this->input->is_cli_request())
        {            
            $this->cron_model->updateAge();
        }
        else
        {
            echo "You dont have access";
        }
    }
}
?>