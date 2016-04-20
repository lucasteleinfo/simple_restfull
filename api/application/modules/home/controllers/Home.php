<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index() {
        $conf = array(
            'result'=>'API de Exemplo!'
        );
		$this->load->view('v_index',$conf);
	}
}