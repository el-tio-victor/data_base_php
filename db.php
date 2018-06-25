<?php
    class Data_Base {
        //Class conection
        private $db;
        private $msg;
        private $status = false;
        private $data = array();
        private function db_open(){
            $this->db = new mysqli('localhost','homestead','secret','data');
            if($this->db->connect_errno)
                $this->msg = "Ocurrio un Problema En la base de datos";
            else{
                $this->db->set_charset('utf8');
                $this->msg = "Conexion Exitosa";
                $this->status = true;
            }
                
        }
        
        private function db_close(){
            $this->db->close();
        }
        
        public  function set_data($sql){
            $this->db_open();
            if( $this->status ){
                if( !$this->db->query($sql) ){
                    $this->status = false;
                    $this->msg = 'Algo salió mal al insertar los datos';
                }
                else{
                    $msg = 'Datos Agregados';
                    $status = true;
                }
                
            }
            $this->data = array('msg' => $msg, 'status' => $status);
            $this->db_close();
            return $this->data;
        }
        
        public function get_data($sql){
            $rows = array();
            $this->db_open();
            if($this->status){
                $result = $this->db->query($sql);
                if($result->num_rows > 0 ){
                    while($rows[] = $result->fetch_assoc());
                     $this->db_close();
                    
                }
                else{
                    $rows = false;
                }
                
             }
                return $rows;
            }
        
    }