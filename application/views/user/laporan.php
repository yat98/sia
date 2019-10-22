<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titleTag.' Dicetak Oleh '.$this->session->userdata('username') ?></title>
    <style>
        *{
            font-family:sans-serif;
        }
        table{
            width:100%;
        }
        table,th,tr,td{
            border:1px solid black;
            border-collapse:collapse;
            border-spacing:0;
        }
        th,td{
            padding:18px;
        }
        .text-center{
            text-align:center;
        }
        .text-right{
            text-align:right;
        }
        .font-bold{
            font-weight:bold;
        }
        .m-fix{
            margin:15px;
        }
        .mt-fix{
            margin-top:15px;
        }
        .mb-fix{
            margin-bottom:15px;
        }
        hr{
            width:800px;
            margin-bottom:30px;
        }
        .d-flex{
            display:flex;
        }
        .w-100{
            width:100%;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laporan Bulan <?= bulan($bulan) ?>  <?= $tahun ?></h1>
    <hr>
    <h3 class="m-fix text-center">Data Akun</h3>
    <table class="mb-fix">
        <tr class="text-center font-bold">
            <td>No.</td>
            <td>No.Reff</td>
            <td>Nama Akun</td>
            <td>Keterangan</td>
        </tr>
        <?php 
            $i = 1;
            foreach($dataAkun as $row):
        ?>
            <tr class="text-center">
                <td><?= $i++ ?></td>
                <td><?= $row->no_reff ?></td>
                <td><?= $row->nama_reff ?></td>
                <td><?= $row->keterangan ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <h3 class="m-fix text-center" style="margin-top:40px">Jurnal Umum</h3>
    <table class="mb-fix">
        <tr class="text-center font-bold">
            <td>No.</td>
            <td>Tanggal</td>
            <td>Nama Akun</td>
            <td>Reff</td>
            <td>Debit</td>
            <td>Kredit</td>
        </tr>
        <?php
            $i=1;
            foreach($jurnals as $row):
                if($row->jenis_saldo=='debit'):
        ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= date_indo($row->tgl_transaksi) ?></td>
                    <td class="text-left"><?= $row->nama_reff ?></td>
                    <td class="text-center"><?= $row->no_reff ?></td>
                    <td class="text-center"><?= 'Rp. '.number_format($row->saldo,0,',','.') ?></td>
                    <td class="text-center">Rp. 0</td>
                </tr>
        <?php 
                endif;
                if($row->jenis_saldo=='kredit'):
        ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= date_indo($row->tgl_transaksi) ?></td>
                    <td class="text-center"><?= $row->nama_reff ?></td>
                    <td class="text-center"><?= $row->no_reff ?></td>
                    <td class="text-center">Rp. 0</td>
                    <td class="text-center"><?= 'Rp. '.number_format($row->saldo,0,',','.') ?></td>     
                </tr>  
        <?php 
                endif;
            endforeach;
        ?>
        <?php if($totalDebit->saldo != $totalKredit->saldo){ ?>
        <tr>
            <td colspan="4" class="text-center"><b>Jumlah Total</b></td>
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
    </table>

    <h3 class="m-fix text-center" style="margin-top:10px">Buku Besar</h3>
    <?php 
        $a=0;
        $debit = 0;
        $kredit = 0;
        
        for($i=0;$i<$jumlah;$i++) :                          
        $a++;
        $s=0;
        $deb = $saldo[$i];
    ?>
    <div class="d-flex" style="margin-top:20px;">
        <div class="text-left w-100 font-bold"><?= $data[$i][$s]->nama_reff ?></div>
        <div class="text-right w-100 font-bold">No.<?= $data[$i][$s]->no_reff ?></div>
    </div>
    <table class="mb-fix" style="margin-bottom:10px;margin-bottom:10px">
        <tr class="text-center font-bold">
            <td rowspan="2">No.</td>
            <td rowspan="2">Tanggal</td>
            <td rowspan="2">Keterangan </td>
            <td rowspan="2">Debit</td>
            <td rowspan="2">Kredit</td>
            <td colspan="2" class="text-center">Saldo</td>
        </tr>
        <tr class="text-center font-bold">
            <td>Debit</td>
            <td>Kredit</td>
        </tr>
        <?php
            $o=1;
            for($j=0;$j<count($data[$i]);$j++):
                $timeStampt = strtotime($data[$i][$j]->tgl_transaksi);
                $bulan = date('m',$timeStampt);

                $tahun = date('Y',$timeStampt);
                $tgl = date('d',$timeStampt);
                $bulan = medium_bulan($bulan);
        ?>
            <tr class="text-center">
                <td><?= $o++; ?></td>
                <td><?= $tgl.' '.$bulan.' '.$tahun ?></td>
                <td><?= $data[$i][$j]->nama_reff ?></td>
                <?php 
                    if($data[$i][$j]->jenis_saldo=='debit'){
                ?>
                <td><?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?></td>
                <td>Rp. 0</td>
                <?php 
                    }else{
                ?>
                <td>Rp. 0</td>
                <td><?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?></td>
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
            <td class="text-center" colspan="5"><b>Total</b></td>
            <?php if($hasil>=0){ ?>
            <td class="text-center font-bold"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
            <td class="text-center"> - </td>
            <?php }else{ ?>
            <td class="text-center"> - </td>
            <td class="text-center font-bold"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
            <?php } ?>
        
    </table>
    <?php endfor; ?>

        <h3 class="m-fix text-center" style="margin-top:10px">Neraca Saldo</h3>
        <table class="mb-fix">
            <tr class="text-center font-bold">
                <td>No.</td>
                <td>Nama Akun</td>
                <td>Reff</td>
                <td>Debit</td>
                <td>Kredit</td>
            </tr>
            <?php
                $totalDebit=0;
                $totalKredit=0;
                $o=1;                        
                for($i=0;$i<$jumlah;$i++) :  
                    $a++;
                    $s=0;
                    $deb = $saldo[$i];
            ?>
            <tr>
                <td><?= $o++ ?></td>
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
                        <td class="text-success"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                        <td> - </td>
                        <?php $totalDebit += $hasil; ?>
                    <?php }else{ ?>
                        <td> - </td>
                        <td class="text-danger"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
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
                <td class="text-center" colspan="3"><b>Total</b></td>
                <td class="text-danger"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                <td class="text-danger"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
            </tr>
            <tr class="bg-danger text-center">
                <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
            </tr>
            <?php }else{ ?>
                <tr>
                <td class="text-center" colspan="3"><b>Total</b></td>
                <td class="text-success"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                <td class="text-success"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
            </tr>
            <tr class="bg-success text-center">
                <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
            </tr>
            <?php } ?>    
        </table>
        <p class="text-right" style="margin-top:50px;">Dicetak Oleh <?= $this->session->userdata('username') ?> Pada Tanggal 
        <?= date('d').' '.bulan(date('m')).' '.date('Y').' Pukul '.date('H:i:s').' WITA'?></p>
</body>
</html>