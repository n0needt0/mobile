<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MongoTest extends UnitTestCase
{
  public function __construct()
  {
    $this->CI =& get_instance();
    $this->output = false;
    $this->_coverage(__CLASS__, 'Mongo_db');
    $this->testdb = 'test';
    $this->testcollection = 'testcollection';
  }

  function setUp()
  {

  }

  function tearDown()
  {
  }

  ///// All functions starting with "test" will be tested /////

  function test__connect()
  {
      $this->CI->mongo_db->drop_collection($this->testdb,$this->testcollection);

      $str = md5(time());

      $intakes = array('a'=>$str);


      $this->CI->mongo_db->insert($this->testcollection,$intakes);

      $res = $this->CI->mongo_db->count($this->testcollection);

      $this->assertTrue( 1 == $res );

      $docs = $this->CI->mongo_db->where('a',$str)->limit(1)->get($this->testcollection);
      $this->assertTrue( $docs[0]['a'] == $str );
  }

  function test_date()
  {
      $sec = time();
      $obj = $this->CI->mongo_db->date($sec);
      $this->assertTrue( $obj->sec == $sec );
  }

  function test_switch_db()
  {
      $this->CI->mongo_db->switch_db($this->testdb);
      $res = $this->CI->mongo_db->get_dbname();
      $this->assertTrue( $this->testdb == $res );
  }

  function test_drop_collection()
  {
      $tmpcollection = md5(time());
      $intakes = array('a'=>$tmpcollection);
      $this->CI->mongo_db->insert($tmpcollection,$intakes);

      $docs = $this->CI->mongo_db->where('a',$tmpcollection)->limit(1)->get($tmpcollection);
      $this->assertTrue( $docs[0]['a'] == $tmpcollection );

      $this->CI->mongo_db->drop_collection($this->testdb,$tmpcollection);

      $docs = $this->CI->mongo_db->where('a',$tmpcollection)->limit(1)->get($tmpcollection);
      $this->assertTrue( empty($docs) );
  }

  function test_drop_db()
  {
      $this->CI->mongo_db->switch_db($this->testdb);
      $res = $this->CI->mongo_db->get_dbname();
      $this->assertTrue( $this->testdb == $res );

      $res = $this->CI->mongo_db->drop_db($this->testdb);

      $this->assertTrue( $res['ok'] == 1 );
  }


  /*

TODO test_select
TODO test_where
TODO test_or_where
TODO test_where_in
TODO test_where_in_all
TODO test_where_not_in
TODO test_where_gt
TODO test_where_gte
TODO test_where_lt
TODO test_where_lte
TODO test_where_between
TODO test_where_between_ne
TODO test_where_ne
TODO test_where_near
TODO test_like
TODO test_order_by
TODO test_limit
TODO test_offset
TODO test_get_where
TODO test_get

TODO test_batch_insert
TODO test_update
TODO test_update_all
TODO test_inc
TODO test_dec
TODO test_set
TODO test_unset_field
TODO test_addtoset
TODO test_push
TODO test_pop
TODO test_pull
TODO test_rename_field
TODO test_delete
TODO test_delete_all
TODO test_command
TODO test_add_index
TODO test_remove_index
TODO test_remove_all_indexes
TODO test_list_indexes
TODO test_get_dbref
TODO test_create_dbref
TODO test_last_query

TODO test__connection_string
TODO test__clear
TODO test__where_init
TODO test__update_init
TODO test__show_error
*/


}
