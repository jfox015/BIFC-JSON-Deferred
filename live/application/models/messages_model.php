<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_Model extends CI_Model {

    protected $table = "messages";
    protected $error = "";

	public function find_by($field = false, $value = false) {
		
		if ($field === false || $value === false) { 
			$this->error = "Missing parameters";
			return false;
		}
		$message_list = array();
		$this->db->select()
				 ->from($this->table)
				 ->where($field,$value)
				 ->order_by('date','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				array_push($message_list, array('message_id'=>intval($row->id),'employee_id'=>intval($row->employee_id),
											'date'=>date('m/d/Y',strtotime($row->date)),'from'=>$row->from,'subject'=>$row->subject,'message'=>$row->message));
			}
		}
		$query->free_result();
		return $message_list;
	}
}
