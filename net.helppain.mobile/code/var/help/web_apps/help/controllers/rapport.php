<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mRapport extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('mobile');
    }

	public function index()
	{
	    $data = array('top'=>true);
		$this->load->view('rapport/home',$data);
	}
}