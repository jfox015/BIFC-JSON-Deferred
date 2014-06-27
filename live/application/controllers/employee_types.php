<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_types extends CI_Controller {


    public function __construct() {
		parent::__construct();
		$this->load->model('employee_types_model');
    }

	public function index()
	{
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $json_out['result']['items'] = $this->employee_types_model->find_all();

        if (!empty($this->employee_types_model->error))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->employee_types_model->error) ? $this->employee_types_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
}
/* End of file employee_types.php */
/* Location: ./application/controllers/employee_types.php */
