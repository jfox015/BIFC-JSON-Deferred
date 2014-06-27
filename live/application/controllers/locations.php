<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends CI_Controller {


    public function __construct() {
		parent::__construct();
		$this->load->model('locations_model');
    }

	public function index()
	{
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $json_out['result']['items'] = $this->locations_model->find_all();

        if (!empty($this->locations_model->error))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->locations_model->error) ? $this->locations_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
}
/* End of file locations.php */
/* Location: ./application/controllers/locations.php */
