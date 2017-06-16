<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Register extends CI_Controller {

	public function index()
	{
				//$page_en = 'en/'.$page;
		$this->load->view('default/header');
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/register');
		$this->load->view('default/footer');
	}
	public function complete()
	{
				//$page_en = 'en/'.$page;
		$this->load->view('default/header');
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/complete');
		$this->load->view('default/footer');
	}
	function doRegister(){
		$this->load->model('m_insert');
    	$this->m_insert->simpan_pengguna();
        //$data = array('upload_data' => $this->upload->data());
    	redirect('register/complete');
	}

}
