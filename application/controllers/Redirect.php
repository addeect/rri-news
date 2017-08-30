<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Redirect extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('m_main');
		//$this->load->model('m_master');
		//$this->load->library('session');
	}

	public function index()
	{
				//$page_en = 'en/'.$page;
		
			$user_id = $this->input->post('username');
			$pass = $this->input->post('password');
			$cek=$this->m_main->doLogin($user_id,$pass);
			$user_info=$this->m_main->getUserInfo($user_id);
			//echo $cek['records'][0]['fullname'];
			//$role = $cek['records'][3]['JABATAN'];
			$data=array(
			'user_id'=>$this->input->post('username'),
			'role'=> $cek,
			'nama_user'=> $user_info
			);
				if($cek == 'Editor'){
					$x=$this->session->set_userdata($data);			
					redirect('redaksi/home',$x);
				}
				elseif($cek == 'Reporter'){
					$x=$this->session->set_userdata($data);			
					redirect('reporter/naskah',$x);
				}
				elseif($cek == 'Redaksi'){
					$x=$this->session->set_userdata($data);			
					redirect('redaksi/home',$x);
				}
				elseif($cek == 'Kabid'){
					$x=$this->session->set_userdata($data);			
					redirect('kabid/evaluasi',$x);
				}
				else{
					redirect('login');
					
					//echo "login gagal";
				}

		// $this->load->view('default/header_login');
		// $this->load->view('default/menu', $data);
		// $this->load->view('pages/login');
		// $this->load->view('default/footer');
	}

}
