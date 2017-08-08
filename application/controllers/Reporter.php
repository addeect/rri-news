<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reporter extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper(array('form','url'));
		$this->load->model('m_main');
		//$this->load->model('m_master');
		//$this->load->library('session');
	}
	public function index($page_name = 'naskah')
	{
				//$page_en = 'en/'.$page;
		$user_id = $this->session->userdata('user_id');
		$title= str_replace("-"," ",$page_name);
		$data=array(
			'berita' => $this->m_main->getData3($user_id),
			'jml_berita_telah_dicek' => $this->m_main->getData1_baru_numrow_telah_dicek($user_id),
			'kinerja_reporter' => $this->m_main->getReportEmployee($user_id),
			'kategori' => $this->m_main->getData4(),
			'reward' => $this->m_main->getData5(),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name.'_reporter',$data);
		$this->load->view('default/footer',$data);
	}
	public function editor($id_berita)
	{
				//$page_en = 'en/'.$page;
		$title= 'Editor';
		$page_name = 'editor';
		$data=array(
			'berita' => $this->m_main->getData2($id_berita),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name.'_reporter',$data);
		$this->load->view('default/footer',$data);
	}
	public function viewer($id_berita)
	{
				//$page_en = 'en/'.$page;
		$title= 'Viewer';
		$page_name = 'viewer';
		$data=array(
			'berita' => $this->m_main->getData2($id_berita),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name.'_reporter',$data);
		$this->load->view('default/footer',$data);
	}
	function koreksi_sebelum_redaksi(){
		
		$this->load->model('m_update');
        $this->m_update->reporter_perbarui_berita();
        redirect('reporter/naskah');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
	function koreksi(){
		
		$this->load->model('m_update');
        $this->m_update->reporter_koreksi_berita();
        redirect('reporter/naskah');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
	function saveNew(){
		$this->load->model('m_insert');
    	$this->m_insert->simpan_berita_tanpa_rekaman();

        //$data = array('upload_data' => $this->upload->data());
    	redirect('reporter/naskah');
	}
	function doUpload(){
		$name = $_FILES["file"]["name"];
	    $ext = end((explode(".", $name))); # extra () to prevent notice

	    $config['upload_path']   = './uploads/';
	    $config['allowed_types'] = 'mp3|wav';
	    $config['max_size']      = 0;

	    $this->load->library('upload', $config);

	    if( ! $this->upload->do_Upload('file')){
	        $error = array('error' => $this->upload->display_errors());

	        $this->load->view('upload_form',$error);
	    }
	    else{
	        $upload_data = $this->upload->data();

	        #you can choose from
	        /*
	           Array(
	                 [file_name]    => mypic.jpg
	                 [file_type]    => image/jpeg
	                 [file_path]    => /path/to/your/upload/
	                 [full_path]    => /path/to/your/upload/jpg.jpg
	                 [raw_name]     => mypic
	                 [orig_name]    => mypic.jpg
	                 [client_name]  => mypic.jpg
	                 [file_ext]     => .jpg
	                 [file_size]    => 22.2
	                 [is_image]     => 1
	                 [image_width]  => 800
	                 [image_height] => 600
	                 [image_type]   => jpeg
	                 [image_size_str] => width="800" height="200"
	          )
	        */

	        //$this->model->insert_data($upoad_data['file_name'], $upoad_data['full_path']);
			$this->load->model('m_insert');
        	$this->m_insert->simpan_berita($name);

	        //$data = array('upload_data' => $this->upload->data());
        	redirect('reporter/naskah');
	        //$this->load->view('upload_success');
	    }
		
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
	/*public function editor($id_berita)
	{
				//$page_en = 'en/'.$page;
		$title= 'Editor';
		$page_name = 'editor';
		$data=array(
			'berita' => $this->m_main->getData2($id_berita),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name,$data);
		$this->load->view('default/footer',$data);
	}*/
}
