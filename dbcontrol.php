<?php
    class db{
        private $db;
        private $debug_mode;

        public function __construct($user,$pass,$db,$debug){
            $this->debug_mode = $debug;
            $this->db = new mysqli("localhost",$user,$pass,$db);
            $this->db->set_charset("utf8");
            if($this->db->connect_errno){
                echo "Database connect fail {$this->db->connect_errno}";
                exit();
            }
            else{
                $this->text_debug("Database Connect Success");
            }
        }

        public function query($sql){
            $result = $this->db->query($sql);
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if($this->debug_mode == true){
                echo "<pre>";
                print_r($data);
                echo "</pre>";
            }
            return $data;
        }

        public function close(){
            $this->db->close();
        }   

        private function text_debug($text){
            if($this->debug_mode == true){
                echo $text;
            }
        }
    }
?>