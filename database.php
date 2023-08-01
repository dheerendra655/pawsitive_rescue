<?php 
  
  class database {
    private $host;
    private $username;
    private $password;
    private $db_name;

    protected function connect(){
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db_name = "pawsitive_rescue";

        $connection = new mysqli($this->host,$this->username,$this->password,$this->db_name);
         if(!$connection ){
            die('connection failed');
         }
        return $connection;
    }
  }

  // **************** QUERY CLASS ********************//

  class query extends database{
  
       // insert into table (field1,field2,....) values ('value1','value2',....)
       
       function insert ($table,$data_arr){

            $sql = "insert into $table ( ";

            $fields ="" ;
            $values ="" ;

            $count = count($data_arr);
            $i = 1;

            foreach($data_arr as $key => $value){
                
                if($i == $count){
                    $fields.= "$key ) values ( ";
                    $values.= "'$value' )";
                }

                else {
                    $fields .= "$key, ";
                    $values .= "'$value ',";
                }
                $i++;
            }
            
            $sql .= $fields.$values;

          

            $result = $this->connect()->query($sql);
            if($result ){
                return true;
            }
            else {
                return false;
            }


        }

        // select field from table where condition = something;

        function get_data($table,$field='*', $id='',$email=""){

            $sql= "select $field from $table";
            if($id != ''){
                $sql.= " where id = $id";
            }
            if($email != ""){
                $sql." where email = $email";
            }
             
            $result = $this->connect()->query($sql);

            return $result;
        }
        // UPDATE `user` SET `id`='[value-1]',`name`='[value-2]',`email`='[value-3]',`password`='[value-4]' WHERE 1//


        function update ($table,$data_arr,$id){
             
            $sql = "update user set";

            foreach ($data_arr as $key=>$value){
                $sql.=" $key = '$value',";
            }

            $sql.= " where id = $id";

            $sql = str_replace(", where"," where",$sql);

            $result = $this->connect()->query($sql);

            

            if($result){
                return true;
            }
            else{
               return false;
            }

        }
                               // delete from table where id = 1;//

        function delete ($table,$id){
               $sql = "delete from $table where id = $id";

               $result = $this->connect()->query($sql);

               if($result){
                return true;
               }
               else{
                return false;
               }
        }

        function validate_str($str){
             return mysqli_real_escape_string($this->connect(),$str);
        }
  }

  


?>

