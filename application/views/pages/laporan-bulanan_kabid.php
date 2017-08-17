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
        <li class="active"><a>Rekapitulasi Reward</a></li>
        <li><a href="<?php echo site_url('kabid/laporan-tahunan') ?>">Rekapitulasi Reporter</a></li>
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
        <li class="active"><a>Rekapitulasi Reward</a></li>
        <li><a href="<?php echo site_url('kabid/laporan-tahunan') ?>">Rekapitulasi Reporter</a></li>
        <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
      <br>
    </div>

    <div class="col-sm-9 konten">
      <form target="_blank" method="get" action="<?php echo site_url('kabid/cetakLaporan') ?>">
      <div class="row">
        <div class="col-sm-12">
          <div>
            <h3 class="text-center" style="margin-bottom:20px">Rekapitulasi Reward</h3>
          </div>
          <div class="hairline_1"></div>
          <div class="panel_custom1 collapse" id="acw01" style="margin:0 0 0 0">
            <div class="row container_custom1" style="padding-top:20px">
              <div class="col-sm-4">
                <label for="datepicker_1">Tanggal Awal:</label>
                <input type="text" name="start_date" id="datepicker_1" class="form-control input-sm"/>
              </div>
              <div class="col-sm-4">
                <label for="datepicker_2">Tanggal Akhir:</label>
                <input type="text" name="end_date" id="datepicker_2" class="form-control input-sm"/>
              </div>
              <div class="col-sm-4" style="padding-top: 25px;"><input type="button" class="btn btn-sm btn-success" value="TAMPILKAN" id="drawChart" /><input type="hidden" name="btn_clear" id="hapusChart" value="Hapus Chart"/></div>
            </div>  
          </div>
          <div class="hairline_2"></div>
          <div class="panel_custom1">
            <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="collapse" data-target="#acw01">
              <span class="glyphicon glyphicon-cog"></span>&nbsp;PENGATURAN
            </button>
            <span class="glyphicon glyphicon-signal pull-left" style="font-size:20px;color:#3554a2"></span>
            <h3 id="title_grafik">&nbsp;5 REPORTER TERBAIK<span id="periode_grafik"> - Semua Periode</span></h3>
            <div class="row">
              <div class="col-sm-6">
                <div style="padding:20px 0">
                  <canvas id="chart_laporan_bulanan" style="width:100%;height:300px"></canvas>
                </div>
                
              </div>
              <div class="col-sm-6" >
                
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-1">No</th>
                        <th>Nama</th>
                        <th>Poin</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $count=1; foreach ($reporter_terbaik as $key) { ?>
                      <tr>
                        <td><div class="legend_<?php echo $count; ?>"></div></td>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $key->NAMA_USER; ?></td>
                        <td><?php echo $key->jumlah; ?></td>
                      </tr>
                    <?php $count++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row-fluid" style="border-bottom: : 1px solid black;padding:20px 0 0 0"></div>
          <div class="row-fluid" style="border-top: 2px solid gray;padding:0 0 20px 0"></div>
          <div class="row-fluid" style="padding:0 0 20px 0">
            <h3 class="text-center">Laporan Bulanan</h3>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label>Bulan</label>
              <select name="bulan" id="bulan" class="form-control">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label>Tahun</label>
              <select name="tahun" id="tahun" class="form-control">
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
            </div>
            <div class="col-sm-2" style="padding-top: 26px;">
              <button type="button" class="btn btn-danger btn-sm btn-block" id="btn_cetak">
                <span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;CETAK
              </button>
            </div>
            
          </div>
          <!--div class="row">
            <div class="col-sm-8">
              <canvas class="form-group" id="chart_laporan_bulanan" style="width:500px;height:200px"></canvas>
              <div class="form-group text-center"><label>Reporter Dengan Jumlah Berita Tertinggi</label></div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Pilih Bulan</label>
                <select class="form-control" name="bulan">
                  <option value="01" selected>Januari</option>
                  <option value="02" >Februari</option>
                  <option value="03" >Januari</option>
                  <option value="04" >Maret</option>
                  <option value="05" >April</option>
                  <option value="06" >Mei</option>
                  <option value="07" >Juni</option>
                  <option value="08" >Juli</option>
                </select>
              </div>
              <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Rekap" />
          </div>
            </div>
          </div-->
          
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.bundle.min.js') ?>"></script>
<script>
var nama = [<?php
    foreach ($reporter_terbaik as $key) {
        $arr_nama[] = '"'.$key->NAMA_USER.'"';
     } echo implode(',', $arr_nama)?>];

var nilai = [<?php
    foreach ($reporter_terbaik as $key) {
        $arr_nilai[] = '"'.$key->jumlah.'"';
     } echo implode(',', $arr_nilai)?>];

// var nama = ["Jojo","Vito","Pri","Pakpo","Adam"];
// var nilai = [103,98,96,95,91];
var data_laporan_bulanan = {
        labels: nama,
        datasets: [
            {
                data: nilai,
                backgroundColor: [
                    "#d96557",
                    "#2ECC71",
                    "#ffc65d",
                    "#e0e8f2",
                    "#4C5064"
                ],
                hoverBackgroundColor: [
                    "#f1b3ab",
                    "#75eca8",
                    "#fddc9e",
                    "#c0c5cc",
                    "#8e909a"
                ]
            }]
    };
    var config_laporan_bulanan = {
            type: 'doughnut',
            data: data_laporan_bulanan,
            options: {legend:false,
            tooltips: {
                // callbacks: {
                //     label: function(tooltipItem, data) {
                //         var allData = data.datasets[tooltipItem.datasetIndex].data;
                //         var tooltipLabel = data.labels[tooltipItem.index];
                //         var tooltipData = allData[tooltipItem.index];
                //         var total = 0;
                //         for (var i in allData) {
                //             total += allData[i];
                //         }
                //         var tooltipPercentage = Math.round((tooltipData / total) * 100);
                //         return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                //     }
                // }
            }
        }
    };
    var chart_laporan_bulanan;
    function drawChart(){
      chart_laporan_bulanan = new Chart(document.getElementById("chart_laporan_bulanan"), config_laporan_bulanan);
    };
    function hapusChart(){
      chart_laporan_bulanan.destroy();
    };
    function updateChart(){
      chart_laporan_bulanan.update();
    };
$(document).ready(function(){
  // CETAK PDF
  $('#btn_cetak').click(function(){
      var tahun = $('#tahun').val();
      var bulan = $('#bulan').val();
      var url = "<?php echo site_url('kabid/cetakLaporanTahunan'); ?>?tahun="+tahun+"&bulan="+bulan;
      var win = window.open(url, '_blank');
        win.focus();
  });
  drawChart();
  $('#datepicker_1').datetimepicker({timepicker:false,format:'Y-m-d'});
  $('#datepicker_2').datetimepicker({timepicker:false,format:'Y-m-d'});
  //--- CHART JS -----------
  
    
    $("#hapusChart").click(function(){
      hapusChart();
    });

    // ----------------------------------- DYNAMIC PIE CHART - ACW - 23/03/17 ------------------------------- //
    $("#drawChart").click(function(){
      

      // AJAX START
      if(window.XMLHttpRequest)
      {
        xmlhttp = new XMLHttpRequest();
      }
      else
      {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      var start_date = $('#datepicker_1').val();
      var end_date = $('#datepicker_2').val();
      var url = "<?php echo site_url('kabid/dashboard1') ?>";
      var params = "status=berhasil&start_date="+start_date+"&end_date="+end_date;
      xmlhttp.open("POST", url, true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.onreadystatechange = function()
      {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          // DELETE CHART
      hapusChart();
      //sleep
        
          var data = xmlhttp.responseText;
          var explode = data.split(';');

          //document.getElementById("isi_tabel_gangguan_berulang").innerHTML=explode[0];
          // var nama_updated = explode[1];
          // var nilai_updated = explode[0];

          var name_1 = explode[0];
          var name_2 = explode[1];
          var name_3 = explode[2];
          var name_4 = explode[3];
          var name_5 = explode[4];
          var a = explode[5];
          var b = explode[6];
          var c = explode[7];
          var d = explode[8];
          var e = explode[9];
          var bgcolor = ["#d96557",
                        "#2ECC71",
                        "#ffc65d",
                        "#e0e8f2",
                        "#4C5064"];
          var hbgcolor = ["#f1b3ab",
                        "#75eca8",
                        "#fddc9e",
                        "#c0c5cc",
                        "#8e909a"];
          //nama
          //nama.unshift = (explode[1]);
          //nilai.unshift = (explode[0]);
          // UPDATE DATASET
          data_laporan_bulanan = {
            labels: [name_1,name_2,name_3,name_4,name_5],
            datasets: [
                {
                    data: [a,b,c,d,e],
                    backgroundColor: bgcolor
                    ,
                    hoverBackgroundColor: hbgcolor
                }]
        };

        // UPDATE CONFIG
        config_laporan_bulanan = {
                type: 'doughnut',
                data: data_laporan_bulanan,
                options: {legend:true,
                tooltips: {
                    // callbacks: {
                    //     label: function(tooltipItem, data) {
                    //         var allData = data.datasets[tooltipItem.datasetIndex].data;
                    //         var tooltipLabel = data.labels[tooltipItem.index];
                    //         var tooltipData = allData[tooltipItem.index];
                    //         var total = 0;
                    //         for (var i in allData) {
                    //             total += allData[i];
                    //         }
                    //         var tooltipPercentage = Math.round((tooltipData / total) * 100);
                    //         return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                    //     }
                    // }
                }
            }
        };
          //document.getElementById("cursor_gangguan_berulang").innerHTML=explode[1];
          drawChart();
          //console.log(data+nama);
          //updateChart();
          //alert(nama+" + "+nilai);
        }
      }
      xmlhttp.send(params);
      

    // DRAW THE CHART WITH NEW DATA
          
    });
    
//   $('#kalender').datetimepicker({
//     timepicker:false,
//   format:'d.m.Y',
//   inline:false,
//   lang:'id'
// });
});
</script>