<?Php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageManager extends CI_Controller {
	public function view($page = 'MainPage'){
		global $Auth;
		if (!file_exists(APPPATH.'views/MainPage/'.$page.'.php')){
			show_404();
		}
		$data['Auth'] = $Auth;
		$data['title'] = ucfirst($page);
		$this->load->view('MainPage/'.$page, $data);
	}
	public function getpage($page = 'home'){
		global $Auth;
		if (!file_exists(APPPATH.'views/MainPage/'.$page.'.php')){
			show_404();
		}
		if($Auth){
			
		}else{
			$data['Auth'] = $Auth;
			$data['title'] = ucfirst($page);
			$this->load->view('MainPage/'.$page, $data);
		}

	}
}