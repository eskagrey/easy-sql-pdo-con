<?php

// ini adalah class untuk mengambil koneksi PDO berdasarkan parameter 
// saat ini hanya tersedia untuk koneksi mysql dan sqlserver
// 1. atur connection_string dulu sebelum digunakan, line 10-13 untuk sqlserver, line 16-19 untuk mysql
// 2. panggil class ini dari function anda dengan parameter sql_type = mysql / sqlsrv


// SQL SERVER CONNECTION STRING
define('SSSERVER', "yourservername, port");
define('SSDBNAME', "yourdbname");
define('SSDBUSER', "yourdbuser");
define('SSDBPASS', "yourdbpass");

// MYSQL CONNECTION STRING
define('MSSERVER', "yourservername, port");
define('MSDBNAME', "yourdbname");
define('MSDBUSER', "yourdbuser");
define('MSDBPASS', "yourdbpass");


class pdo_connection 
{
    private function connection_string ($sql_type)
    {
        switch ($sql_type)
        {
            case "sqlsrv":
                return [
                        "server"    => SSSERVER,
                        "dbname"    => SSDBNAME,
                        "dbuser"    => SSDBUSER,
                        "dbpass"    => SSDBPASS
                    ];
                    break;
            case "mysql":
                return [
                        "server"    => MSSERVER,
                        "dbname"    => MSDBNAME,
                        "dbuser"    => MSDBUSER,
                        "dbpass"    => MSDBPASS
                    ];
            break;
            default:
            return "please define sql type";
        }
    }
            
    public function handler ($param){
        if ($param === "mysql") {return $this->pdo_mysql($param);}
        else if($param === "sqlsrv") {return $this->pdo_sqlserver($param);} 
        else { return "please provide sql type. sqlsrv / mysql.";}}
    
    protected function pdo_sqlserver ($param)
    {
        $con_str    = $this->connection_string($param);
        try{
        $pdo        = new PDO("sqlsrv:server=".$con_str['server'].";Database=".$con_str['dbname']."",
                        "".$con_str['dbuser']."",
                        "".$con_str['dbpass'].""
                    );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { return $e->getMessage();}
        return $pdo;
    } 

    protected function pdo_mysql ($param)
    {
        $con_str    = $this->connection_string($param);
        try{
        $pdo        = new PDO("mysql:host=".$con_str['server'].";dbname=".$con_str['dbname']."",
                        "".$con_str['dbuser']."",
                        "".$con_str['dbpass'].""
                    );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { return $e->getMessage();}
        return $pdo;
    } 



}

?>