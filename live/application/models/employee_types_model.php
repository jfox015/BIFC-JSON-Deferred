<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_Types_Model extends CI_Model {

    protected $table = "employee_types";
    protected $error = "";

	public function find_all($limit = false, $index = false) {
		
		$type_list = array();
		$this->db->select()
				 ->from($this->table)
				 ->order_by('level_id','asc');
		if ($limit !== false && $index === false) { 
			$this->db->limit($limit); 
		} else if ($limit !== false && $index !== false) { 
			$this->db->limit($index, $limit); 
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				array_push($type_list, array('type_id'=>$row->type_id,'type_code'=>$row->type_code,
											'type_name'=>$row->type_name, 'level_id'=>$row->level_id));
			}
		}
		$query->free_result();
		return $type_list;
	}
}
