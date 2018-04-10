<?php
    class Course {
        private $id;
        private $code;
        private $name;

        public function getCourses(){
            $sql =  "SELECT * FROM `courses`";
            $result = mysqli_query($connection, $sql);
            header('Content-Type: text/html; charset=utf-8');
            while($row = mysqli_fetch_array($result)){
                array_push($data, array('code' => $row["code"], 'name' => $row["name"]));
            }
            echo json_encode($data);
        }

        public function getCourse($code){

        }
        
        public function __construct($id, $code, $name){  
            $this->id = $id;
            $this->code = $code;
            $this->name = $name;
        }
    }
?>