  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Jurnal Umum</a>
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
                  <h3 class="mb-0">Jurnal Umum</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Ref</th>
                    <th scope="col">Debet</th>
                    <th scope="col">Kredit</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    foreach($jurnals as $row):
                      if($row->jenis_saldo=='debit'):
                  ?>
                  <tr>
                    <td>
                      <?= date_indo($row->tgl_transaksi) ?>
                    </td>
                    <td>
                    <?= $row->nama_reff ?>
                    </td>
                    <td>
                    <?= $row->no_reff ?>
                    </td>
                    <td>
                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                    </td>
                    <td>
                      Rp. 0
                    </td>
                    <td class="d-flex justify-content-center">
                      <?= form_open('jurnal_umum/edit_form','',['id'=>$row->id_transaksi]) ?>
                      <?= form_button(['type'=>'submit','content'=>'Edit','class'=>'btn btn-warning mr-3']) ?>
                      <?= form_close() ?>

                      <?= form_open('jurnal_umum/hapus',['class'=>'form'],['id'=>$row->id_transaksi]) ?>
                      <?= form_button(['type'=>'submit','content'=>'Hapus','class'=>'btn btn-danger hapus']) ?>
                      <?= form_close() ?>
                    </td>       
                  </tr>
                  <?php 
                    endif;
                    if($row->jenis_saldo=='kredit'):
                  ?>
                  <tr>
                    <td><?= date_indo($row->tgl_transaksi) ?></td>
                    <td class="text-right"><?= $row->nama_reff ?></td>
                    <td><?= $row->no_reff ?></td>
                    <td>
                      Rp. 0
                    </td>
                    <td>
                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                    </td>
                    <td class="d-flex justify-content-center">
                      <?= form_open('jurnal_umum/edit_form','',['id'=>$row->id_transaksi]) ?>
                      <?= form_button(['type'=>'submit','content'=>'Edit','class'=>'btn btn-warning mr-3']) ?>
                      <?= form_close() ?>

                      <?= form_open('jurnal_umum/hapus',['class'=>'form'],['id'=>$row->id_transaksi]) ?>
                      <?= form_button(['type'=>'submit','content'=>'Hapus','class'=>'btn btn-danger hapus']) ?>
                      <?= form_close() ?>
                    </td>       
                  </tr>  
                  <?php endif;?>
                  <?php endforeach ?>
                  <?php if($totalDebit->saldo != $totalKredit->saldo){ ?>
                  <tr>
                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                    <td class="text-danger"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                    <td colspan="2" class="text-danger"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                  </tr>
                  <tr  class="text-center bg-danger ">
                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                  </tr>
                  <?php }else{  ?>
                    <tr>
                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                    <td class="text-success"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                    <td colspan="2" class="text-success"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                  </tr>
                  <tr class="text-center bg-success">
                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>