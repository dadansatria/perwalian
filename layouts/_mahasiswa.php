
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <div>&nbsp;</div>
        </div>
        <div class="pull-left info">
          <p>Mahasiswa</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?= dadan_components::getUrl('mahasiswa/matkul'); ?>"><i class="fa fa-link"></i> <span>Mata Kuliah</span></a></li>
        <li><a href="<?= dadan_components::getUrl('jurusan/index'); ?>"><i class="fa fa-link"></i> <span>Profil Mahasiswa</span></a></li>
        <li class="header">SISTEM</li>
        <li><a href="<?= dadan_components::getUrl('logout'); ?>"><i class="fa fa-link"></i> <span>Logout</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->