<?php
class conexion
{
    protected $con;
	// las variables referentes a la conexion con la clase PDO
    public function connection()
    {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=sueduca1_wp1", "root", "");
            // $this->con = new PDO("mysql:host=localhost;dbname=sueduca1_wp2", "sueduca1_wp1", ".8{lj~_GVv8N");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->exec('SET CHARACTER SET utf8');
            return $this->con;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
?>