<?php
    namespace App;

    abstract class Entity{

        protected function hydrate($data){

            foreach($data as $field => $value){
                                                                            // var_dump($data)."<br>"; 
                                                                            // var_dump($field)."<br>";
                                                                            // var_dump($value);die;
                //field = marque_id
                //fieldarray = ['marque','id']
                $fieldArray = explode("_", $field);
                                                                            // var_dump($fieldArray);die;
                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                                                                                // var_dump($fieldArray[1]);die;
                                                                                
                    $manName = ucfirst($fieldArray[0])."Manager";  
                                                                                //    var_dump($manName);die;
                    $FQCName = "Model\Managers".DS.$manName;
                                                                                    //   var_dump($FQCName);die;
                    $man = new $FQCName();
                                                                                    //   var_dump($man);die;
                    $value = $man->findOneById($value);
                }
                //fabrication du nom du setter à appeler (ex: setMarque)
                $method = "set".ucfirst($fieldArray[0]);
                                                                                        // var_dump($method);die;
                if(method_exists($this, $method)){
                    $this->$method($value);
                                                                                        //  var_dump( $this->$method($value));die;
                }
            }
        }

        public function getClass(){
            return get_class($this);
                                                                                           
        }
    }