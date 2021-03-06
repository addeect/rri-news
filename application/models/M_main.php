<?php
class M_main extends CI_Model{
	function __construct(){
		$this->load->database();
	}
	function getReporterBest($start_date = null, $end_date = null){
		$this->db->select("
			u.NAMA_USER,
			count(*) as jumlah,
			b.*");
		$this->db->from("berita b");
		$this->db->join("user u", "b.ID_USER = u.ID_USER");
		if($start_date != null){
			$this->db->where("b.tanggal_pembuatan >=",$start_date);
		}
		if($end_date != null){
			$this->db->where("b.tanggal_pembuatan <=",$end_date);
		}
		$this->db->group_by("u.ID_USER");
		$this->db->order_by("jumlah DESC");
		$this->db->limit("5");

		$q = $this->db->get();
		return $q->result();
	}
	function getCategoryNews($id_kategori,$start_date = null,$end_date = null){

		$this->db->select("
			day(b.tanggal_pembuatan) as day,
			month(b.tanggal_pembuatan) as month,
			monthname(b.tanggal_pembuatan) as bulan,
			year(b.tanggal_pembuatan) as tahun,
			k.NAMA_KATEGORI,
			b.JUDUL,
			u.nama_user as nama,
			b.TANGGAL_PEMBUATAN,
			b.HOT_NEWS,
			IF(b.HOT_NEWS IS NULL,'','Hot News') AS keterangan");
		$this->db->from("berita b");
		$this->db->join("user u","b.id_user=u.id_user");
		$this->db->join("kategori k","k.ID_KATEGORI=b.ID_KATEGORI");
		if($id_kategori != "ALL"){
			$this->db->where("b.id_kategori",$id_kategori);
		}
		if($start_date != null){
			$this->db->where("b.tanggal_pembuatan >=",date('Y-m-d H:i:s', strtotime($start_date)));
		}
		if($end_date != null){
			$this->db->where("b.tanggal_pembuatan <=",date('Y-m-d H:i:s', strtotime($end_date)));
		}
		$this->db->group_by("b.ID_BERITA");
		$this->db->order_by("k.NAMA_KATEGORI ASC");
		$query = $this->db->get();

		return $query->result();
	}
	function getReportEmployee($id_reporter,$start_date = null,$end_date = null){

		$this->db->select("
			month(b.tanggal_pembuatan) as month,
			monthname(b.tanggal_pembuatan) as bulan,
			year(b.tanggal_pembuatan) as tahun,
			count(*) as jumlah_berita,
			IF(sum(b.hot_news) IS NULL,'0',sum(b.hot_news)) AS jumlah_hot_news,
			COUNT(b.id_berita) * (select jumlah_reward from reward where id_reward = (Select max(id_reward) from reward)) as nominal_reward,
			u.nama_user as nama");
		$this->db->from("berita b");
		$this->db->join("user u","b.id_user=u.id_user");
		$this->db->where("b.id_user",$id_reporter);
		if($start_date){
			$this->db->where("b.tanggal_pembuatan >=",date('Y-m-d H:i:s', strtotime($start_date)));
		}
		if($end_date){
			$this->db->where("b.tanggal_pembuatan <=",date('Y-m-d H:i:s', strtotime($end_date)));
		}
		$this->db->group_by("bulan");
		$this->db->order_by("bulan ASC");
		$query = $this->db->get();

		return $query->result();
	}
	function getReward(){
		$query = $this->db->query("Select JUMLAH_REWARD from reward where id_reward = (select max(id_reward) from reward)");
		// $query = $this->db->get();
		return $query->result();
		// return $query;
	}
	function getReporterAll(){
		$jabatan = "Reporter";
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("jabatan",$jabatan);
		$this->db->order_by("2 ASC");
		$query = $this->db->get();

		return $query->result();
	}
	function getMonth(){
		$this->db->select("MONTH(TANGGAL_PEMBUATAN) as month");
		$this->db->from("berita");
		$this->db->group_by("month");
		$query = $this->db->get();

		return $query->result();
	}
	function getReportYear($tahun = null,$bulan = null){

		$this -> db -> select(" u.NAMA_USER 'NAMA_USER', IF(count(*) IS NULL,'0',count(*)) AS jumlah_berita, IF(sum(b.hot_news) IS NULL,'0',sum(b.hot_news)) AS jumlah_reward");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		if($tahun){
			$this -> db -> where('YEAR(b.TANGGAL_PEMBUATAN)',$tahun);
		}
		if($bulan){
			$this -> db -> where('MONTH(b.TANGGAL_PEMBUATAN)',$bulan);
		}
		$this -> db -> where('b.TANGGAL_DISETUJUI IS NOT NULL',NULL);
		//$this->db->where("b.TANGGAL_DISETUJUI is null AND b.JUDUL LIKE '%".$keyword."%' OR b.ISI LIKE '%".$keyword."%' ",NULL);
		$this->db->group_by("b.ID_USER");
		$this->db->order_by("jumlah_reward DESC");
		// $this -> db -> limit(5);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getReporterEachMonth($year){
		$this->db->select("
			MONTH(b.tanggal_pembuatan) AS month,
			u.NAMA_USER, 
			COUNT(b.id_berita) * (select jumlah_reward from reward where id_reward = (Select max(id_reward) from reward)) as nominal_reward,
			IF(COUNT(b.id_berita) IS NULL,'0',COUNT(b.id_berita)) as berita_masuk, 
			IF(SUM(b.hot_news) IS NULL,'0', SUM(b.hot_news)) as berita_hot
		");
		$this->db->from("berita b");
		$this->db->join("user u","b.id_user = u.id_user");
		$this->db->where("b.tanggal_disetujui is not null",NULL);
		$this->db->where("year(b.tanggal_pembuatan)",$year);
		$this->db->group_by("month(b.tanggal_pembuatan), b.ID_USER");
		$query = $this->db->get();

		return $query->result();
	}
	function getReportYearNumRow($tahun = null,$bulan = null,$hot = null){

		$this -> db -> select("*");
		$this -> db -> from('berita b');
		
		if($tahun){
			$this -> db -> where('YEAR(b.TANGGAL_PEMBUATAN)',$tahun);
		}
		if($bulan){
			$this -> db -> where('MONTH(b.TANGGAL_PEMBUATAN)',$bulan);
		}
		if($hot){
			$this -> db -> where('HOT_NEWS',$hot);
		}
		$this -> db -> where('b.TANGGAL_DISETUJUI IS NOT NULL',NULL);
		

		$this->db->order_by("1 DESC");

	   $query = $this -> db -> get();
		return $query->num_rows();
	}
	function getDataKategoriAktif(){
		$this->db->select("ID_KATEGORI , NAMA_KATEGORI, STATUS_KATEGORI ");
		$this->db->from("kategori");
		$this->db->where("STATUS_KATEGORI","Aktif");
		$this->db->order_by("NAMA_KATEGORI ASC");

		$query = $this->db->get();
		return $query->result();
	}
	function getDataKategori(){
		$this->db->select("ID_KATEGORI , NAMA_KATEGORI, STATUS_KATEGORI ");
		$this->db->from("kategori");
		$this->db->order_by("NAMA_KATEGORI ASC");

		$query = $this->db->get();
		return $query->result();
	}
	function getDataPegawai(){
		$this->db->select(" NAMA_USER, JABATAN, STATUS_PEGAWAI ");
		$this->db->from(" user");
		$this->db->order_by("NAMA_USER ASC");

		$query = $this->db->get();
		return $query->result();
	}
	function getDataEvaluasi2(){
		$this -> db -> select(" sum(r.JUMLAH_REWARD) 'nominal_reward', u.NAMA_USER 'NAMA_USER', monthname(b.TANGGAL_PEMBUATAN) 'NAMA_BULAN', year(b.TANGGAL_PEMBUATAN) 'TAHUN' , count(*) jumlah_berita, sum(b.HOT_NEWS) jumlah_reward");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('reward r','r.ID_REWARD=b.ID_REWARD');
		$this->db->where("b.TANGGAL_DISETUJUI is not null ",NULL);
		$this->db->group_by("b.ID_USER");
		$this->db->order_by("nominal_reward DESC");
		$this -> db -> limit(5);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getDataEvaluasi1(){
		$this -> db -> select(" u.NAMA_USER 'NAMA_USER', monthname(b.TANGGAL_PEMBUATAN) 'NAMA_BULAN', year(b.TANGGAL_PEMBUATAN) 'TAHUN' , count(*) jumlah_berita, sum(b.HOT_NEWS) jumlah_reward");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		//$this->db->where("b.TANGGAL_DISETUJUI is null AND b.JUDUL LIKE '%".$keyword."%' OR b.ISI LIKE '%".$keyword."%' ",NULL);
		$this->db->group_by("b.ID_USER");
		$this->db->order_by("jumlah_reward desc");
		$this -> db -> limit(5);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getReportMonth(){

		$this -> db -> select(" u.NAMA_USER 'NAMA_USER', count(*) jumlah_berita, sum(b.HOT_NEWS) jumlah_reward");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		//$this->db->where("b.TANGGAL_DISETUJUI is null AND b.JUDUL LIKE '%".$keyword."%' OR b.ISI LIKE '%".$keyword."%' ",NULL);
		$this->db->group_by("b.ID_USER");
		$this->db->order_by("jumlah_reward DESC");
		$this -> db -> limit(5);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getSearchApproved(){
		$keyword = $this->input->post('keyword');
		$this -> db -> select("k.NAMA_KATEGORI, b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('kategori k','k.ID_KATEGORI=b.ID_KATEGORI');
		$this->db->where("b.TANGGAL_DISETUJUI is not null AND b.STATUS_REVISI = 'DISETUJUI OLEH REDAKSI' AND b.JUDUL LIKE '%".$keyword."%' OR b.ISI LIKE '%".$keyword."%' ",NULL);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getSearch(){
		$keyword = $this->input->post('keyword');
		$this -> db -> select("k.NAMA_KATEGORI, b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('kategori k','k.ID_KATEGORI=b.ID_KATEGORI');
		$this->db->where("b.TANGGAL_DISETUJUI is null AND b.STATUS_REVISI != 'DISETUJUI OLEH REDAKSI' AND b.JUDUL LIKE '%".$keyword."%' OR b.ISI LIKE '%".$keyword."%' ",NULL);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getData6(){
		$this->db->select(" ID_REWARD 'ID', JUMLAH_REWARD 'REWARD' ");
		$this->db->from("reward");
		$this->db->order_by("ID_REWARD DESC");
		$this->db-> limit(1);

		$query = $this->db->get();
		return $query->result();
	}
	function getData5(){
		$this->db->select(" MAX(ID_REWARD) 'ID'");
		$this->db->from("reward");

		$query = $this->db->get();
		return $query->result();
	}
	function getData4(){
		$this -> db -> select(" ID_KATEGORI 'ID' , NAMA_KATEGORI 'NAMA_KATEGORI' ");
		$this -> db -> from('kategori');
		// $this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> where('STATUS_KATEGORI', 'Aktif');
		$this->db->order_by("NAMA_KATEGORI ASC");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getData3($user_id){
		$this -> db -> select(" b.REDAKSI, k.NAMA_KATEGORI, TANGGAL_EDIT 'TANGGAL_EDIT',STATUS_REVISI 'STATUS_REVISI', PATH_REKAMAN 'PATH' , SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('kategori k','k.ID_KATEGORI=b.ID_KATEGORI');
		$this -> db -> where('u.ID_USER', $user_id);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getUserInfo($user_id){
		$this -> db -> select('ID_USER "ID_USER", PASSWORD "PASSWORD", NAMA_USER "NAMA_USER", JABATAN "JABATAN"');
		$this -> db -> from('user');
		$this -> db -> where('ID_USER', $user_id);
		//$this -> db -> where('PASSWORD', $pass);
		$this -> db -> limit(1);
							
		//$d = $this->db->get_where('user',$data);	
		$q = $this -> db -> get();
		foreach ($q->result() as  $qrow) {
			return $qrow->NAMA_USER;
		}
		//return $d->result();
	}
	function doLogin($user_id,$pass){
		$this -> db -> select('ID_USER "ID_USER", PASSWORD "PASSWORD", NAMA_USER "NAMA_USER", JABATAN "JABATAN"');
		$this -> db -> from('user');
		$this -> db -> where('ID_USER', $user_id);
		$this -> db -> where('PASSWORD', $pass);
		$this -> db -> limit(1);
							
		//$d = $this->db->get_where('user',$data);	
		$d = $this -> db -> get();
		foreach ($d->result() as  $row) {
			return $row->JABATAN;
		}
		//return $d->result();
	}
	function getData1_revisi_numrow(){
		$this -> db -> select(" TANGGAL_EDIT 'TANGGAL_EDIT', STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where('b.TANGGAL_EDIT IS NOT NULL AND b.TANGGAL_DISETUJUI IS NULL',null,false);
		
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		$num = $query->num_rows();
		return $num;
	}
	function getData1_approved_numrow(){
		$this -> db -> select(" TANGGAL_EDIT 'TANGGAL_EDIT', STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where('b.TANGGAL_DISETUJUI IS NOT NULL',null,false);
		
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		$num = $query->num_rows();
		return $num;
	}
	function getData1_baru_numrow_telah_direvisi(){
		$this -> db -> select(" b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where("b.STATUS_REVISI = 'DIEDIT OLEH REPORTER' ", NULL);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
	   $num = $query->num_rows();
		return $num;
	}
	function getData1_baru_numrow_telah_dicek($user_id){
		$this -> db -> select(" b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where("b.STATUS_REVISI = 'DIEDIT OLEH REDAKSI' AND b.ID_USER='".$user_id."' ", NULL);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
	   $num = $query->num_rows();
		return $num;
	}
	function getData1_baru_numrow(){
		$this -> db -> select(" b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where("b.TANGGAL_EDIT is null and b.STATUS_REVISI is null", NULL);
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
	   $num = $query->num_rows();
		return $num;
	}
	function getData1_numrow(){
		$this -> db -> select(" b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this->db->where(array('b.TANGGAL_DISETUJUI' => NULL));
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
	   $num = $query->num_rows();
		return $num;
	}
	function getData1_approved(){
		$this -> db -> select("b.REDAKSI ,k.NAMA_KATEGORI 'NAMA_KATEGORI' , b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('kategori k','k.ID_KATEGORI=b.ID_KATEGORI');
		$this->db->where('b.TANGGAL_DISETUJUI IS NOT NULL',null,false);
		
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getData1(){
		$this -> db -> select("k.NAMA_KATEGORI 'NAMA_KATEGORI' , b.TANGGAL_EDIT 'TANGGAL_EDIT', b.STATUS_REVISI 'STATUS_REVISI' ,SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> join('kategori k','k.ID_KATEGORI=b.ID_KATEGORI');
		$this->db->where(array('b.TANGGAL_DISETUJUI' => NULL));
		$this->db->order_by("b.ID_BERITA");
		//$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	function getData2($id_berita){
		$this -> db -> select(" b.PATH_REKAMAN 'PATH' ,b.JUDUL 'JUDUL_FULL',b.ISI 'ISI',SUBSTRING(b.JUDUL, 1, 30) 'JUDUL' ,u.NAMA_USER 'NAMA',b.ID_BERITA 'ID', b.ID_USER 'ID_USER', b.TANGGAL_PEMBUATAN 'TANGGAL_PEMBUATAN', b.HOT_NEWS 'REWARD', b.ID_KATEGORI 'TOPIK' ");
		$this -> db -> from('berita b');
		$this -> db -> join('user u','b.ID_USER=u.ID_USER');
		$this -> db -> where('b.ID_BERITA',$id_berita);
		
		//$this->db->order_by("b.ID_BERITA");
		$this -> db -> limit(1);

	   $query = $this -> db -> get();
		return $query->result();
	}
	/*function getDataRevenue(){
		$this -> db -> select("sum(dp.subtotal) as SUBTOTAL,sum(dp.jumlah) as JUMLAH,b.barang_name'NAME',b.barang_id'ID'");
		$this -> db -> from('order_list ol ');
		$this -> db -> join('detail_penjualan dp','ol.order_id=dp.order_id');
		$this -> db -> join('barang b','b.barang_id=dp.barang_id');
		$this -> db -> where('ol.is_confirmed', '1');
		$this->db->group_by("dp.BARANG_ID");
		$this->db->order_by("SUBTOTAL","desc");
		$this -> db -> limit(5);

	   $query = $this -> db -> get();
		return $query->result();
	}*/
	
	
	/*function m_addQty($barang_id,$jumlah,$subtotal,$order_id){
		$simpan_data=array(
			'jumlah' => $jumlah,
            'subtotal' => $subtotal
       );
		$this->db->set($simpan_data);
		$this->db->where('barang_id', $barang_id);
		$this->db->where('order_id', $order_id);
		$this->db->update('detail_penjualan', $simpan_data);
	}*/
	
}