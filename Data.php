<?php
class Data extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Data_model');
	}

    public function  index(){  
		$this->load->view('data/data_list');
	}

	function ajax_data_list(){		
		
		$sEcho				=	$this->input->post('sEcho');
		$iDisplayStart		=	$this->input->post('iDisplayStart');
		$iDisplayLength		=	$this->input->post('iDisplayLength');
		$sSearch			=	$this->input->post('sSearch');
	    $iSortingCols		=	$this->input->post('iSortingCols');
		$aColumns			=	$this->input->post('iSortingCols');
		$this->session->set_userdata("iDisplayLength", $iDisplayLength);
		$bSearchable		=	array();

		for( $i=0 ; true ; $i++ ){	
			$temp =	$this->input->post('bSearchable_'.$i);
			if($temp=='')
				break;
			$bSearchable[$i]	=	$this->input->post('bSearchable_'.$i);	
		}

		$sorting	=	array();		
		for($i=0 ; $i<$iSortingCols;$i++){

			$iSortCol =	$this->input->post('iSortCol_'.$i);

			$sSortDir =	$this->input->post('sSortDir_'.$i);

			$sorting[$iSortCol]	=	$sSortDir;
		}
		
		$output		=	$this->Data_model->ajax_data_list($iDisplayStart,$iDisplayLength,$sorting,$sSearch,$sEcho,$bSearchable, $this->session->userdata("courseSearch"));
		$output		=	json_encode($output);
		echo $output;

	}

	public function  multi_add_user(){ 
		
		// $insert_arr = [];
		if($this->input->post()){
			$data = $this->input->post();	
			if(!empty($data['name'])){
				$i=0;	
				foreach($data['name'] as $key => $single){				
					$arr = [
						// 'name'  =>  $data['name'][$key],
						'name'  =>  $single,
						'email' =>  $data['email'][$key],
						'phone' =>  $data['phone'][$key],
					];
					$this->Data_model->multi_add_user($arr);				
				}
				$this->session->set_flashdata('message','user successfully inserted');	
				redirect(base_url().'data');
			}else{
				$this->session->set_flashdata('message','Something is error');			
				redirect(base_url().'data');
			}
		}else{
			$this->load->view('data/user_insert');
		}		

	}

	public function multi_data_delete(){
		
		if($this->input->post()){
			$data = $this->input->post();			
			if($data['checkbox']){
				$checkbox_id = [];
				foreach($data['checkbox'] as $key => $select){					
					// echo $select;"<br>";
					array_push($checkbox_id,$select);
					
				}
				// print_r($checkbox_id); die;
				$this->Data_model->multi_data_delete($checkbox_id);	
				$this->session->set_flashdata('message','user deleted successfully');
				redirect(base_url().'data');	
			}		
		}else{
			$this->session->set_flashdata('msg','Something is error');			
			redirect(base_url().'data');
		}
	}

}
?>