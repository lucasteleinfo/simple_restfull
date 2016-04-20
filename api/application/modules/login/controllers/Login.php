<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

class Login extends CI_Controller {
	private $signer;
	private $password;
	private $token;
	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model','model');
		$this->signer = new Sha256();
		$this->password = 'codeigniter';
		$this->token = new Builder();
	}
	public function authenticate() {
		if (!$this->input->post('email')||!$this->input->post('pass')) {
			$result = ['error'=>'Dados incompletos!'];
		} else {
			$email = $this->input->post('email');
			$pass = base64_encode($this->input->post('pass'));

			$user = $this->model->getLogin($email,$pass)->row_array();

			if ($user) {
				$this->token = (new Builder())->setIssuer(base_url()) // Configures the issuer (iss claim)
	                ->setAudience(base_url()) // Configures the audience (aud claim)
	                ->setId(ID_TOKEN_JWT, true) // Configures the id (jti claim), replicating as a header item
	                ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
	                ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
	                ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
	                ->set('id', $user['id'])
	    			->set('email', $user['email'])
	    			->set('name', $user['nam'])
	    			->sign($this->signer, $this->password) // creates a signature using "testing" as key
	                ->getToken(); // Retrieves the generated token

                $result = [
                	'token'=>(String)$this->token,
                	'user'=>$user
            	];
			} else {
				$result = ['error'=>'Usuário inexistente!'];
			}
		}

        $conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	public function signup(){
		if (!$this->input->post('name')||!$this->input->post('email')||!$this->input->post('pass')) {
			$result = ['error'=>'Dados incompletos!'];
		} else {
			$dados = [
				'ad_use_name'=>$this->input->post('name'),
				'ad_use_email'=>$this->input->post('email'),
				'ad_use_pass'=>base64_encode($this->input->post('pass')),
				'ad_use_dcre'=>date('Y-m-d H:i:s'),
				'ad_use_dup'=>date('Y-m-d H:i:s')
			];

			if ($this->model->do_insert($dados)) {
				$result = [
					'success'=>'Cadastrado com sucesso!'
				];
			} else {
				$result = [
					'error'=>'Erro ao Cadastrar!'
				];
			}
		}
		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
	public function returnuser(){
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
				$user = $this->model->getVerifyToken($token->getClaim('id'),$token->getClaim('email'));
				if ($user) {
					$user = $user->row_array();
					$result = [
						'token'=>(String)$token,
						'user'=>[
							'id'=>$user['id'],
							'email'=>$user['email'],
						]
					];
				} else {
					$result = [
						'error'=>'Usuário inválido!'
					];
				}
			}
		}

		$conf = array(
            'result'=>json_encode($result)
        );
		$this->load->view('v_index',$conf);
	}
}