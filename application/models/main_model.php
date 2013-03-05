<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {
	
	public function __construct(){
		 parent::__construct();
	}
	
	public function record_count() {
        return $this->db->count_all('dhamma_remind');
    }


	public function getRemind( $id = '', $limit = 20, $start = 0){
		if( $id ){
			return $this->db->order_by('id', 'desc')->get_where('dhamma_remind', array('id' => $id))->row();
		}else{
			return $this->db->limit($limit, $start)->order_by('id', 'desc')->get('dhamma_remind');
		}
	}
	
	public function saveRemind( $data = array() ){
		if( $data ){
			return $this->db->insert('dhamma_remind', $data);
		}else{
			return false;
		}
	}
	
	public function updateRemind( $data = array(), $id = '' ){
		if( $data && $id ){
			return $this->db->update('dhamma_remind', $data, array('id' => $id));
		}else{
			return false;
		}
	}
	
	public function deleteRemind( $id = '' ){
		if( $id ){
			return $this->db->delete('dhamma_remind', array('id' => $id));
		}else{
			return false;
		}
	}
}

/* End of file main_model.php */
/* Location: ./application/models/main_model.php */