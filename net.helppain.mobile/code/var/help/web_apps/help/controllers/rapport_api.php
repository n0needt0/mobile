<?php
require APPPATH.'/libraries/REST_Controller.php';

/*this class wraps api to promis*/
Class rapport_api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rapport_model');

        $jsonp = $this->get('callback');

        if(!empty($jsonp))
        {
            $this->response->format = 'jsonp';
        }
          else
        {
            $this->response->format = 'json';
        }

        $this->raw = $this->get("raw");
    }

    public function response($data)
    {
        if(!empty($this->raw))
        {
            print_r($data);
            die;
        }
          else
        {
            parent::response($data);
        }
    }

    public function index()
    {
        die;
    }

    public function key_data_get($ptracid=0, $key=false)
    {
         $res =  $this->rapport_model->get_data($ptracid, $key);

         $this->response($res);
         die;
    }

    public function key_data_post()
    {
    	$ptracid = $this->post('ptracid');
        $key = $this->post('key');
        $value = $this->post('value');

        if( $ptracid == false || $key == false)
        {
            $res = array('success' =>'false');
        }
          else
        {
            $res =  $this->rapport_model->set_data($ptracid, $key, $value);
        }

        $this->response($res);
        die;
    }

    public function key_data_put()
    {
        $this->key_data_post();
    }
}