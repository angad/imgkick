<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

/**
 *	@author angad
 */


class Img extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}
	
	public function index()
	{
		$this->load->view('upload');
	}
	
	public function data()
	{
		$text = $this->input->post('');
	}
	
	public function upload()
	{
		$n = rand(10e16, 10e20);
		$file_name =  base_convert($n, 10, 36);

				//upload configuration
		$config['file_name'] = $file_name;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';	//Max 1MB
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload("raw"))
		{
			
			//load the main view again
			
		}

		$file_data = $this->upload->data();
		$full_path = $file_data['full_path'];
		$file_path = $file_data['file_path'];
		$raw_name = $file_data['raw_name'];
		$file_ext = $file_data['file_ext'];
	}
	
}

?>