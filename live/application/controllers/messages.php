<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

    public function __construct() {
		parent::__construct();
		 $this->load->model('messages_model');
    }
	
	public function loadmessages()
	{
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $employee_id = $this->uri->segment(3);
		
		if (isset($employee_id) && !empty($employee_id))
        {
            $items = json_decode($this->input->post('items'));
            $json_out['result']['items'] = $this->messages_model->find_by('employee_id',$employee_id);
        }
        else
        {
			$error = true;
            $status = "Required employee ID was missing.";
        }
        if (!empty($this->messages_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->messages_model->error) ? $this->messages_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
}
/* End of file messages.php */
/* Location: ./application/controllers/messages.php */