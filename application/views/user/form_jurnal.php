  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Jurnal Umum</a>
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
                  <h3 class="mb-3"><?= $title ?> Jurnal Umum</h3>
                </div>
                <div class="col-12 my-3 form-1">
                  <form action="<?= base_url($action) ?>" method="post">
                  <?php 
                    if(!empty($id)):
                  ?>
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <?php endif; ?>
                  <div class="row mb-4">
                    <div class="col-4">
                        <label for="datepicker">Tanggal</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control" id="datepicker" name="tgl_transaksi" type="text" value="<?= $data->tgl_transaksi ?>">
                        </div>
                        <?= form_error('tgl_transaksi') ?>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                        <label for="no_reff">Nama Akun</label>
                        <?=form_dropdown('no_reff',getDropdownList('akun',['no_reff','nama_reff']),$data->no_reff,['class'=>'form-control','id'=>'no_reff']);?>
                        <?= form_error('no_reff') ?>
                    </div>
                    <div class="col">
                        <label for="reff">No. Reff</label>
                        <input type="text" name="reff" class="form-control" id="reff" readonly>
                    </div>
                    <div class="col">
                        <label for="jenis_saldo">Jenis Saldo</label>
                        <?=form_dropdown('jenis_saldo',['debit'=>'Debit','kredit'=>'Kredit'],$data->jenis_saldo,['class'=>'form-control jenis_saldo','id'=>'jenis_saldo']);?>
                        <?= form_error('jenis_saldo') ?>
                    </div>
                    <div class="col">
                        <label for="saldo">Saldo</label>
                        <input type="text" name="saldo" class="form-control saldo" id="saldo" value="<?= $data->saldo ?>">
                        <?= form_error('saldo') ?>
                    </div>
                  </div>
                  <div class="col-12" id="form_jurnal_prepend">
                    <button class="btn btn-primary" type="submit" id="button_jurnal"><?= $title ?></button>
                  </div> 
                  </form> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      