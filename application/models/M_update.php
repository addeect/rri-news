<?php
class M_update extends CI_Model{
	function __construct(){
		$this->load->database();
	}
	function hapus_kategori(){
		//$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_kategori1');
		 $simpan_data=array(
            
			'STATUS_KATEGORI'  => 'Tidak Aktif'
			
       );
       	$this->db->where('ID_KATEGORI', $id);
		$this->db->update('kategori', $simpan_data);
        //return $query;
	}
	function edit_kategori(){
		//$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_kategori');
		 $simpan_data=array(
            
			'NAMA_KATEGORI'  => $this->input->post('nama_kategori')
			
       );
       	$this->db->where('ID_KATEGORI', $id);
		$this->db->update('kategori', $simpan_data);
        //return $query;
	}
	function reporter_perbarui_berita(){
		//$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_berita');
		 $simpan_data=array(
            
			'JUDUL'  => $this->input->post('judul'),
			//'STATUS_REVISI'  => 'DIEDIT OLEH REPORTER',
			//'TANGGAL_EDIT'  => $now,
			'ISI'  => $this->input->post('isi')
       );
       	$this->db->where('ID_BERITA', $id);
		$this->db->update('berita', $simpan_data);
        //return $query;
	}
	function reporter_koreksi_berita(){
		$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_berita');
		 $simpan_data=array(
            
			'JUDUL'  => $this->input->post('judul'),
			'STATUS_REVISI'  => 'DIEDIT OLEH REPORTER',
			'TANGGAL_EDIT'  => $now,
			'ISI'  => $this->input->post('isi')
       );
       	$this->db->where('ID_BERITA', $id);
		$this->db->update('berita', $simpan_data);
        //return $query;
	}
	function getDataKorektor($user_id){
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("ID_USER",$user_id);
		$this->db->limit("1");
		$query = $this->db->get();
		return $query->result();
	}
	function koreksi_berita(){
		$redaksi_name = null;
		$user_id = $_SESSION['user_id'];
		$data_redaksi = $this->getDataKorektor($user_id);
		foreach ($data_redaksi as $key) {
			$redaksi_name = $key->NAMA_USER;
		}

		$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_berita');
		 $simpan_data=array(
            
			'JUDUL'  => $this->input->post('judul'),
			'STATUS_REVISI'  => 'DIEDIT OLEH REDAKSI',
			'TANGGAL_EDIT'  => $now,
			'ISI'  => $this->input->post('isi'),
			'REDAKSI'  => $redaksi_name
       );
       	$this->db->where('ID_BERITA', $id);
		$this->db->update('berita', $simpan_data);
        //return $query;
	}
	function approve_berita(){
		$redaksi_name = null;
		$user_id = $_SESSION['user_id'];
		$data_redaksi = $this->getDataKorektor($user_id);
		foreach ($data_redaksi as $key) {
			$redaksi_name = $key->NAMA_USER;
		}
		$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_order');
		 $simpan_data=array(
            'STATUS_REVISI' => 'DISETUJUI OLEH REDAKSI',
			'TANGGAL_DISETUJUI'  => $now,
			'REDAKSI'  => $redaksi_name
       );
       	$this->db->where('ID_BERITA', $id);
		$this->db->update('berita', $simpan_data);
        //return $query;
	}
	function approve_berita_with_hotnews(){
		$redaksi_name = null;
		$user_id = $_SESSION['user_id'];
		$data_redaksi = $this->getDataKorektor($user_id);
		foreach ($data_redaksi as $key) {
			$redaksi_name = $key->NAMA_USER;
		}
		$now = date('Y-m-d H:i:s');
		$id = $this->input->post('id_order');
		 $simpan_data=array(
            'STATUS_REVISI' => 'DISETUJUI OLEH REDAKSI',
			'TANGGAL_DISETUJUI'  => $now,
			'REDAKSI'  => $redaksi_name,
			'HOT_NEWS' => '1'
       );
       	$this->db->where('ID_BERITA', $id);
		$this->db->update('berita', $simpan_data);
        //return $query;
	}
}