<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msurvey extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('mobile');
      $this->load->model('survey_model');
    }

	public function index($pin="",$pkey="welcome01")
	{

	  $data = array();
	  $data['pin'] = urldecode($pin);
	  $data['pkey'] = urldecode($pkey);

	  if(empty($data['pin']) )
	  {
  	      //try session
  	      $data['pin'] = $this->session->userdata('pin');
	  }

	  if(empty($data['pin']) || empty($data['pkey']))
	  {
	      //still empty
	      die("Invalid request");
	  }

	  $this->session->set_userdata('pin', $data['pin']);

	  $data['surveys'] = $this->survey_model->get_surveys($pin, $pkey);

	  $data['html_title'] = 'Survey';
	  $this->load->view('mobile/msurvey',$data);
	}
}