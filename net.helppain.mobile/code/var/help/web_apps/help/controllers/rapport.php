<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapport extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('rapport');
      $this->load->model('rapport_model');
    }

	public function index($ptracid='98', $print='')
	{
	    $data = array('top'=>true);
	    $data['ptracid'] = $ptracid;
	    $data['data'] = $this->rapport_model->get_data($ptracid);
	    $data['ptrac'] = $this->rapport_model->get_ptrac($ptracid);

	    if($print == 'print')
	    {
	    	self::set_template('blank');
	        $this->load->view('rapport/rapport_home_print',$data);
	    }
	    else
	    {
	        $this->load->view('rapport/rapport_home',$data);
	    }
	}
}