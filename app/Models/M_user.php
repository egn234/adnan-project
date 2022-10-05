<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'iduser';

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

    function getAllUser()
    {
    	$sql = "
            SELECT 
                tb_user.*,
                tb_group.keterangan AS group_type,
                tb_group.created AS group_assigned,
                tb_group.flag AS group_flag
            FROM tb_user 
            JOIN tb_group USING (idgroup)
        ";
    	
    	return $this->db->query($sql)->getResult();
    }

    function getUserById($iduser)
    {
    	$sql = "
            SELECT 
				tb_user.*,
                tb_group.keterangan AS group_type,
                tb_group.created AS group_assigned,
                tb_group.flag AS group_flag
            FROM tb_user 
            JOIN tb_group USING (idgroup)
    		WHERE iduser = $iduser
    	";

    	return $this->db->query($sql)->getResult();
    }

    function getUserByUsername($username)
    {
    	$sql = "
            SELECT 
				tb_user.*,
                tb_group.keterangan AS group_type,
                tb_group.created AS group_assigned,
                tb_group.flag AS group_flag
            FROM tb_user 
            JOIN tb_group USING (idgroup)
    		WHERE username = '$username'
    	";

    	return $this->db->query($sql)->getResult();
    }

    function getDetailDosen()
    {
        $sql = "
            SELECT 
                tb_user.*, 
                (
                    SELECT 
                        count(idsurat) 
                    FROM tb_surat 
                    WHERE iduser_dosen = tb_user.iduser
                ) AS jumlah_proposal 
            FROM tb_user
            WHERE tb_user.idgroup = 3
        ";

        return $this->db->query($sql)->getResult();
    }

    function countUserByUsername($username)
    {
    	$sql = "SELECT count(iduser) as hitung FROM tb_user WHERE username = '$username'";
    	return $this->db->query($sql)->getResult();
    }
}