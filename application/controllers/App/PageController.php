<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

	public function index($page = 'home'){
		global $Auth;
		if($page == 'login'){
			if($Auth){
				rdr(base_url());
			}
			$data['Auth'] = $Auth;
			$data['base_url'] = base_url();
			$this->load->view('Page/'.ucfirst($page),$data);
		}else{
			if(!$Auth){
				if($Auth){
					rdr(base_url());
				}
			}
			$data['Auth'] = $Auth;
			$data['base_url'] = base_url();
			$this->load->view('Page/'.ucfirst($page),$data);
		}
	}
}
