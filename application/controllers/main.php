<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'facebook/facebook.php';

class Main extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		// admin --> facebook user id : 
		$this->admin = '';
		
		$this->facebook = new Facebook(array(
		  'appId'  => '',
		  'secret' => '',
		));
		
		$this->user = $this->facebook->getUser();
		if ($this->user) {
		  try {
			$this->user_profile = $this->facebook->api('/me');
		  } catch (FacebookApiException $e) {
			error_log($e);
			$this->user = null;
		  }
		}

		$this->load->database();
		$this->load->library(array('session','pagination'));
		$this->load->helper(array('url'));	
		$this->load->model(array('main_model'));
		$this->config->set_item('theme', 'marketing');
	}
	
	public function index(){
		$this->home();
	}
	
	public function home(){
		$this->load->view( $this->config->item('theme') . '/header_view');
		$this->load->view( $this->config->item('theme') . '/home_view');
		$this->load->view( $this->config->item('theme') . '/footer_view');
	}
	
	public function login(){
		if( $this->user ){
		  $logoutUrl = $this->facebook->getLogoutUrl();
		  redirect('main');
		}else{
		  $loginUrl = $this->facebook->getLoginUrl(array('scope' => 'publish_stream'));
		  echo "<script>window.location.href='$loginUrl'</script>";
		  exit(0);
		}
	}
	
	public function logout(){
		$this->facebook->DestroySession();
		setcookie('fbsr_'.$this->facebook->getAppId(), '', time()-3600);
		redirect('main');
	}
	
	public function lists(){
		$config = array();
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';				
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
        $config["base_url"] = base_url() . "main/lists";
        $config["total_rows"] = $this->main_model->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config["num_links"] = 5; //round( $config["total_rows"] / $config["per_page"] );
        $this->pagination->initialize($config);
		
		$page = $this->uri->segment(3, 0);
		$data['reminds'] = $this->main_model->getRemind('', $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

		$this->load->view( $this->config->item('theme') . '/header_view');
		$this->load->view( $this->config->item('theme') . '/lists_view', $data);
		$this->load->view( $this->config->item('theme') . '/footer_view');
	}
	
	public function addnew(){		
		$this->load->view( $this->config->item('theme') . '/header_view');
		$this->load->view( $this->config->item('theme') . '/addnew_view');
		$this->load->view( $this->config->item('theme') . '/footer_view');
	}
	
	public function edit( $id = '' ){
		if( $id ){
			$data['remind'] = $this->main_model->getRemind( $id );
			
			$this->load->view( $this->config->item('theme') . '/header_view');
			$this->load->view( $this->config->item('theme') . '/edit_view', $data);
			$this->load->view( $this->config->item('theme') . '/footer_view');
		}
	}
	
	public function save(){
		$id = $this->input->post('id');
		$refer = $this->input->post('refer');
		
		$data = array(
			'title' => $this->input->post('title'),
			'link' => $this->input->post('link'),
			'content' => $this->input->post('content')
		);
			
		if( $id ){
			$this->main_model->updateRemind($data, $id);
		}else{	
			$this->main_model->saveRemind($data);
		}
		
		redirect( $refer );
	}
	
	public function del( $id = '' ){
		if( $id ){
			$this->main_model->deleteRemind($id);
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}
	
	public function postfeed(){
		$this->config->set_item('theme', 'marketing');
		
		if( isset($_POST['content']) ){
			$title = $_POST['title'];
			$content = $_POST['content'];
			$link = $_POST['link'];
			
			$post_id = $this->facebook->api('/me/feed/', 'POST', array(
				'caption' => $title,
				'message' => $content,
				'link' => $link,
				'name' => $title
			));
			
			$data['post_id'] = $post_id;			
			$this->load->view( $this->config->item('theme') . '/header_view');
			$this->load->view( $this->config->item('theme') . '/content_view', $data);
			$this->load->view( $this->config->item('theme') . '/footer_view');
		}else{
			redirect('main');
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */