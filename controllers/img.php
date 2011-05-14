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
		
	public function imgproc()
	{
		$img_name = $this->input->post('img_name');
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$text = $this->input->post('text');
		$font = $this->input->post('font');
		$font_size = $this->input->post('font_size');
		$font_color = $this->input->post('font_color');
		
		$config['image_library'] = 'gd2';
		$config['source_image']	= './uploads/' . $img_name;
		$config['wm_text'] = $text;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './fonts/' . $font . '.ttf';
		$config['wm_font_size']	= $font_size;
		$config['wm_font_color'] = $font_color;
		$config['wm_vrt_offset'] = $x;
		$config['wm_hor_offset'] = $y;

		$this->load->library('image_lib');
		$this->image_lib->initialize($config); 
		$this->image_lib->watermark();		
	}
}

?>