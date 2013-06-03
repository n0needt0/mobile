<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help_Model extends CI_Model {


  public function submit_ticket(&$data)
  {
      $data['time'] = $data['changetime'] = time() * 1000000;
      $data['owner'] = 'system';
      $data['status'] = 'new';

      try{
          $this->db->insert('ticket', $data);

          if($this->db->affected_rows() > 0)
          {
              $data['body'] =  "<pre><b>where ". $data['type'] . "\n<b>what:</b> " . $data['summary'] . "\n<b>priority</b> " . $data['priority'];
              $data['ticket'] = $this->db->insert_id();
              $data['urgent'] = '<h3>IF URGENT PLEASE CALL ext 5425 !</h3>';
              // Code here after successful insert
              return true; // to the controller
          }

          return false;
      }
      catch(Exception $e)
      {
        utils::log_message('error',  'Exception: ' . $e->getMessage());
        return false;
      }
  }

}