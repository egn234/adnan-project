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

    function getSuratById($idsurat)
    {
      $sql = "
        SELECT 
          tb_user.username AS username,
          tb_user.nama_lengkap AS nama_lengkap,
          tb_user.nip AS nip,
          tb_surat.*,
          tb_kategori.idkategori AS idkategori,
          tb_kategori.nama_kategori AS nama_kategori,
          tb_kategori.keterangan AS keterangan,
          tb_kategori.flag AS kategori_flag
        FROM tb_surat
        JOIN tb_user
          ON tb_user.iduser = tb_surat.iduser_dosen
        JOIN tb_kategori 
          USING(idkategori)
        WHERE idsurat = $idsurat
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

    function getSuratByReview()
    {
      $sql = "
        SELECT 
          tb_user.nama_lengkap AS nama_lengkap,
          tb_user.nip AS nip,
          tb_surat.*,
          tb_kategori.idkategori AS idkategori,
          tb_kategori.nama_kategori AS nama_kategori,
          tb_kategori.keterangan AS keterangan,
          tb_kategori.flag AS kategori_flag
        FROM tb_surat
        JOIN tb_user
          ON tb_user.iduser = tb_surat.iduser_dosen
        JOIN tb_kategori 
          USING(idkategori)
        WHERE tb_surat.flag = 1
        ORDER BY tb_surat.tanggal_upload DESC
      ";

      return $this->db->query($sql)->getResult();
    }

    function getSuratByAcc()
    {
      $sql = "
        SELECT 
          tb_user.nama_lengkap AS nama_lengkap,
          tb_user.nip AS nip,
          tb_surat.*,
          tb_kategori.idkategori AS idkategori,
          tb_kategori.nama_kategori AS nama_kategori,
          tb_kategori.keterangan AS keterangan,
          tb_kategori.flag AS kategori_flag
        FROM tb_surat
        JOIN tb_user
          ON tb_user.iduser = tb_surat.iduser_dosen
        JOIN tb_kategori 
          USING(idkategori)
        WHERE tb_surat.flag = 2
        ORDER BY tb_surat.tanggal_upload DESC
      ";

      return $this->db->query($sql)->getResult();
    }

    function insertSurat($data)
    {
      $builder = $this->db->table('tb_surat');
      $builder->insert($data);
    }

    function updateSurat($idsurat, $data)
    {
      $builder = $this->db->table('tb_surat');
      $builder->where('idsurat', $idsurat);
      $builder->update($data);
    }

    function setFlagSurat($idsurat, $flag)
    {
      $builder = $this->db->table('tb_surat');
      $builder->set('flag', $flag);
      $builder->where('idsurat', $idsurat);
      $builder->update();
    }
}