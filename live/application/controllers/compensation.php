<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compensation extends CI_Controller {

    public function __construct() {
		parent::__construct();
		 $this->load->model('compensation_model');
    }
	
	public function calccompensation()
	{
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $employee_id = $this->uri->segment(3);
		
		if (isset($employee_id) && !empty($employee_id))
        {
            $json_out['result']['items'] = $this->compensation_model->calc_compensation($employee_id);
        }
        else
        {
			$error = true;
            $status = "Required employee ID was missing.";
        }
        if (!empty($this->compensation_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->compensation_model->error) ? $this->compensation_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
}
/* End of file compensation.php */
/* Location: ./application/controllers/compensation.php */