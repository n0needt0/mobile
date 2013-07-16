<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapport_Model extends CI_Model {

 public function __construct()
  {
    parent::__construct();
    $this->dashboard = $this->load->database('dashboard', true);
  }


  public function get_data($ptracid, $key = false)
  {

      $result = array();

      $sql = "SELECT * FROM rapport WHERE ptrac='$ptracid'";

      if(false !== $key)
      {
          if(is_array($key))
          {
               $sql .= " WHERE thekey IN ( " . substr( implode( "','", $key ), 2, -2) . " )";
          }
            else
          {
               $sql .= " WHERE thekey = '$key'";
          }
      }

      try{
              $query = $this->dashboard->query($sql);

              foreach ($query->result_array() as $row)
              {
                  $result[$row['thekey']]= $row['thevalue'];
              }

               return $result;
      }
      catch(Exception $e)
      {
        utils::log_message('error',  'Exception: ',  $e->getMessage());
        return false;
      }
  }

  public function set_data($ptracid, $key, $value = false)
  {
        if(empty($value))
        {
            $this->delete_data($ptracid, $key);
        }
          else
        {
            $sql  = "INSERT INTO rapport (ptrac, thekey, thevalue ) VALUES ('$ptracid', '$key', '$value') on DUPLICATE KEY UPDATE `thevalue` = $value";
        }

        try{
            $query = $this->dashboard->query($sql);
            return array('success'=>'true');
        }
        catch(Exception $e)
        {
          utils::log_message('error',  'Exception: ',  $e->getMessage());
          return false;
        }
  }

  public function delete_data($ptracid, $key, $areyousure = false)
  {
        if(empty($areyousure))
        {
            $sql = "DELETE FROM rapport WHERE ptrac = '$ptracid' AND thekey='$thekey'";
        }
        else
        {
            $sql = "DELETE FROM rapport WHERE ptrac = '$ptracid'";
        }

        try{
          $query = $this->dashboard->query($sql);
          return array('success'=>'true');
        }
        catch(Exception $e)
        {
          utils::log_message('error',  'Exception: ',  $e->getMessage());
          return false;
        }
  }
}