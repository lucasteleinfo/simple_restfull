<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Model_model extends CI_Model {
	
	public function do_insert($dados = NULL) {
		if ($dados != NULL) {
			$this->db->insert ( 'tb_', $dados );
            return true;
		} else {
            return false;
        }
	}

	public function do_update($dados = NULL, $condicao = NULL) {
		if ($dados != NULL && $condicao != NULL) {
			$this->db->update ( 'tb_', $dados, $condicao );
			return true;
		} else {
            return false;
        }
	}

	public function do_delete($condicao=NULL){
		if ($condicao!=NULL){
			$this->db->delete('tb_', $condicao);
			return true;
		} else {
            return false;
        }
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