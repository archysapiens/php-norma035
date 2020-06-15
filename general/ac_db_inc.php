<?php
 

class DbOracle {
 
  
    protected $conn = null;
 
    protected $stid = null;
  
    protected $prefetch = 100;


    function __construct($module, $cid) {
        $DatCnnx = parse_ini_file($_SERVER['DOCUMENT_ROOT'] .'/general/ssa_cnx.ini'); 


        $this->conn = @oci_pconnect($DatCnnx['usuario'],$DatCnnx['password'],$DatCnnx['servidor'].":1522/".$DatCnnx['base_ssa'], $DatCnnx['CHARSET']);

        //echo "Despues de conetar <bR>";
        if (!$this->conn) {
            $m = oci_error();
            throw new \Exception('SSA No se hay conexión a la BD: ' . $m['message']);
            echo "SSA No se hay conexión a la BD: " . $m['message'];
        }
 
        // These are used for end-to-end tracing in the DB.
        oci_set_client_info($this->conn, $DatCnnx['CLIENT_INFO']);
        oci_set_module_name($this->conn, $module);
        oci_set_client_identifier($this->conn, $cid);
    }
 
    /**
     * Destructor closes the statement and connection
     */
    function __destruct() {
        if ($this->stid)
            oci_free_statement($this->stid);
        if ($this->conn)
            oci_close($this->conn);
    }


    public function execute($sql, $action, $bindvars = array()) {
        $this->stid = oci_parse($this->conn, $sql);
        if ($this->prefetch >= 0) {
            oci_set_prefetch($this->stid, $this->prefetch);
        }
        foreach ($bindvars as $bv) {
            // oci_bind_by_name(resource, bv_name, php_variable, length)
            oci_bind_by_name($this->stid, $bv[0], $bv[1], $bv[2]);
        }
        oci_set_action($this->conn, $action);
        oci_execute($this->stid);              // will auto commit
    }
 
   
    public function execFetchAll($sql, $action, $bindvars = array()) {
        $this->execute($sql, $action, $bindvars);
        oci_fetch_all($this->stid, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        $this->stid = null;  // free the statement resource
        return($res);
    }
 
}//Db
 
?>