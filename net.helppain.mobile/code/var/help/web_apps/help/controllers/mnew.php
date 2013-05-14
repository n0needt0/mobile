<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mNew extends MY_Controller {

    public function __construct()
    {
      parent::__construct();
      self::set_template('mobile');
      $this->load->model('help_model');
    }

	public function index()
	{
	    //get post variables
	    $data = array();

	    $data['reporter'] = $this->input->post('pin');
	    $data['type'] = $this->input->post('type');
	    $data['summary'] = $this->input->post('textarea');
	    $data['priority'] = $this->input->post('priority');

	    if( $this->help_model->submit_ticket($data))
	    {
	        //process request
	        $data['message'] = 'Success:';

	        $this->load->view('mobile/mnew',$data);
	    }
	      else
	    {
	        //process request
	      $data['message'] = 'Request had failed :(';

	        $this->load->view('mobile/mnew',$data);

	    }
	}
}