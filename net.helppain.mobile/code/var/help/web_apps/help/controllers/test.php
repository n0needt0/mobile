<?php

class Test extends MY_Controller {

  public function __construct()
  {
    parent::MY_Controller();
    $this->set_template(null);
  }

  public function unit($test_file = false)
  {
    if (UNIT_TESTS_ACTIVE)
    {
        $this->load->library('simpletester');
        $this->simpletester->run_tests($test_file);
    }
    else
    {
        show_error('Unit Tests are currently Disabled');
    }
  }
}
?>