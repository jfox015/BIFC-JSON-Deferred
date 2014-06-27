<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations_Model extends CI_Model {

    protected $table = "locations";
    protected $error = "";

	public function find_all($limit = false, $index = false) {
		
		$location_list = array();
		$this->db->select()
				 ->from($this->table)
				 ->order_by('city_name','asc');
		if ($limit !== false && $index === false) { 
			$this->db->limit($limit); 
		} else if ($limit !== false && $index !== false) { 
			$this->db->limit($index, $limit); 
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				array_push($location_list, array('location_id'=>$row->id,'city_code'=>$row->city_code,
											'city_name'=>$row->city_name));
			}
		}
		$query->free_result();
		return $location_list;
	}
}
