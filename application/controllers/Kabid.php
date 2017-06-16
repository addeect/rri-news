<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Kabid extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper(array('form','url'));
		$this->load->model('m_main');
		//$this->load->model('m_master');
		//$this->load->library('session');
	}
	// -- TOP FUNCTION --
	public function index($page_name = 'home')
	{
				//$page_en = 'en/'.$page;
		$title= str_replace("-"," ",$page_name);
		$data=array(
			'reward' => $this->m_main->getData6(),
			'evaluasi' => $this->m_main->getDataEvaluasi1(),
			'pegawai' => $this->m_main->getDataPegawai(),
			'kategori' => $this->m_main->getDataKategori(),
			'kategori_aktif' => $this->m_main->getDataKategoriAktif(),
			'hasil_reward' => $this->m_main->getDataEvaluasi2(),
			'title' => ucwords($title),
			'page_name' => $page_name
		);

		$this->load->view('default/header',$data);
		//$this->load->view('default/menu', $data);
		$this->load->view('pages/'.$page_name.'_kabid',$data);
		$this->load->view('default/footer',$data);
	}
	// -- TOP FUNCTION --
	function dashboard1(){
		//$dataLaporan = $this->m_main->getReportMonth();
		$data = array('dataLaporan' => $this->m_main->getReportMonth() );
		$this->load->view('ajax/dashboard1',$data);
	}
	function cetakLaporanTahunan(){
		$this->load->library('Pdf');
		$tahun = $this->input->get('tahun');
		$dataLaporan = $this->m_main->getReportYear();

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('AddeectCodeWorks');
		$pdf->SetTitle('Laporan Tahunan');
		$pdf->SetSubject('RRI');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Laporan Tahunan', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, '43', PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin('50');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		$pdf->AddPage();
		
		$html = '<span style="font-weight: bold;">EVALUASI PRESTASI KERJA REPORTER</span><br/><br/>';
		/*$query1 = "SELECT NAMA_LOKASI, WITEL FROM master_access_point WHERE ID_LOKASI='".$id_lokasi."'";
		$result1 = mysql_query($query1);
		while($row1 = mysql_fetch_array($result1)){
		    $nama_lokasi = $row1[0];
		    $witel = $row1[1];
		    $html .= '<span style="font-weight: normal;">ID Lokasi : '.$id_lokasi.' </span><br/>';
		    $html .= '<span style="font-weight: normal;">Nama Lokasi : '.$nama_lokasi.' </span><br/>';
		    $html .= '<span style="font-weight: normal;">Witel : '.$witel.' </span><br/><br/>';
		}*/

		$html .='<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
		<tr style="background-color:#f0f8ff"><td width="30px">No.</td><td width="286px">Nama Reporter</td><td>Jumlah Berita</td><td>Jumlah Point Reward</td></tr>';
		$start = 1;
		foreach ($dataLaporan as $row)
		{
				$html .= "<tr>";
		        $html .= "<td>".$start++."</td>";
		        $html .= "<td style=\"text-align:left\">&nbsp;$row->NAMA_USER</td>";
		        $html .= "<td>$row->jumlah_berita</td>";
		        $html .= "<td>$row->jumlah_reward</td>";
		        $html .= "</tr>";
		}

		$html .= '</table><br/>';
		//$html .= '<br/><span style="font-weight: bold;">REKOMENDASI</span><br/>';
		$html .= '<br/>';
		$html .= '<span style="font-weight: normal;">Nama - nama reporter yang tercantum di atas adalah reporter yang memiliki jumlah reward tertinggi di tahun '.$tahun.'.</span><br/>';
		

		$html .= '</span><br/>';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->lastPage();
		//$pdf->Write(5, 'Some sample text');
		$pdf->Output('Laporan-Tahunan.pdf', 'I');
	}
	function hapusKategori(){
		$this->load->model('m_update');
		$this->m_update->hapus_kategori();
		redirect('kabid/master-kategori');
	}
	function editKategori(){
		$this->load->model('m_update');
		$this->m_update->edit_kategori();
		redirect('kabid/master-kategori');
	}
	function saveKategori(){
		$this->load->model('m_insert');
		$this->m_insert->save_kategori();
		redirect('kabid/master-kategori');
	}
	function cetakLaporan(){
		$this->load->library('Pdf');
		$bulan = $this->input->get('bulan');
		$dataLaporan = $this->m_main->getReportMonth();

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('AddeectCodeWorks');
		$pdf->SetTitle('Laporan Bulanan');
		$pdf->SetSubject('RRI');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Laporan Bulanan', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, '43', PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin('50');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		$pdf->AddPage();
		
		$html = '<span style="font-weight: bold;">EVALUASI PRESTASI KERJA REPORTER</span><br/><br/>';
		/*$query1 = "SELECT NAMA_LOKASI, WITEL FROM master_access_point WHERE ID_LOKASI='".$id_lokasi."'";
		$result1 = mysql_query($query1);
		while($row1 = mysql_fetch_array($result1)){
		    $nama_lokasi = $row1[0];
		    $witel = $row1[1];
		    $html .= '<span style="font-weight: normal;">ID Lokasi : '.$id_lokasi.' </span><br/>';
		    $html .= '<span style="font-weight: normal;">Nama Lokasi : '.$nama_lokasi.' </span><br/>';
		    $html .= '<span style="font-weight: normal;">Witel : '.$witel.' </span><br/><br/>';
		}*/

		$html .='<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
		<tr style="background-color:#f0f8ff"><td width="30px">No.</td><td width="286px">Nama Reporter</td><td>Jumlah Berita</td><td>Jumlah Point Reward</td></tr>';
		$start = 1;
		foreach ($dataLaporan as $row)
		{
				$html .= "<tr>";
		        $html .= "<td>".$start++."</td>";
		        $html .= "<td style=\"text-align:left\">&nbsp;$row->NAMA_USER</td>";
		        $html .= "<td>$row->jumlah_berita</td>";
		        $html .= "<td>$row->jumlah_reward</td>";
		        $html .= "</tr>";
		}

		$html .= '</table><br/>';
		//$html .= '<br/><span style="font-weight: bold;">REKOMENDASI</span><br/>';
		$html .= '<br/>';
		$html .= '<span style="font-weight: normal;">Nama - nama reporter yang tercantum di atas adalah reporter yang memiliki jumlah reward tertinggi di bulan '.$bulan.'.</span><br/>';
		

		$html .= '</span><br/>';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->lastPage();
		//$pdf->Write(5, 'Some sample text');
		$pdf->Output('My-File-Name.pdf', 'I');
	}
	function simpanReward(){
		
		$this->load->model('m_insert');
        $this->m_insert->simpan_reward();
        redirect('kabid/master-reward');
        //$data['notifikasi'] = 'Data berhasil disimpan';
        //$data['judul']='Insert Data Berhasil';
        //$this->load->view('pages/notifikasi', $data);
		//redirect('reporter/naskah');
	}
}
