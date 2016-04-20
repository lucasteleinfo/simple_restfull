<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

class Posts extends CI_Controller {
	private $signer;
	private $password;
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_model','model');
		$this->load->model('login/Login_model','login');
		$this->signer = new Sha256();
		$this->password = 'codeigniter';
	}
	public function create(){
		$user = $this->verifyToken();
		if (!isset($user['error'])) {

			if (!$this->input->post('des')||!$this->input->post('inf')) {
				$result = [
					'error'=>'Dados incompletos! 02',
					'des'=>$this->input->post('des'),
					'inf'=>$this->input->post('inf'),
				];
			} else {
				$dados = [
					'ad_pos_des'=>$this->input->post('des'),
					'ad_pos_inf'=>$this->input->post('inf'),
					'ad_pos_iduser'=>$user['id'],
					'ad_pos_dcre'=>date('Y-m-d H:i:s'),
					'ad_pos_dup'=>date('Y-m-d H:i:s')
				];
				if($this->model->do_insert($dados)) {
					$result = [
						'success'=>'Cadastrado com sucesso!'
					];
				} else {
					$result = [
						'error'=>'Erro ao cadastrar!'
					];
				};
			};
		} else {
			$result = $user;
		}
		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	public function update(){
		$user = $this->verifyToken();
		if (!isset($user['error'])) {
			if (!$this->input->post('id')||!$this->input->post('des')||!$this->input->post('inf')) {
				$result = [
					'error'=>'Dados incompletos!'
				];
			} else {
				$dados = [
					'ad_pos_des'=>$this->input->post('des'),
					'ad_pos_inf'=>$this->input->post('inf'),
					'ad_pos_iduser'=>$user['id'],
					'ad_pos_dup'=>date('Y-m-d H:i:s')
				];
				$cond = [
					'ad_pos_id'=>$this->input->post('id')
				];
				if($this->model->do_update($dados,$cond)) {
					$result = [
						'success'=>'Alterado com sucesso!'
					];
				} else {
					$result = [
						'error'=>'Erro ao cadastrar!'
					];
				};
			};
		} else {
			$result = $user;
		}
		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	public function delete(){
		$user = $this->verifyToken();
		if (!isset($user['error'])) {
			if (!$this->input->post('id')) {
				$result = [
					'error'=>'Dados incompletos!'
				];
			} else {
				$cond = [
					'ad_pos_id'=>$this->input->post('id')
				];
				if($this->model->do_delete($cond)) {
					$result = [
						'success'=>'Deletado com sucesso!'
					];
				} else {
					$result = [
						'error'=>'Erro ao cadastrar!'
					];
				};
			};
		} else {
			$result = $user;
		}
		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	public function getall(){
		$user = $this->verifyToken();

		if (!isset($user['error'])) {
			$result = $this->model->get_all($user['id'])->result_array();
			if ($result==null) {
				$result = [];
			}
		} else {
			$result = $user;
		}

		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	private function verifyToken(){
		if(!$this->input->get_request_header('Authorization')){
			$result = [
				'error'=>'Dados incompletos!'
			];
		} else {
			$token = $this->input->get_request_header('Authorization');

			$token = (new Parser())->parse((string) $token);

			if (!$token->verify($this->signer, $this->password)) {
				$result = [
					'error'=>'Token inválido!'
				];
			} else {
				$user = $this->login->getVerifyToken($token->getClaim('id'),$token->getClaim('email'));
				if ($user) {
					$user = $user->row_array();

					$result = $user;
				} else {
					$result = [
						'error'=>'Usuário inválido!'
					];
				}
			}
		}
		return $result;
	}
}