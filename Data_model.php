<?php
class Data_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->database();		
	}

    public function ajax_data_list($iDisplayStart, $iDisplayLength, $sorting, $sSearch, $sEcho, $bSearchable, $custom_search = array())
	{
        // pagination......................
		$this->db->select('count(multi_insert.id) as total');
		$this->db->from('multi_insert');
		$query = $this->db->get();
		$result = $query->row();

		$iTotalRecords = $result->total;

        // pagination......................
        $this->db->select('count(multi_insert.id) as total');
        $this->db->from('multi_insert');		

		if ($sSearch) {
			$this->db->group_start();
			$this->db->like('multi_insert.id', $sSearch);
			$this->db->or_like('multi_insert.name', $sSearch);
			$this->db->group_end();
		}
		$query = $this->db->get();
		$result = $query->row();

		$iTotalDisplayRecords = $result->total;

        // display data.....................................
		$this->db->select('*');
        $this->db->from('multi_insert');

		if ($sSearch) {
			$this->db->group_start();
            $this->db->like('multi_insert.id', $sSearch);
			$this->db->or_like('multi_insert.name', $sSearch);
			$this->db->group_end();
		}

		foreach ($sorting as $key => $sort) {
			if ($key == 1) {
				$this->db->order_by('multi_insert.id',	$sort);
			} else {
				$this->db->order_by('multi_insert.id', 'DESC');
			}
		}
		$this->db->order_by('multi_insert.id', 'desc');

		$this->db->limit($iDisplayLength, $iDisplayStart);
		$query = $this->db->get();

		$result = $query->result();
        // print_r($result); die();

		$aaData	=	array();

		$key = $iDisplayStart;
		foreach ($result as $key => $row) {	
            $check_box = '<input type="checkbox" name="checkbox[]" value="' . $row->id . '" />';

			$edit = '<a href="' . base_url() . 'user/edit/' . $row->id . '" class="btn btn-sm btn-primary text-white" title="Edit User">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>';
			$delete = ' <a  href="' . base_url() . 'data/multi_data_delete/' . $row->id . '" onclick="return confirm(\'Do you really want to delete this User?\')" class="btn btn-sm btn-danger text-white" title="Delete User">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>';
			// $information = '<a href="' . base_url() . 'user/details/' . $row->id . '" class="btn btn-sm btn-primary text-white" title="User Info">Info <i class="fa fa-info" aria-hidden="true"></i></a>';
		    $information = '<a class="btn btn-sm btn-primary text-white info_button" data-id = "'. $row->id .'" title="User Info">Info <i class="fa fa-info" aria-hidden="true"></i></a>';
		
			$map = ' <a href="' . base_url() . 'user/user_assign_course/' . $row->id . '" class="btn btn-sm btn-info text-white" title=" Exam Map">Assign <i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
			$reset = ' <a href="' . base_url() . 'user/user_reset_password/' . $row->id . '"  onclick="return confirm(\'Are You Sure to Reset this User?\')" class="btn btn-sm btn-primary text-white" title=" Reset User">Reset <i class="fa fa-exchange" aria-hidden="true"></i></a>';
			$aaData[]	=	array(
                "$check_box " . $key + 1 . "  #("."$row->id)",
				// $row->id,
				$row->name,
				$row->email,
				$row->phone,				
				$edit . '' . $delete . ' ' . $information . '' . $map . '' . $reset,

			);
		}

		$output	= array(
			"sEcho"		=> 	$sEcho,
			"iTotalRecords"	=>	$iTotalRecords,
			"iTotalDisplayRecords" 	=>	$iTotalDisplayRecords,
			"aaData"	=>	$aaData
		);

		return	$output;
	}

    public function multi_add_user($arr){
        $this->db->insert('multi_insert',$arr);    
	}

    public function multi_data_delete($checkbox_id){
        $this->db->where_in('id',$checkbox_id);
        $this->db->delete('multi_insert');    
	}

}
?>