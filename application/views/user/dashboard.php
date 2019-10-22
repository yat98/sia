  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>
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
      </div>
      <div class="row mt-5">
        <div class="col mb-5">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Data Akun</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No.Reff</th>
                    <th scope="col">Nama Reff</th>
                    <th scope="col">Keterangan Reff</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                    foreach($dataAkun as $row): 
                  ?>
                  <tr>
                    <th scope="row">
                      <?= $i++ ?>
                    </th>
                    <td>
                      <?= $row->no_reff ?>
                    </td>
                    <td>
                      <?= $row->nama_reff ?>
                    </td>
                    <td>
                      <?= $row->keterangan ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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
                  </tr>
                </thead>
                <tbody>
                  <?php
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
                  </tr>
                  <?php 
                    endif;
                    if($row->jenis_saldo=='kredit'):
                  ?>
                  <tr>
                    <td>
                      <?= date_indo($row->tgl_transaksi) ?>
                    </td>
                    <td class="text-right"><?= $row->nama_reff ?></td>
                    <td><?= $row->no_reff ?></td>
                    <td>
                      Rp. 0
                    </td>
                    <td>
                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
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
        <div class="col mt-5 p-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Buku Besar</h3>
                </div>
              </div>
            </div>
            <div class="nav-wrapper mx-3">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <?php 
                      $i = 0;
                      foreach($dataAkunTransaksi as $row):
                      $i++;
                    ?>
                    <li class="nav-item mb-4">
                        <a class="nav-link mb-sm-3 mb-md-0 tab-nav" id="tabs-icons-text-<?=$i?>-tab" data-toggle="tab" href="#tabs-icons-text-<?=$i?>" role="tab" aria-controls="tabs-icons-text-<?=$i?>" aria-selected="true"><?= $row->nama_reff ?></a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="card" style="border-top: 2px solid white">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <?php 
                          $a=0;
                          $debit = 0;
                          $kredit = 0;
                          
                          for($i=0;$i<$jumlah;$i++) :                          
                          $a++;
                          $s=0;
                          $deb = $saldo[$i];
                        ?>
                        <div class="tab-pane fade" id="tabs-icons-text-<?= $a ?>" role="tabpanel" aria-labelledby="tabs-icons-text-<?= $a ?>-tab">
                            <div class="row">
                              <div class="col">
                                <b><?= $data[$i][$s]->nama_reff ?></b>
                              </div>
                              <div class="col text-right">
                                <b>No. <?= $data[$i][$s]->no_reff ?></b>
                              </div>
                            </div>
                            <p class="description">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">Keterangan </th>
                                    <th rowspan="2">Debit</th>
                                    <th rowspan="2">Kredit</th>
                                    <th colspan="2" class="text-center">Saldo</th>
                                  </tr>
                                  <tr>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    for($j=0;$j<count($data[$i]);$j++):
                                      $timeStampt = strtotime($data[$i][$j]->tgl_transaksi);
                                      $bulan = date('m',$timeStampt);

                                      $tahun = date('Y',$timeStampt);
                                      $tgl = date('d',$timeStampt);
                                      $bulan = medium_bulan($bulan);
                                  ?>
                                  <tr>
                                      <td><?= $tgl.' '.$bulan.' '.$tahun ?></td>
                                      <td><?= $data[$i][$j]->nama_reff ?></td>
                                      <?php 
                                        if($data[$i][$j]->jenis_saldo=='debit'){
                                      ?>
                                        <td>
                                          <?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?>
                                        </td>
                                        <td>Rp. 0</td>
                                      <?php 
                                        }else{
                                      ?>
                                        <td>Rp. 0</td>
                                        <td>
                                          <?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?>
                                        </td>
                                      <?php } ?>
                                      <?php
                                        if($deb[$j]->jenis_saldo=="debit"){
                                          $debit = $debit + $deb[$j]->saldo;
                                        }else{
                                          $kredit = $kredit + $deb[$j]->saldo;
                                        }
  
                                        $hasil = $debit-$kredit;
                                      ?>
                                      <?php if($hasil>=0){ ?>
                                        <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                        <td> - </td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                        <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                      <?php } ?>
                                  </tr>
                                  <?php endfor ?>
                                  <?php
                                    $debit = 0;
                                    $kredit = 0;
                                  ?>
                                  <td class="text-center" colspan="4"><b>Total</b></td>
                                  <?php if($hasil>=0){ ?>
                                    <td class="text-success"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                    <td> - </td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                    <td class="text-danger"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                  <?php } ?>
                                </tbody>
                              </table>
                        </div>
                        <?php endfor ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col mt-5 p-0">
                  <div class="card shadow">
                    <div class="card-header border-0">
                      <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0">Neraca Saldo</h3>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
            <?php 
                $a=0;
                $debit = 0;
                $kredit = 0;
            ?>
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No. Akun</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Kredit</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $totalDebit=0;
                        $totalKredit=0;
                        for($i=0;$i<$jumlah;$i++) :                          
                            $a++;
                            $s=0;
                            $deb = $saldo[$i];
                    ?>
                    <tr>
                        <td>
                            <?= $data[$i][$s]->no_reff ?>
                        </td>
                        <td>
                            <?= $data[$i][$s]->nama_reff ?>
                        </td>
                        <?php 
                            for($j=0;$j<count($data[$i]);$j++):
                                if($deb[$j]->jenis_saldo=="debit"){
                                    $debit = $debit + $deb[$j]->saldo;
                                }else{
                                    $kredit = $kredit + $deb[$j]->saldo;
                                }
                                $hasil = $debit-$kredit;
                            endfor 
                        ?>
                        <?php 
                            if($hasil>=0){ ?>
                                <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                <td> - </td>
                            <?php $totalDebit += $hasil; ?>
                        <?php }else{ ?>
                                <td> - </td>
                                <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                <?php $totalKredit += $hasil; ?>
                        <?php } ?>
                        <?php
                            $debit = 0;
                            $kredit = 0;
                        ?>
                    </tr>
                    <?php endfor ?>
                    <?php if($totalDebit != abs($totalKredit)){ ?>
                    <tr>
                        <td class="text-center" colspan="2"><b>Total</b></td>
                        <td class="text-danger"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                        <td class="text-danger"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                    </tr>
                    <tr class="bg-danger text-center">
                        <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                    </tr>
                    <?php }else{ ?>
                      <tr>
                        <td class="text-center" colspan="2"><b>Total</b></td>
                        <td class="text-success"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                        <td class="text-success"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                    </tr>
                    <tr class="bg-success text-center">
                        <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
                    </tr>
                    <?php } ?>  
                </tbody>
              </table>
            </div>
    </div>