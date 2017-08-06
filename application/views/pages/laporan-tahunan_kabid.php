<link rel="stylesheet" href="<?php echo base_url('assets/css/selectize.bootstrap3.css')?>">
<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Kabid</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url('kabid/evaluasi') ?>">Evaluasi</a></li>
        <li><a href="<?php echo site_url('kabid/master-reward') ?>">Master Reward</a></li>
        <li><a href="<?php echo site_url('kabid/master-pegawai') ?>">Data Pegawai</a></li>
        <li><a href="<?php echo site_url('kabid/master-kategori') ?>">Master Kategori</a></li>
        <li><a href="<?php echo site_url('kabid/hasil-reward') ?>">Hasil Reward</a></li>
        <li><a href="<?php echo site_url('kabid/laporan-bulanan') ?>">Rekapitulasi Bulanan</a></li>
        <li class="active"><a>Rekapitulasi Reporter</a></li>
        <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs font_menu">
      <div class="profile_picture_container"><img class="profile_picture" src="<?php echo base_url('assets/img/Logo_RRI.png')?>">
        <span class="menu_item">RRI News Management</span>
      </div>
      <span class="menu_item" style="border-bottom: 1px solid #337ab7;"><a><?php echo $_SESSION['nama_user'] ?></a></span>
      <span class="menu_item">Anda masuk sebagai</span>
      <h2><?php echo $_SESSION['role'] ?></h2>
      <!--h2><a><?php // echo $_SESSION['sess_namalok'] ?></a></h2-->
      <ul class="nav nav-pills nav-stacked kustom_sidebar">
        <li><a href="<?php echo site_url('kabid/evaluasi') ?>">Evaluasi</a></li>
        <li><a href="<?php echo site_url('kabid/master-reward') ?>">Master Reward</a></li>
        <li><a href="<?php echo site_url('kabid/master-pegawai') ?>">Data Pegawai</a></li>
        <li><a href="<?php echo site_url('kabid/master-kategori') ?>">Master Kategori</a></li>
        <li><a href="<?php echo site_url('kabid/hasil-reward') ?>">Hasil Reward</a></li>
        <li><a href="<?php echo site_url('kabid/laporan-bulanan') ?>">Rekapitulasi Bulanan</a></li>
        <li class="active"><a>Rekapitulasi Reporter</a></li>
        <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
      <br>
    </div>

    <div class="col-sm-9 konten">
      <form target="_blank" method="get" action="<?php echo site_url('kabid/cetakLaporanTahunan') ?>">
      <div class="row">
        <div class="col-sm-12">
          <div>
            <h3 class="text-center">Laporan Per Reporter</h3>
          </div>
          <div class="row-fluid" style="border-top: 1px solid gray;padding:10px 0"></div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Nama Reporter</label>
                <select id="id_reporter" name="id_reporter">
                  <?php foreach ($get_reporter_all as $key) { ?>
                      <option value="<?php echo $key->ID_USER; ?>"><?php echo $key->NAMA_USER; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal</label>
                <div class="row">
                  <div class="col-sm-5"><input class="form-control" type="text" name="start_date" id="start_date" /></div>
                  <div class="col-sm-1"><span style="vertical-align: -webkit-baseline-middle;text-align: center;" >s/d</span></div>
                  <div class="col-sm-5"><input class="form-control" type="text" name="end_date" id="end_date" /></div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <button id="btn_tampil" type="button" class="btn btn-success btn-sm btn-block">
                <span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;TAMPILKAN
              </button>
            </div>
            <div class="col-sm-2">
              <button id="btn_cetak" type="button" class="btn btn-primary btn-sm btn-block">
                <span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;CETAK
              </button>
            </div>
          </div>
          <div class="row-fluid" style="border-bottom: : 1px solid black;padding:20px 0 0 0"></div>
          <div class="row-fluid" style="border-top: 2px solid gray;padding:0 0 20px 0"></div>
          <div class="row-fluid">
            <div class="table" id="report">
              <div class="text-center">
                <span id="loading" class="glyphicon glyphicon-tasks" style="font-size: 75px;color:gray;"></span>
              </div>
              <div class="text-center">
                <h3 id="text_message" class="text-center">Pilih Reporter dan Periode Terlebih Dahulu. Lalu Klik <strong>Tampilkan</strong></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/selectize.js') ?>"></script>
<script>
$(document).ready(function(){

  $('#start_date').datetimepicker({timepicker:false,format:'Y-m-d'});
  $('#end_date').datetimepicker({timepicker:false,format:'Y-m-d'});

  // CETAK PDF
  $('#btn_cetak').click(function(){
      var id_reporter = $('#id_reporter').val();
      var tgl_awal = $('#start_date').val();
      var tgl_akhir = $('#end_date').val();
      var url = "<?php echo site_url('kabid/laporan_pdf'); ?>?id="+id_reporter+"&tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir;
      var win = window.open(url, '_blank');
        win.focus();
  });

  var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
  ];
  // AJAX 
  $('button#btn_tampil').click(function(){

    $('#loading').removeClass('hidden');
    $('#text_message').removeClass('hidden');
    $('#loading').removeClass('glyphicon-tasks');
    $('#loading').addClass('glyphicon-cog gly-spin');
    $('#text_message').html("Loading . . .");

    var id_reporter = $('select#id_reporter').val();
    var start_date = $('input#start_date').val();
    var end_date = $('input#end_date').val();

    var start_date_01 = new Date(start_date);
    var end_date_01 = new Date(end_date);

    // alert((monthNames[start_date_01.getMonth()]) + '/' + start_date_01.getDate() + '/' +  start_date_01.getFullYear());

    var hari = start_date_01.getDate();
    var bulan = monthNames[start_date_01.getMonth()];
    var tahun = start_date_01.getFullYear();

    var hari_01 = end_date_01.getDate();
    var bulan_01 = monthNames[end_date_01.getMonth()];
    var tahun_01 = end_date_01.getFullYear();
    // alert(id_reporter);
    // AJAX START
    var request = $.ajax({
      url: "<?php echo site_url('kabid/getEmployeeReport') ?>",
      method: "POST",
      data: {
        id_reporter : id_reporter,
        start_date : start_date,
        end_date : end_date
      },
      dataType: "json"
    });

    request.done(function( data ) {
      if ($('#table_report').length){ // CHECK ELEMENT AFTER 1st AJAX Request
        // alert("exist");
        $('table#table_report').empty();
        if ($.isEmptyObject(data)){
              $('#loading').removeClass('glyphicon-cog gly-spin');
              $('#loading').addClass('glyphicon-tasks');
              $('#text_message').html("Data Kosong");

              $('label#name_01').html('Nama : - ');
              $('label#period_01').html('Periode : - ');
          }
        else{
          $('#loading').addClass('hidden');
          $('#text_message').addClass('hidden');
            // $('div#report').html('<table class="table table-responsive table-bordered" id="table_report">');
            $('label#name_01').html('Nama : '+data[0].nama);
            $('label#period_01').html('Periode : '+hari+' '+bulan+' '+tahun+' s/d '+hari_01+' '+bulan_01+' '+tahun_01);
            
            $('table#table_report').append(
              '<thead><tr style="background-color:#f7f7f7;"><td>No.</td><td>Bulan</td><td>Berita Masuk</td><td>Berita Hot</td></tr></thead>'
              );
            $('table#table_report').append('<tbody>');
            
            var i = 0;
            var berita_count = 0;
            var hot_count = 0;
            for (i = 0; i < data.length ; i++) {
              // i = 1;
                $('tbody').append(
                  '<tr><td>'+(i+1)+'</td><td>'+monthNames[((data[i].month)-1)]+'</td><td>'+data[i].jumlah_berita+'</td><td>'+data[i].jumlah_hot_news+'</td></tr>');

                berita_count = berita_count + parseFloat(data[i].jumlah_berita);
                hot_count = hot_count + parseFloat(data[i].jumlah_hot_news);
                
            }
            // TOTAL
            $('tbody').append(
              '<tr><td colspan="2"><b>Total</b></td><td><b>'+berita_count+'</b></td><td><b>'+hot_count+'</b></td></tr>');
            $('table#table_report').append('</tbody>');
            // $('div#report').append('</table>');
        }
      }
      else{ // 1st AJAX Request

        if ($.isEmptyObject(data)){
              $('#loading').removeClass('glyphicon-cog gly-spin');
              $('#loading').addClass('glyphicon-tasks');
              $('#text_message').html("Data Kosong");

              $('label#name_01').html('Nama : - ');
              $('label#period_01').html('Periode : - ');
          }
        else{
          $('#loading').addClass('hidden');
          $('#text_message').addClass('hidden');

          $('div#report').append('<div class="form-group"><label id="name_01">Nama : '+data[0].nama+'</label></div>');
          $('div#report').append('<div class="form-group"><label id="period_01">Periode : '+hari+' '+bulan+' '+tahun+' s/d '+hari_01+' '+bulan_01+' '+tahun_01+'</label></div>');
          $('div#report').append('<table class="table table-responsive table-bordered" id="table_report">');
          $('table#table_report').append(
            '<thead><tr style="background-color:#f7f7f7;"><td>No.</td><td>Bulan</td><td>Berita Masuk</td><td>Berita Hot</td></tr></thead>'
            );
          $('table#table_report').append('<tbody>');
          
          var i = 0;
          var berita_count = 0;
          var hot_count = 0;

          for (i = 0; i < data.length ; i++) {
            // i = 1;
             // alert(data[i].month);
              $('tbody').append(
                '<tr><td>'+(i+1)+'</td><td>'+monthNames[((data[i].month)-1)]+'</td><td>'+data[i].jumlah_berita+'</td><td>'+data[i].jumlah_hot_news+'</td></tr>');
              berita_count = berita_count + parseFloat(data[i].jumlah_berita);
              hot_count = hot_count + parseFloat(data[i].jumlah_hot_news);
          }
          // TOTAL
          $('tbody').append(
            '<tr><td colspan="2"><b>Total</b></td><td><b>'+berita_count+'</b></td><td><b>'+hot_count+'</b></td></tr>');

          $('table#table_report').append('</tbody>');
          $('div#report').append('</table>');
          
          
        }
      }
      
      console.log(data);
    });

    request.fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
      console.log(jqXHR);
    });
  });

  $('select#id_reporter').selectize({
      sortField: 'text'
      }
  );

  
});
</script>