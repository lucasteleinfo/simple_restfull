<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login_model extends CI_Model {
	
	public function do_insert($dados = NULL) {
		if ($dados != NULL) {
			$this->db->insert ( 'tb_adm_users', $dados );
            return true;
		} else {
            return false;
        }
	}

	public function do_update($dados = NULL, $condicao = NULL) {
		if ($dados != NULL && $condicao != NULL) {
			$this->db->update ( 'tb_adm_users', $dados, $condicao );
			return true;
		} else {
            return false;
        }
	}

	public function do_delete($condicao=NULL){
		if ($condicao!=NULL){
			$this->db->delete('tb_adm_users', $condicao);
			return true;
		} else {
            return false;
        }
	}

	public function getLogin($email,$pass){
		$sql = 'SELECT ad_use_id AS id,
		    ad_use_name AS nam,
		    ad_use_email AS email,
		    ad_use_dcre AS dcre,
		    ad_use_dup AS up
		FROM tb_adm_users
		WHERE ad_use_email = ?
		AND ad_use_pass = ?;';
        
        $cond = array(
            $email,
            $pass
        );
		return $this->db->query ($sql,$cond);
	}

	public function getVerifyToken($id,$email){
		$sql = 'SELECT ad_use_id AS id,
		    ad_use_name AS nam,
		    ad_use_email AS email,
		    ad_use_dcre AS dcre,
		    ad_use_dup AS up
		FROM tb_adm_users
		WHERE ad_use_id = ?
		AND ad_use_email = ?;';
        
        $cond = array(
            $id,
            $email
        );
		return $this->db->query ($sql,$cond);
	}
	
	public function get_all() {
		$sql = 'SELECT 
            *
        FROM tb_
        WHERE exp = ?;';
        
        $cond = array(
            $this->session->userdata("exp")
        );
        
		return $this->db->query ($sql,$cond);
	}
	
	public function get_byid($id = NULL) {
		if ($id != NULL) {
			
			$sql = 'SELECT
                *
            FROM tb_
            WHERE exp = ?
            AND id = ?;';
        
        $cond = array(
            $this->session->userdata("exp"),
            $id,
        );
        
		return $this->db->query ($sql,$cond);
		} else {
			return false;
		}
	}
}