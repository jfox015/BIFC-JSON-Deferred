<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees_Model extends CI_Model {

    protected $table = "employees";
    protected $table_notes = "notes";
    protected $table_reviews = "reviews";
    protected $error = "";

	public function find_all($limit = false, $index = false) {
		
		$emp_list = array();
		$this->db->select()
				 ->from($this->table)
				 ->order_by('name','asc');
		if ($limit !== false && $index === false) { 
			$this->db->limit($limit); 
		} else if ($limit !== false && $index !== false) { 
			$this->db->limit($index, $limit); 
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$emp = array('employee_id'=>intval($row->employee_id),'name'=>$row->name,
											'hire_date'=>$row->hire_date,'location'=>intval($row->location),'emp_type_id'=>intval($row-emp_type_id));
				$emp_id = intval($row->employee_id);
				
				// Sub queries
                // NOTES
				$notes = $this->find_all_notes($emp_id);
				if (sizeof($notes) > 0) $emp = $emp + array('notes'=>$notes);
				// REVIEWS
				$reviews = $this->find_all_reviews($emp_id);
                if (sizeof($reviews) > 0) $emp = $emp + array('reviews'=>$reviews);

                array_push($emp_list, $emp);
			}
		}
		$query->free_result();
		return $emp_list;
	}
	
    public function save($type = "add", $data = false, $employee_id = false) {
        if ($data === false) {
            $this->error = "No employee data was received.";
			return false;
		}
        if ($type == "add") {
            // Add
            return $this->db->insert($this->table,$data);
        } else {
            if ($employee_id === false) {
                $this->error = "No employee id was received.";
				return false;
			}
			// EDIT
            $this->db->where('employee_id',$employee_id);
            return $this->db->update($this->table,$data);
        }
    }

    public function delete($employee_id = false) {
        if ($employee_id === false) {
			$this->error = "No employee id was received.";
			return false;
		}
		$this->db->where('employee_id',$employee_id);
        return $this->db->delete($this->table_notes);
		
		$this->db->where('employee_id',$employee_id);
        return $this->db->delete($this->table_reviews);
		
        $this->db->where('employee_id',$employee_id);
        return $this->db->delete($this->table);
    }

    public function add_note($data = false) {
        if ($data === false) {
            $this->error = "No employee data was received.";
            return false;
        }
        $this->db->insert($this->table_notes,$data);
        $id = $this->db->insert_id();
        if (!isset($id)) {
            $this->error = "An error occurred inserting the record.";
            return false;
        } else {
            return $this->find_all_notes($data['employee_id']);
        }
    }
    public function find_all_notes($employee_id = false) {
        if ($employee_id === false) {
            $this->error = "No employee data was received.";
            return false;
        }
        $notes = array();
        $this->db->select('date,content')
            ->from($this->table_notes)
            ->where('employee_id',$employee_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($notes, array('date'=>date('m/d/Y',strtotime($row->date)),'content'=>$row->content));
            }
        }
        $query->free_result();
        return $notes;
    }
    public function add_review($data = false) {
        if ($data === false) {
            $this->error = "No employee data was received.";
            return false;
        }
        $this->db->insert($this->table_reviews,$data);
        $id = $this->db->insert_id();
        if (!isset($id)) {
            $this->error = "An error occurred inserting the record.";
            return false;
        } else {
            return $this->find_all_reviews($data['employee_id']);
        }
    }
    public function find_all_reviews($employee_id = false) {
        if ($employee_id === false) {
            $this->error = "No employee data was received.";
            return false;
        }
        $reviews = array();
		$this->db->select('date, reviewed_by, status')
			->from($this->table_reviews)
			->where('employee_id',$employee_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				array_push($reviews, array('date'=>date('m/d/Y',strtotime($row->date)),'reviewed_by'=>$row->reviewed_by,'status'=>$row->status));
			}
		}
        $query->free_result();
        return $reviews;
    }
}
