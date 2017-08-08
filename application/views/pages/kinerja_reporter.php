<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Redaksi</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="<?php echo site_url('reporter/naskah') ?>">Naskah</a></li>
        <li class="active"><a >Kinerja Reporter</a></li>
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
      <span class="menu_item" style="border-bottom: 1px solid #337ab7;"><?php echo $_SESSION['nama_user'] ?></span>
      <span class="menu_item">Anda masuk sebagai</span>
      <h2><?php echo $_SESSION['role'] ?></h2>
      <!--h2><a><?php // echo $_SESSION['sess_namalok'] ?></a></h2-->
      <ul class="nav nav-pills nav-stacked kustom_sidebar">
        <li ><a href="<?php echo site_url('reporter/naskah') ?>">Naskah</a></li>
        <li class="active"><a >Kinerja Reporter</a></li>
        <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
      <br>
    </div>

    <div class="col-sm-9 konten">
      <div class="row">
        <div class="col-sm-12">
          <div class="text-center" style="padding:10px 0 20px 0">
            <h3>Rekapan Kinerja Reporter</h3>
            
          </div>
          <div class="table-responsive">
            <table class="table  table-bordered">
              <thead>
                <tr style="background-color:#bfe2ff">
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Berita Masuk</th>
                  <th>Berita Hot</th>
                  <th>Target Berita Masuk</th>
                </tr>
              </thead>
              <tbody class="isi_tabel">
                <?php $start=1; $total_berita=0; $total_hot=0; $target=66; foreach ($kinerja_reporter as $key) { ?>
                <tr>
                  <td><?php echo $start++; ?></td>
                  <td><?php echo $key->bulan; ?></td>
                  <td><?php echo $key->tahun; ?></td>
                  <td><?php echo $key->jumlah_berita; ?></td>
                  <td><?php echo $key->jumlah_hot_news; ?></td>
                  <td><?php echo $target; ?></td>
                </tr>
                <?php $total_berita = $total_berita + floatval($key->jumlah_berita); $total_hot = $total_hot + floatval($key->jumlah_hot_news); $total_target = $total_target + floatval($target); } ?>
                <tr>
                  <td colspan="3">Total</td>
                  <td><?php echo $total_berita; ?></td>
                  <td><?php echo $total_hot; ?></td>
                  <td><?php echo $total_target; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          
      </div>
    </div>
  </div>
  </div>
</div>
<!-- start modal -->
<div id="modal_notif_revisi" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm modal_custom">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align:center">Notifikasi</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <h1 class="text-center"><?php echo $jml_berita_telah_dicek; ?></h1>
                <h4 class="text-center">BERITA TELAH DICEK</h4>
              </div>
              
              <div class="modal_action">
                <!--button type="submit" class="btn btn-success" name="submit">Simpan</button><span>&nbsp;</span-->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>

              </div>
            </div>
            <!--div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div-->
          </div>
          <!--input type="hidden" name="att01" id="att01" value=""/-->
        </div>
      </div>
<!-- end modal -->
<script>
$(document).ready(function(){
  <?php if ($jml_berita_telah_dicek!=0){
    echo "$('#modal_notif_revisi').modal('show');";   
  }
  ?>
  $('#kalender').datetimepicker({
    timepicker:false,
  format:'d.m.Y',
  inline:true,
  lang:'id'
});
});
</script>