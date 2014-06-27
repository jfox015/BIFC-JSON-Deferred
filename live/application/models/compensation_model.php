<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compensation_Model extends CI_Model {

    
	protected $table = "compensation";
	protected $table_employees = "employees";
	protected $table_employee_types = "employee_types";
    protected $error = "";

	public function employee_compensation_model($employee_id = false) {
		
		if ($employee_id === false) { 
			$this->error = "Missing Employee id.";
			return false;
		}
		$comp_arr = array();
		$type_arr = array();
		$comp = array();
		
		$this->db->select();
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				array_push($comp_arr, array('level_id'=>$row->level,'comp'=>array('base'=>$row->base,'bonus'=>$row->bonus,'vacation'=>$row->vacation)));
			}
		}
        $query->free_result();
		
		$this->db->select();
		$query = $this->db->get($this->table_employee_types);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$type_arr = $type_arr + array('type_id'=>$row->type_id, array('level'=>intval($row->level)));
			}
		}
        $query->free_result();
		
		$this->db->select("level");
		$this->db->where('employee_id',$employee_id);
		$query = $this->db->get($this->table_employees);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$emp_lvl = $type_arr[$row->emp_type_id]->level;
				array_push($comp, array('employee_id'=>$row->employee_id,'salary'=>$comp_arr[$emp_lvl]->base + $comp_arr[$emp_lvl]->vacation,'bonus'=>$comp_arr[$emp_lvl]->bonus));
			}
		}
        $query->free_result();
        return $comp;
    }
}
/* End of file employees_compensation_model.php */
/* Location: ./application/models/employees_compensation_model.php */