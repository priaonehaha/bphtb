<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ts100_model extends CI_Model {
	private $tbl = 'ts100';
	
	function __construct() {
		parent::__construct();
	}
	
    function grid() 
    {
        $sql = "SELECT ts.*, a.id agent_id, op.nama op_nama, wp.nama wp_nama, wp.npwp wp_npwp
            FROM ts100 ts
            INNER JOIN agent a ON a.id=ts.agent_id
            INNER JOIN objek_pajak op ON op.id=ts.op_id
            INNER JOIN wajib_pajak wp ON wp.id=op.wp_id";
            
		$query = $this->db->query($sql);
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
    }
    
	function get_all()
	{
		$this->db->order_by('agent_id'); 
		$query = $this->db->get($this->tbl);
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
		
	function get($arr_id)
	{
		$this->db->where($arr_id);
		$query = $this->db->get($this->tbl);
		if($query->num_rows()!==0)
		{
			return $query->row();
		}
		else
			return FALSE;
	}
	
	//-- admin
	function save($data) {
		$this->db->insert($this->tbl,$data);
		// return $this->db->insert_id();
	}
	
	function update($arr_id, $data) {
		$this->db->where($arr_id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($arr_id) {
		$this->db->where($arr_id);
		$this->db->delete($this->tbl);
	}
}

/* End of file _model.php */