<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('employees_model');
    }

	public function index()
	{
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $json_out['result']['items'] = $this->employees_model->find_all();

        if (!empty($this->employees_model->error))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".$this->employees_model->error;
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }

    public function save()
    {
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        if ($this->input->post('items'))
        {
            $items = json_decode($this->input->post('items'));
            $data = array('name'		=> $items->name,
                'hire_date'	 		    => (isset($items->hire_date) ? $items->hire_date : date('m/d/Y')),
                'location'	 	        => $items->location,
                'emp_type_id'           => $items->emp_type_id,
            );
			$type = isset($items->type) ? $items->type : "add";
			$employee_id = isset($items->employee_id) ? intval($items->employee_id) : -1;
            $this->employees_model->save($type, $data, $employee_id);
        }
        else
        {
         $error = true;
            $status = "Employee Data was missing.";
        }
        if (!empty($this->employees_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->employees_model->error) ? $this->employees_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }

    public function delete()
    {
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        $employee_id = $this->uri->segment(3);
		
		if (isset($employee_id) && !empty($employee_id))
        {
            $this->employees_model->delete($employee_id);
        }
        else
        {
            $status = "Employee ID was missing. Could not delete employee.";
        }
        if (!empty($this->employees_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->employees_model->error) ? $this->employees_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }

    public function add_note()
    {
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        if ($this->input->post('items'))
        {
            $items = json_decode($this->input->post('items'));
                $data = array('content'		    => $items->content,
                              'employee_id'		=> $items->employee_id
            );
            $json_out['result']['items'] = $this->employees_model->add_note($data);
        }
        else
        {
            $error = true;
            $status = "Note Data was missing.";
        }
        if (!empty($this->employees_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->employees_model->error) ? $this->employees_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
    public function add_review()
    {
        $error = false;
        $json_out = array("result"=>array(),"code"=>200,"status"=>"OK");

        if ($this->input->post('items'))
        {
            $items = json_decode($this->input->post('items'));
                $data = array('reviewed_by'		    => $items->content,
                              'status'				=> $items->status,
                              'employee_id'			=> $items->employee_id
            );
            $json_out['result']['items'] = $this->employees_model->add_review($data);
        }
        else
        {
            $error = true;
            $status = "Employee review data was missing.";
        }
        if (!empty($this->employees_model->error) || isset($status))
        {
            $json_out['code'] = 301;
            $json_out['status'] = "error:".(!empty($this->employees_model->error) ? $this->employees_model->error : $status);
            $json_out['result'] = 'An error occurred.';
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($json_out));
    }
}
/* End of file employees.php */
/* Location: ./application/controllers/employees.php */