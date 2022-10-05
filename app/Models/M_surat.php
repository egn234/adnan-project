<?php 

namespace App\Models;

use CodeIgniter\Model;

class m_surat extends Model
{
    protected $table      = 'tb_surat';
    protected $primaryKey = 'idsurat';

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

    function getAllSUrat()
    {
    	$sql = "
    		SELECT 
    			tb_surat.*,
	    		tb_kategori.idkategori AS idkategori,
	    		tb_kategori.nama_kategori AS nama_kategori,
	    		tb_kategori.keterangan AS keterangan,
	    		tb_kategori.flag AS kategori_flag
	    	FROM tb_surat
	    	JOIN tb_kategori 
	    		USING(idkategori)
	    	ORDER BY tb_surat.tanggal_upload DESC
    	";

    	return $this->db->query($sql)->getResult();
    }

    function getSuratByIdUser($iduser)
    {
    	$sql = "
    		SELECT 
    			tb_surat.*,
	    		tb_kategori.idkategori AS idkategori,
	    		tb_kategori.nama_kategori AS nama_kategori,
	    		tb_kategori.keterangan AS keterangan,
	    		tb_kategori.flag AS kategori_flag
	    	FROM tb_surat
	    	JOIN tb_kategori 
	    		USING(idkategori)
	    	WHERE iduser_dosen = $iduser
	    	ORDER BY tb_surat.tanggal_upload DESC
    	";

    	return $this->db->query($sql)->getResult();
    }

    function insertSurat($data)
    {
      $builder = $this->db->table('tb_surat');
      $builder->insert($data);
    }
}