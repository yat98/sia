<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_model extends CI_Model{
    private $table = 'transaksi';

    public function getJurnal(){
        return $this->db->get($this->table)->result();
    }

    public function getJurnalById($id){
        return $this->db->where('id_transaksi',$id)->get($this->table)->row();
    }

    public function countJurnalNoReff($noReff){
        return $this->db->where('no_reff',$noReff)->get($this->table)->num_rows();
    }

    public function getJurnalByYear(){
        return $this->db->select('tgl_transaksi')
                        ->from($this->table)
                        ->group_by('year(tgl_transaksi)')
                        ->get()
                        ->result();
    }

    public function getJurnalByYearAndMonth(){
        return $this->db->select('tgl_transaksi')
                        ->from($this->table)
                        ->group_by('month(tgl_transaksi)')
                        ->group_by('year(tgl_transaksi)')
                        ->get()
                        ->result();
    }

    public function getAkunInJurnal(){
        return $this->db->select('transaksi.no_reff,akun.no_reff,akun.nama_reff')
                    ->from($this->table)            
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('akun.no_reff','ASC')
                    ->group_by('akun.nama_reff')
                    ->get()
                    ->result();
    }

    public function countAkunInJurnal(){
        return $this->db->select('transaksi.no_reff,akun.no_reff,akun.nama_reff')
                    ->from($this->table)            
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('akun.no_reff','ASC')
                    ->group_by('akun.nama_reff')
                    ->get()
                    ->num_rows();
    }

    public function getJurnalByNoReff($noReff){
        return $this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,akun.nama_reff,transaksi.no_reff,transaksi.jenis_saldo,transaksi.saldo,transaksi.tgl_input')
                    ->from($this->table)            
                    ->where('transaksi.no_reff',$noReff)
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('tgl_transaksi','ASC')
                    ->get()
                    ->result();
    }

    public function getJurnalByNoReffMonthYear($noReff,$bulan,$tahun){
        return $this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,akun.nama_reff,transaksi.no_reff,transaksi.jenis_saldo,transaksi.saldo,transaksi.tgl_input')
                    ->from($this->table)            
                    ->where('transaksi.no_reff',$noReff)
                    ->where('month(transaksi.tgl_transaksi)',$bulan)
                    ->where('year(transaksi.tgl_transaksi)',$tahun)
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('tgl_transaksi','ASC')
                    ->get()
                    ->result();
    }

    public function getJurnalByNoReffSaldo($noReff){
        return $this->db->select('transaksi.jenis_saldo,transaksi.saldo')
                    ->from($this->table)            
                    ->where('transaksi.no_reff',$noReff)
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('tgl_transaksi','ASC')
                    ->get()
                    ->result();
    }

    public function getJurnalByNoReffSaldoMonthYear($noReff,$bulan,$tahun){
        return $this->db->select('transaksi.jenis_saldo,transaksi.saldo')
                    ->from($this->table)            
                    ->where('transaksi.no_reff',$noReff)
                    ->where('month(transaksi.tgl_transaksi)',$bulan)
                    ->where('year(transaksi.tgl_transaksi)',$tahun)
                    ->join('akun','transaksi.no_reff = akun.no_reff')
                    ->order_by('tgl_transaksi','ASC')
                    ->get()
                    ->result();
    }

    public function getJurnalJoinAkun(){
        return $this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,akun.nama_reff,transaksi.no_reff,transaksi.jenis_saldo,transaksi.saldo,transaksi.tgl_input')
                        ->from($this->table)
                        ->join('akun','transaksi.no_reff = akun.no_reff')
                        ->order_by('tgl_transaksi','ASC')
                        ->order_by('tgl_input','ASC')
                        ->order_by('jenis_saldo','ASC')
                        ->get()
                        ->result();
    }

    public function getJurnalJoinAkunDetail($bulan,$tahun){
        return $this->db->select('transaksi.id_transaksi,transaksi.tgl_transaksi,akun.nama_reff,transaksi.no_reff,transaksi.jenis_saldo,transaksi.saldo,transaksi.tgl_input')
                        ->from($this->table)
                        ->where('month(transaksi.tgl_transaksi)',$bulan)
                        ->where('year(transaksi.tgl_transaksi)',$tahun)
                        ->join('akun','transaksi.no_reff = akun.no_reff')
                        ->order_by('tgl_transaksi','ASC')
                        ->order_by('tgl_input','ASC')
                        ->order_by('jenis_saldo','ASC')
                        ->get()
                        ->result();
    }

    public function getTotalSaldoDetail($jenis_saldo,$bulan,$tahun){
        return $this->db->select_sum('saldo')
                        ->from($this->table)
                        ->where('month(transaksi.tgl_transaksi)',$bulan)
                        ->where('year(transaksi.tgl_transaksi)',$tahun)
                        ->where('jenis_saldo',$jenis_saldo)
                        ->get()
                        ->row();
    }

    public function getTotalSaldo($jenis_saldo){
        return $this->db->select_sum('saldo')
                        ->from($this->table)
                        ->where('jenis_saldo',$jenis_saldo)
                        ->get()
                        ->row();
    }

    public function insertJurnal($data){
        return $this->db->insert($this->table,$data);
    }

    public function updateJurnal($id,$data){
        return $this->db->where('id_transaksi',$id)->update($this->table,$data);
    }

    public function deleteJurnal($id){
        return $this->db->where('id_transaksi',$id)->delete($this->table);
    }

    public function getDefaultValues(){
        return [
            'tgl_transaksi'=>date('Y-m-d'),
            'no_reff'=>'',
            'jenis_saldo'=>'',
            'saldo'=>'',
        ];
    }

    public function getValidationRules(){
        return [
            [
                'field'=>'tgl_transaksi',
                'label'=>'Tanggal Transaksi',
                'rules'=>'trim|required'
            ],
            [
                'field'=>'no_reff',
                'label'=>'Nama Akun',
                'rules'=>'trim|required'
            ],
            [
                'field'=>'jenis_saldo',
                'label'=>'Jenis Saldo',
                'rules'=>'trim|required'
            ],
            [
                'field'=>'saldo',
                'label'=>'Saldo',
                'rules'=>'trim|required|numeric'
            ],
        ];
    }

    public function validate(){
        $rules = $this->getValidationRules();
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<span class="text-danger" style="font-size:14px">','</span>');
        return $this->form_validation->run();
    }
}