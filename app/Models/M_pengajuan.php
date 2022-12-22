<?php

namespace App\Models;

use CodeIgniter\Model;

class m_pengajuan extends Model
{
    protected $table      = 'tb_pengajuan';
    protected $primaryKey = 'idpengajuan';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function __construct()
    {
    	$this->db = db_connect();
    }

    function getAllPengajuan()
    {
    	$sql = "SELECT * FROM tb_pengajuan";
    	return $this->db->query($sql)->getResult();
    }

    function getAllActiveRuangan()
    {
        $sql = "SELECT * FROM tb_ruangan WHERE flag = 1";
        return $this->db->query($sql)->getResult();
    }

    function getRuanganById($idruangan)
    {
        $sql = "SELECT * FROM tb_ruangan WHERE idruangan = $idruangan";
        return $this->db->query($sql)->getResult();
    }

    function insertRuangan($data)
    {
        $builder = $this->db->table('tb_ruangan');
        $builder->insert($data);
    }

    function updateRuangan($idruangan, $data)
    {
        $builder = $this->db->table('tb_ruangan');
        $builder->where('idruangan', $idruangan);
        $builder->update($data);
    }

    function aktifkanRuangan($idruangan)
    {
        $builder = $this->db->table('tb_ruangan');
        $builder->set('flag', 1);
        $builder->where('idruangan', $idruangan);
        $builder->update();
    }

    function nonaktifkanRuangan($idruangan)
    {
        $builder = $this->db->table('tb_ruangan');
        $builder->set('flag', 0);
        $builder->where('idruangan', $idruangan);
        $builder->update();
    }
    
    //Bagian riwayat ruangan
    
    function getAllPinjamanRuangan()
    {
    	$sql = "SELECT 
    	        tb_riwayat_pinjaman_ruangan.flag as flags,iduser,nama_lengkap,
    	        nama_ruangan,jabatan, tanggal_peminjaman, jam_mulai_peminjaman, jam_selesai_peminjaman, keterangan, idriwayat_pinjaman,idruangan FROM tb_riwayat_pinjaman_ruangan JOIN tb_ruangan USING(idruangan) JOIN tb_user USING(iduser) WHERE YEAR(tanggal_peminjaman) >= YEAR(CURDATE()) AND MONTH(tanggal_peminjaman) >= MONTH(CURDATE()) AND DATE(tanggal_peminjaman) >= DATE(CURDATE())";
    	return $this->db->query($sql)->getResult();
    }
    
    function getAllPinjamanDosen($id)
    {
    	$sql = "SELECT 
    	        tb_riwayat_pinjaman_ruangan.flag as flags,iduser,nama_lengkap,
    	        nama_ruangan,jabatan, tanggal_peminjaman, jam_mulai_peminjaman, jam_selesai_peminjaman, keterangan, idriwayat_pinjaman,idruangan FROM tb_riwayat_pinjaman_ruangan JOIN tb_ruangan USING(idruangan) JOIN tb_user USING(iduser) WHERE YEAR(tanggal_peminjaman) >= YEAR(CURDATE()) AND MONTH(tanggal_peminjaman) >= MONTH(CURDATE()) AND DATE(tanggal_peminjaman) >= DATE(CURDATE()) AND iduser = $id";
    	return $this->db->query($sql)->getResult();
    }
    
    function getAllRiwayatRuangan()
    {
    	$sql = "SELECT 
    	        tb_riwayat_pinjaman_ruangan.flag as flags,iduser,nama_lengkap,
    	        nama_ruangan,jabatan, tanggal_peminjaman, jam_mulai_peminjaman, jam_selesai_peminjaman, keterangan, idriwayat_pinjaman,idruangan FROM tb_riwayat_pinjaman_ruangan JOIN tb_ruangan USING(idruangan) JOIN tb_user USING(iduser) WHERE YEAR(tanggal_peminjaman) < YEAR(CURDATE()) OR MONTH(tanggal_peminjaman) < MONTH(CURDATE()) OR DATE(tanggal_peminjaman) < DATE(CURDATE())";
    	return $this->db->query($sql)->getResult();
    }
    
    function getAllRiwayatPinjamanDosen($id)
    {
    	$sql = "SELECT 
    	        tb_riwayat_pinjaman_ruangan.flag as flags,iduser,nama_lengkap,
    	        nama_ruangan,jabatan, tanggal_peminjaman, jam_mulai_peminjaman, jam_selesai_peminjaman, keterangan, idriwayat_pinjaman,idruangan FROM tb_riwayat_pinjaman_ruangan JOIN tb_ruangan USING(idruangan) JOIN tb_user USING(iduser) WHERE iduser = $id AND YEAR(tanggal_peminjaman) < YEAR(CURDATE()) OR MONTH(tanggal_peminjaman) < MONTH(CURDATE()) OR DATE(tanggal_peminjaman) < DATE(CURDATE())";
    	return $this->db->query($sql)->getResult();
    }
    
    function getAllPinjamanRuanganEksisting()
    {
    	$sql = "SELECT 
    	        tb_riwayat_pinjaman_ruangan.flag as flags,iduser,nama_lengkap,
    	        nama_ruangan,jabatan, tanggal_peminjaman, jam_mulai_peminjaman, jam_selesai_peminjaman, keterangan, idriwayat_pinjaman,idruangan FROM tb_riwayat_pinjaman_ruangan JOIN tb_ruangan USING(idruangan) JOIN tb_user USING(iduser) WHERE YEAR(tanggal_peminjaman) >= YEAR(CURDATE()) AND MONTH(tanggal_peminjaman) >= MONTH(CURDATE()) AND DATE(tanggal_peminjaman) >= DATE(CURDATE()) AND tb_riwayat_pinjaman_ruangan.flag != 2 ORDER BY tanggal_peminjaman ASC";
    	return $this->db->query($sql)->getResult();
    }
    
    function getTotalPinjamanDosen($id)
    {
    	$sql = "SELECT COUNT(idriwayat_pinjaman) as jumlah FROM tb_riwayat_pinjaman_ruangan WHERE iduser = $id";
    	return $this->db->query($sql)->getRow();
    }
    
    function getPendingPinjamanDosen($id)
    {
    	$sql = "SELECT COUNT(idriwayat_pinjaman) as jumlah FROM tb_riwayat_pinjaman_ruangan WHERE iduser = $id AND flag = 0";
    	return $this->db->query($sql)->getRow();
    }
    
    function getApprovalPinjamanDosen($id)
    {
    	$sql = "SELECT COUNT(idriwayat_pinjaman) as jumlah FROM tb_riwayat_pinjaman_ruangan WHERE iduser = $id AND flag = 1";
    	return $this->db->query($sql)->getRow();
    }
    
    function getDeclinePinjamanDosen($id)
    {
    	$sql = "SELECT COUNT(idriwayat_pinjaman) as jumlah FROM tb_riwayat_pinjaman_ruangan WHERE iduser = $id AND flag = 2";
    	return $this->db->query($sql)->getRow();
    }
    
    function insertPeminjaman($data)
    {
        $builder = $this->db->table('tb_riwayat_pinjaman_ruangan');
        $builder->insert($data);
    }
    
    function getPeminjamanById($idriwayat)
    {
        $sql = "SELECT * FROM tb_riwayat_pinjaman_ruangan WHERE idriwayat_pinjaman = $idriwayat";
        return $this->db->query($sql)->getResult();
    }
    
    function approvalRuangan($idriwayat_pinjaman)
    {
        $builder = $this->db->table('tb_riwayat_pinjaman_ruangan');
        $builder->set('flag', 1);
        $builder->where('idriwayat_pinjaman', $idriwayat_pinjaman);
        $builder->update();
    }
    
    function declineRuangan($idriwayat_pinjaman)
    {
        $builder = $this->db->table('tb_riwayat_pinjaman_ruangan');
        $builder->set('flag', 2);
        $builder->where('idriwayat_pinjaman', $idriwayat_pinjaman);
        $builder->update();
    }
    
    function deletePinjaman($idriwayat_pinjaman)
    {
        $builder = $this->db->table('tb_riwayat_pinjaman_ruangan');
        $builder->where('idriwayat_pinjaman', $idriwayat_pinjaman);
        $builder->delete();
    }

}