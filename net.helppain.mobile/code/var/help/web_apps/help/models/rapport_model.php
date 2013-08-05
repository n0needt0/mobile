<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapport_Model extends CI_Model {

 public function __construct()
  {
      parent::__construct();
      $this->dashboard = $this->load->database('dashboard', true);
      $this->ptrac = $this->load->database('ptrac', true);
  }

  public function get_ptrac($ptracid)
  {
      $sql = "SELECT * FROM ticket WHERE id ='$ptracid'";
      $result = array('summary'=>'NOT FOUND');

      try{
          $query = $this->ptrac->query($sql);

          foreach ($query->result_array() as $row)
          {
              $result =  $row;
          }
          return $result;
      }
      catch(Exception $e)
      {
          utils::log_message('error',  'Exception: ',  $e->getMessage());
          return false;
      }


  }


  public function get_data($ptracid, $key = false, $bypattern = false)
  {

      $result = array();

      $sql = "SELECT * FROM rapport WHERE ptrac='$ptracid'";

      if(false !== $key)
      {
      	  if($bypattern)
      	  {
      	  	$sql .= " AND thekey LIKE '$key%'";
      	  }
      	  else
      	  {
          	 if(is_array($key))
          	 {
           	    $sql .= " AND thekey IN ( " . substr( implode( "','", $key ), 2, -2) . " )";
          	 }
           	 else
         	 {
          	     $sql .= " AND thekey = '$key'";
         	 }
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
  		$sql = "";
  	    if(!is_int((int) $ptracid) && (int) $ptracid > 0)
  	    {
  	    	utils::log_message('error',  "Exception: PtracID not integer, ptrac=$ptracid, key=$key, value=$value");
          	return false;
  	    }

        if(empty($value))
        {
        	$this->delete_data($ptracid, $key);
        	return array('success'=>'true');
        }
        else
        {
        	$sql  = "INSERT INTO rapport (ptrac, thekey, thevalue ) VALUES ('$ptracid', '$key', '$value') on DUPLICATE KEY UPDATE thevalue = '$value'";
        }

        try
        {
            $query = $this->dashboard->query($sql);

            if($this->dashboard->affected_rows() > 0)
            {
            	  return array('success'=>'true');
            }

            return array('success'=>'false', 'query'=>$sql);
        }
        catch(Exception $e)
        {
          utils::log_message('error',  'Exception: '.  $e->getMessage() . 'query:' . $sql);
          return false;
        }
  }

  public function delete_data($ptracid, $key, $areyousure = false)
  {
  		$sql = "";
        if(empty($areyousure))
        {
            $sql = "DELETE FROM rapport WHERE ptrac = '$ptracid' AND thekey='$key'";
        }
        else
        {
            $sql = "DELETE FROM rapport WHERE ptrac = '$ptracid'";
        }

        try
        {
          $query = $this->dashboard->query($sql);
          return array('success'=>'true');
        }
        catch(Exception $e)
        {
          utils::log_message('error',  'Exception: '.  $e->getMessage());
          return false;
        }
  }
}