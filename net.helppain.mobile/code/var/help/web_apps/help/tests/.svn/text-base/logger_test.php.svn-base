<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoggerTest extends UnitTestCase
{
  public function __construct()
  {
    $this->CI =& get_instance();
    $this->output = false;
    $this->_coverage(__CLASS__, 'logger_model');
  }

  private $node_uuid;

  function setUp()
  {
  }

  function tearDown()
  {
  }

  ///// All functions starting with "test" will be tested /////

  public function test_activity_log()
  {
    $company_id = 1;
    $user_id    = 1;
    $insert_id = $this->CI->logger_model->activity_log("Logger Unittest: parameters", $company_id, $user_id);

    $this->assertTrue( $insert_id > 0 );

    $sql = "SELECT * FROM activity_log WHERE id = $insert_id";
    $query = $this->CI->db->query($sql);
    $row = $query->row_array();

    $this->assertTrue( $row['company_id'] == $company_id );
    $this->assertTrue( $row['user_id'] == $user_id );
  }

  public function test_not_logged_in()
  {
    // if some other test logged in a user, then we can't log out to perform this test
    // because simpletester has already output to browser.
    if ($this->CI->auth_model->is_logged_in())
    {
      return;
    }

    $insert_id = $this->CI->logger_model->activity_log("Logger Unittest: not logged in. (system activity)");

    $this->assertTrue( $insert_id > 0 );

    $sql = "SELECT * FROM activity_log WHERE id = $insert_id";
    $query = $this->CI->db->query($sql);
    $row = $query->row_array();

    $this->assertTrue( $row['company_id'] == 0 );
    $this->assertTrue( $row['user_id'] == 0 );
  }

  /*
  function testSess()
  {
    $this->ci->session->set_userdata(array('test' => 'hello world'));
    $this->assertTrue($this->ci->session->userdata('test'));
  }
  */

  public function test_logged_in()
  {
    // can't peform this test because it modifies session information, and output
    // has already been started by the simpletester.   need to figure that out sometime.
//return;

    //TO DO put in setUP
    $user_id = 1;

    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    $query = $this->CI->db->query($sql);
    $fakeUser = $query->row_array();;

    $this->CI->user_model->set_userdata($fakeUser);
    $this->CI->user_model->login_as_user_id($user_id);

    $insert_id = $this->CI->logger_model->activity_log("Logger Unittest: logged in user");

    $this->assertTrue( $insert_id > 0 );

    $sql = "SELECT * FROM activity_log WHERE id = $insert_id";
    $query = $this->CI->db->query($sql);
    $row = $query->row_array();

    $this->assertTrue( $row['user_id'] == $user_id );
  }
}
