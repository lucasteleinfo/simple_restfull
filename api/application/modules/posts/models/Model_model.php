<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Model_model extends CI_Model {
	
	public function do_insert($dados = NULL) {
		if ($dados != NULL) {
			$this->db->insert ( 'tb_adm_posts', $dados );
            return true;
		} else {
            return false;
        }
	}

	public function do_update($dados = NULL, $condicao = NULL) {
		if ($dados != NULL && $condicao != NULL) {
			$this->db->update ( 'tb_adm_posts', $dados, $condicao );
			return true;
		} else {
            return false;
        }
	}

	public function do_delete($condicao=NULL){
		if ($condicao!=NULL){
			$this->db->delete('tb_adm_posts', $condicao);
			return true;
		} else {
            return false;
        }
	}
	
	public function get_all($iduser) {
		$sql = 'SELECT ad_pos_id AS id,
		    ad_pos_des AS des,
		    ad_pos_inf AS inf,
		    ad_pos_iduser AS iduser,
		    ad_pos_dcre AS dcre,
		    ad_pos_dup AS dup,
		    ad_use_name AS nam
		FROM tb_adm_posts
		INNER JOIN tb_adm_users ON ad_pos_iduser = ad_use_id
		WHERE ad_pos_iduser = ?
		ORDER BY ad_pos_id desc;';
        
        $cond = array(
            $iduser
        );
        
		return $this->db->query ($sql,$cond);
	}
	
	public function get_byid($id,$iduser) {
			
		$sql = 'SELECT ad_pos_id AS id,
		    ad_pos_des AS des,
		    ad_pos_inf AS inf,
		    ad_pos_iduser AS iduser,
		    ad_pos_dcre AS dcre,
		    ad_pos_dup AS dup,
		    ad_use_name AS nam
		FROM tb_adm_posts
		INNER JOIN tb_adm_users ON ad_pos_iduser = ad_use_id
		WHERE ad_pos_iduser = ?
		AND ad_pos_id = ?;';
        
        $cond = array(
            $iduser,
            $id,
        );
        
		return $this->db->query ($sql,$cond);
	}
}