<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Main extends CI_Controller {

	public function en($page = 'home')
	{
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$controller_name = $this->uri->rsegments[1];
		$method_name = $this->uri->rsegments[2];
		//$data['title'] = ucfirst($page); // Capitalize the first letter
		$data=array(
			'title' => ucfirst($page),
			'page' => $page,
			'lng' => $method_name,
			'info' => $controller_name,
			'method' => $method_name
		);
		//$page_en = 'en/'.$page;
		$this->load->view('default/header', $data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('default/sitemap', $data);
		$this->load->view('default/footer', $data);
	}

}
