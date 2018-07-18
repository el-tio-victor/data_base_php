<?php
    
class Data_Base{
    private $status = false;
    private $db ;
    
    private function db_open(){
        $this->db = new mysqli('localhost','homestead','secret','data');
        if(!$this->db->connect_errno){
            $this->status = true;
            $this->db->set_charset('utf8');
        }
        
    }
    
    public function db_close(){
        $this->db->close();
    }
    
    public function set_data($sql){
        $this->db_open();
        if($this->status){
            if(!$this->db->query($sql))
                $this->status = false;
            $this->db_close();
        }
        return $this->status;
    }
    
    public function get_data($sql){
        $this->db_open();
        $row = array();
        if($this->status){
            $result = $this->db->query($sql);
            if($result->num_rows >0){
                while($row[] = $result->fetch_assoc());
                $this->db->close();
                array_pop($row);
            }
            
        }
        return $row;
    }
    
}