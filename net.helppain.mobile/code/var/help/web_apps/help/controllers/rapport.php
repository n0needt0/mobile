<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapport extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('rapport');
      $this->load->model('rapport_model');
    }

	public function index($ptracid='123', $print='')
	{
	    $data = array('top'=>true);
	    $data['data'] = $this->rapport_model->get_data($ptracid);

	    if($print == 'print')
	    {
	        $this->load->view('rapport/rapport_print',$data);
	    }
	      else
	    {
	        $this->load->view('rapport/rapport_home',$data);
	    }
	}
}