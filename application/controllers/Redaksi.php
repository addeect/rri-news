<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Redaksi extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper(array('form','url'));
		$this->load->model('m_main');
		//$this->load->model('m_master');
		//$this->load->library('session');
	}
	public function index($page_name = 'home')
	{
				//$page_en = 'en/'.$page;
		$title= str_replace("-"," ",$page_name);
		$data=array(
			'berita' => $this->m_main->getData1(),
			'berita_approved' => $this->m_main->getData1_approved(),
			'jml_berita' => $this->m_main->getData1_numrow(),
			'jml_berita_baru' => $this->m_main->getData1_baru_numrow(),
			'jml_berita_telah_direvisi' => $this->m_main->getData1_baru_numrow_telah_direvisi(),
			'jml_berita_revisi' => $this->m_main->getData1_revisi_numrow(),
			'jml_berita_approved' => $this->m_main->getData1_approved_numrow(),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name,$data);
		$this->load->view('default/footer',$data);
	}
	public function searchApproved($page_name = 'searchApproved'){
		$title= str_replace("-"," ",$page_name);
		$data=array(
			'berita' => $this->m_main->getSearchApproved(),
			'berita_approved' => $this->m_main->getData1_approved(),
			'jml_berita' => $this->m_main->getData1_numrow(),
			'jml_berita_baru' => $this->m_main->getData1_baru_numrow(),
			'jml_berita_revisi' => $this->m_main->getData1_revisi_numrow(),
			'jml_berita_approved' => $this->m_main->getData1_approved_numrow(),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name,$data);
		$this->load->view('default/footer',$data);
	}
	public function search($page_name = 'search'){
		$title= str_replace("-"," ",$page_name);
		$data=array(
			'berita' => $this->m_main->getSearch(),
			'berita_approved' => $this->m_main->getData1_approved(),
			'jml_berita' => $this->m_main->getData1_numrow(),
			'jml_berita_baru' => $this->m_main->getData1_baru_numrow(),
			'jml_berita_revisi' => $this->m_main->getData1_revisi_numrow(),
			'jml_berita_approved' => $this->m_main->getData1_approved_numrow(),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name,$data);
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
		$this->load->view('pages/'.$page_name,$data);
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
		$this->load->view('pages/'.$page_name,$data);
		$this->load->view('default/footer',$data);
	}
	function koreksi(){
		
		$this->load->model('m_update');
        $this->m_update->koreksi_berita();
        redirect('redaksi/daftar-berita');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
	function approve_berita(){
		
		$this->load->model('m_update');
        $this->m_update->approve_berita();
        redirect('redaksi/daftar-berita');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
	function approve_berita_with_hotnews(){
		
		$this->load->model('m_update');
        $this->m_update->approve_berita_with_hotnews();
        redirect('redaksi/daftar-berita');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
}
