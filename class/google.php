<?php
    include_once('conexion.php');
    class Google extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function get_lat_lng($value){
            $sql=$this->db->query("SELECT latitud, longitud FROM supermercados WHERE id = '$value' LIMIT 1");
            $lat = 0;
            $lng = 0;
            foreach($sql as $key){
                $lat = $key['latitud'];
                $lng = $key['longitud'];
            }

            $array = array('lat' => $lat, 'lng' => $lng);
            return $array;
        }

        public function get_stores(){
            $sql = $this->db->query("SELECT id, nombre FROM supermercados ORDER BY nombre");
            $option = '';
            foreach($sql as $key){
                $id = $key['id'];
                $name = $key['nombre'];
                $option .= '<option value="'.$id.'">'.$name.' - B</option>';
            }

            return $option;
        }
    }

    if(isset($_POST['value'])){
        $class = new Google;
        $run = $class->get_lat_lng($_POST['value']);
        exit(json_encode($run));
    }
?>