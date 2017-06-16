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
        <li class="active"><a>Home</a></li>
        <li><a href="daftar-berita">Berita</a></li>
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
        <li class="active"><a>Home</a></li>
        <li><a href="daftar-berita">Berita</a></li>
        <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
      <br>
    </div>

    <div class="col-sm-9 konten">
      <div class="row">
        <div class="col-sm-12">
          <div>
            <h3 class="text-center">Selamat Datang di RRI News Management.</h3>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="col-sm-7 text-center">
              <a href="<?php echo site_url('redaksi/daftar-berita') ?>">
              <div class="well" style="background-color:#3cd641;color:#fff">
                <span class="glyphicon glyphicon-file" style="font-size: 50px;"><?php echo $jml_berita_baru ?></span>
                <h3 style="text-decoration:none">BERITA BARU</h3>
              </div>
              </a>
              <a href="<?php echo site_url('redaksi/daftar-berita') ?>">
              <div class="well" style="background-color:#d63c3c;color:#fff">
                <span class="glyphicon glyphicon-file" style="font-size: 50px;"><?php echo $jml_berita_revisi ?></span>
                <h3 style="text-decoration:none">BERITA REVISI</h3>
              </div>
              </a>
            </div>
            <div class="col-sm-4"><input type="text" id="kalender" value="<?php echo date('d.m.Y') ?>"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#kalender').datetimepicker({
    timepicker:false,
  format:'d.m.Y',
  inline:true,
  lang:'id'
});
});
</script>