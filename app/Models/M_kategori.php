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
}