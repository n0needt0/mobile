<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapport extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('rapport');
    }

	public function index()
	{
	    $data = array('top'=>true);
		$this->load->view('rapport/rapport_home',$data);
	}
}