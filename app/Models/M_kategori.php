<?php

namespace App\Models;

use CodeIgniter\Model;

class m_kategori extends Model
{
    protected $table      = 'tb_kategori';
    protected $primaryKey = 'idkategori';

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

    function getAllKategori()
    {
    	$sql = "SELECT * FROM tb_kategori";
    	return $this->db->query($sql)->getResult();
    }

    function getAllActiveKategori()
    {
        $sql = "SELECT * FROM tb_kategori WHERE flag = 1";
        return $this->db->query($sql)->getResult();
    }

    function getKategoriById($idkategori)
    {
        $sql = "SELECT * FROM tb_kategori WHERE idkategori = $idkategori";
        return $this->db->query($sql)->getResult();
    }

    function insertKategori($data)
    {
        $builder = $this->db->table('tb_kategori');
        $builder->insert($data);
    }

    function updateKategori($idkategori, $data)
    {
        $builder = $this->db->table('tb_kategori');
        $builder->where('idkategori', $idkategori);
        $builder->update($data);
    }

    function aktifkanKategori($idkategori)
    {
        $builder = $this->db->table('tb_kategori');
        $builder->set('flag', 1);
        $builder->where('idkategori', $idkategori);
        $builder->update();
    }

    function nonaktifkanKategori($idkategori)
    {
        $builder = $this->db->table('tb_kategori');
        $builder->set('flag', 0);
        $builder->where('idkategori', $idkategori);
        $builder->update();
    }
}