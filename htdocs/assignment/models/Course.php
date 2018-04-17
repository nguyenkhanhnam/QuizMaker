<?php
    class Course {
        private $id;
        private $code;
        private $name;

        public function getCourse(){
            return $this;
        }

        public function __construct($id, $code, $name){  
            $this->id = $id;
            $this->code = $code;
            $this->name = $name;
        }
    }
?>