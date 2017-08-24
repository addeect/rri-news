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
			'get_reporter_all' => $this->m_main->getReporterAll(),
			'reporter_terbaik' => $this->m_main->getReporterBest(),
			// 'rekap_kategori' => $this->m_main->getCategory(),
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
		
		$start_date = date('Y-m-d H:i:s',strtotime($this->input->post("start_date")));
		$end_date = date('Y-m-d H:i:s',strtotime($this->input->post("end_date")));
		if(strlen($start_date) == 0){
			$start_date = null;
		}
		if(strlen($end_date) == 0){
			$end_date = null;
		}
		// var_dump($start_date." + ".$end_date);die();
		$data = $this->m_main->getReporterBest($start_date,$end_date);
		echo json_encode($data);
	}
	function getCategoryReport(){
		$id_kategori = $_POST["id_kategori"];
		// $start_date = date('Y-m-d H:i:s',strtotime($this->input->post("start_date")));
		// $end_date = date('Y-m-d H:i:s',strtotime($this->input->post("end_date")));
		// var_dump($start_date);die();
		$start_date = null;
		$end_date = null;
		if(strlen($this->input->post("start_date")) > 0){
			$start_date = date('Y-m-d H:i:s',strtotime($this->input->post("start_date")));
		}
		if(strlen($this->input->post("end_date")) > 0){
			$end_date = date('Y-m-d H:i:s',strtotime($this->input->post("end_date")));
		}
		$this->load->model('m_main');
		$data_reporter = $this->m_main->getCategoryNews($id_kategori,$start_date,$end_date);
		echo json_encode($data_reporter);
	}
	function getEmployeeReport(){
		$id_reporter = $_POST["id_reporter"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		// var_dump($_POST["id_reporter"].','.$_POST["start_date"].','.$_POST["end_date"]);die();
		$this->load->model('m_main');
		$data_reporter = $this->m_main->getReportEmployee($id_reporter,$start_date,$end_date);
		echo json_encode($data_reporter);
	}
	function laporan_pdf(){
		$this->load->library('Pdf');
		$id_reporter = $this->input->get('id');
		$start_date = $this->input->get('tgl_awal');
		$end_date = $this->input->get('tgl_akhir');

		$monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
		    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
		  ];

		$data_reporter = $this->m_main->getReportEmployee($id_reporter,$start_date,$end_date);

		$day = date('d',strtotime($start_date));
		$month = date('m',strtotime($start_date));
		$year = date('Y',strtotime($start_date));

		$day_01 = date('d',strtotime($end_date));
		$month_01 = date('m',strtotime($end_date));
		$year_01 = date('Y',strtotime($end_date));

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
		
		$html = '<span style="font-weight: bold;">LAPORAN PER REPORTER</span><br/><br/>';
		foreach ($data_reporter as $key) {
			$nama_reporter = $key->nama;
		}
		$html .= '<span style="font-weight: normal;">Nama : '.$nama_reporter.'</span><br/><br/>';
		$html .= '<span style="font-weight: normal;">Periode : '.$day.' '.$monthNames[(floatval($month)-1)].' '.$year.' s/d '.$day_01.' '.$monthNames[(floatval($month_01)-1)].' '.$year_01.'</span><br/><br/>';
		

		$html .='<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
		<tr style="background-color:#f0f8ff"><td width="30px">No.</td><td width="286px">Bulan</td><td>Berita Masuk</td><td>Berita Hot</td></tr>';
		$start = 1;
		$berita_count = 0;
		$hot_count = 0;
		foreach ($data_reporter as $row)
		{
				$html .= "<tr>";
		        $html .= "<td>".$start++."</td>";
		        $html .= "<td style=\"text-align:left\">&nbsp;".$monthNames[(($row->month)-1)]."</td>";
		        $html .= "<td>".$row->jumlah_berita."</td>";
		        $html .= "<td>$row->jumlah_hot_news</td>";
		        $html .= "</tr>";
		        $berita_count = $berita_count + floatval($row->jumlah_berita);
		        $hot_count = $hot_count + floatval($row->jumlah_hot_news);
		}
		$html .= "<tr>";
        $html .= '<td colspan="2"><b>Total</b></td>';
        // $html .= "<td style=\"text-align:left\">&nbsp;$row->bulan</td>";
        $html .= "<td><b>$berita_count</b></td>";
        $html .= "<td><b>$hot_count</b></td>";
        $html .= "</tr>";
		$html .= '</table><br/>';
		//$html .= '<br/><span style="font-weight: bold;">REKOMENDASI</span><br/>';
		$html .= '<br/>';
		// $html .= '<span style="font-weight: normal;">Nama - nama reporter yang tercantum di atas adalah reporter yang memiliki jumlah reward tertinggi di tahun '.$tahun.'.</span><br/>';
		

		$html .= '</span><br/>';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->lastPage();
		//$pdf->Write(5, 'Some sample text');
		$pdf->Output('Reporter-'.$id_reporter.'-'.date('Y-m-d H:i:s').'.pdf', 'I');
	}
	function cetakLaporanBulanan(){
		$this->load->library('Pdf');
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		// $bulan_name = $this->input->get('bulan_name');
		$dataLaporan = $this->m_main->getReportYear($tahun,$bulan);
		$data_reward = $this->m_main->getReward();
		$reward = null;
		foreach ($data_reward as $key) {
			$reward = $key->JUMLAH_REWARD;
		}
		$monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
		    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
		  ];

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('AddeectCodeWorks');
		$pdf->SetTitle('Laporan Bulanan');
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
		$html .= '<span style="font-weight: normal;">Bulan : '.$monthNames[(floatval($bulan)-1)].' '.$tahun.'</span><br/><br/>';
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
		<tr style="background-color:#f0f8ff"><td width="30px">No.</td><td width="186px">Nama Reporter</td><td>Berita Masuk</td><td>Berita Hot</td><td>Jumlah Nominal</td><td>Target Berita</td></tr>';
		$start = 1;
		// var_dump($reward);die();
		foreach ($dataLaporan as $row)
		{
				$html .= "<tr>";
		        $html .= "<td>".$start++."</td>";
		        $html .= "<td style=\"text-align:left\">&nbsp;$row->NAMA_USER</td>";
		        $html .= "<td>$row->jumlah_berita</td>";
		        $html .= "<td>$row->jumlah_reward</td>";
		        $html .= "<td>".($reward*(floatval($row->jumlah_reward)))."</td>";
		        $html .= "<td>66</td>";
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
		$pdf->Output('Laporan-Bulanan.pdf', 'I');
	}
	function cetakLaporanTahunan(){
		$this->load->library('Pdf');
		$tahun = $this->input->get('tahun');
		// $bulan_name = $this->input->get('bulan_name');
		$month = $this->m_main->getMonth();
		// $dataLaporan = $this->m_main->getReportYear($tahun,$bulan);
		// $data_reward = $this->m_main->getReward();
		
		$monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
		    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
		  ];

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
		
		// $html = '<span style="font-weight: bold;">EVALUASI PRESTASI KERJA REPORTER</span><br/><br/>';
		$html .= '<div style="width:300px;text-align:center;border:none;line-height:1px"><span style="font-weight: normal;text-decoration:none"><b>EVALUASI PRESTASI KERJA REPORTER</b></span></div>';
		$html .= '<div style="width:300px;text-align:center;border:none;line-height:1px"><span style="font-weight: normal;text-decoration:none">Tahun : '.$tahun.'</span></div><br/><br/>';
		// $html .= '<span style="font-weight: normal;">Tahun : '.$tahun.'</span><br/><br/>';
		$html .= '<table>';
		$html .= '<tr>';
		$html .= '<td width="80px"></td>';
		$html .= '<td width="500px">';
		$html .='<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
		<tr style="background-color:#f0f8ff"><td width="30px">No.</td><td width="186px">Bulan</td><td>Berita Masuk</td><td>Berita Hot</td></tr>';
		$start = 1;
		$total_masuk = 0;
		$total_hot = 0;
		// var_dump($month);die();
		foreach ($month as $row)
		{
				$html .= "<tr>";
		        $html .= "<td>".$start++."</td>";
		        $html .= "<td style=\"text-align:left\">&nbsp;".$monthNames[$row->month]."</td>";
		        $jml_berita = $this->m_main->getReportYearNumRow($tahun,$row->month);
		        $jml_hot = $this->m_main->getReportYearNumRow($tahun,$row->month,1);
		        $html .= "<td>".$jml_berita."</td>";
		        $html .= "<td>".$jml_hot."</td>";
		        $html .= "</tr>";
		        $total_masuk = $total_masuk + floatval($jml_berita);
		        $total_hot = $total_hot + floatval($jml_hot);
		}
		$html .= '<tr>';
		$html .= '<td colspan="2"><b>TOTAL</b></td>';
		$html .= '<td><b>'.$total_masuk.'</b></td>';
		$html .= '<td><b>'.$total_hot.'</b></td>';
		$html .= '</tr>';

		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		$html .= '<br/>';
		

		$html .= '</span><br/>';
		// Spacing
    $html .= '<div style="width:300px;text-align:center;border:none;line-height:1px"><span style="font-weight: bold;"></span></div>';

    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td width="50px">&nbsp;</td>';
    $html .= '<td>';
    $html .= '<table border="0">';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center"></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center"><font style="text-decoration:underline"></font></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center"><font style="text-decoration:none"></font></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</td>';
    $html .= '<td width="200px">&nbsp;</td>';
    $html .= '<td>';
    $html .= '<table border="0">';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">Mengetahui</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">Kepala Bidang</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center">&nbsp;</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center"><font style="text-decoration:underline">Deni Rizki</font></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="190px" style="text-align:center"><font style="text-decoration:none"></font></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</table>';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->lastPage();
		//$pdf->Write(5, 'Some sample text');
		$pdf->Output('Laporan-Bulanan.pdf', 'I');
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
