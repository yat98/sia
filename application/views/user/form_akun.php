  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Data Akun</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url('assets/img/theme/team-4-800x800.jpg') ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucwords($this->session->userdata('username')) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?= base_url('logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">    
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
               
        </div>
      </div>
      <div class="row mt-5">
        <div class="col mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-3"><?= $title ?> Data Akun</h3>
                </div>
                <div class="col-12 my-3">
                  <form action="<?= base_url($action) ?>" method="post">
                      <div class="form-group">
                        <label for="no_ref">No. Reff</label>
                        <p><?= form_error('no_reff') ?></p>
                        <input type="text" name="no_reff" class="form-control mb-3" id="no_reff" value="<?= $data->no_reff ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama Reff</label>
                        <p><?= form_error('nama_reff') ?></p>
                        <input type="text" name="nama_reff" class="form-control mb-3" id="nama" value="<?= $data->nama_reff ?>">
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <p><?= form_error('keterangan') ?></p>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control mb-3"><?= $data->keterangan ?></textarea>
                      </div>
                      <div class="col-12 mt-4">
                        <button type="submit" class="btn-primary btn" id="button_akun"><?= $title ?></button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>