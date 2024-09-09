<?php
// ini adalah class untuk mengambil koneksi PDO. saat ini hanya tersedia untuk koneksi mysql dan sqlserver
// 1. atur connection_string dulu sebelum digunakan, line 7-10 untuk sqlserver, line 13-16 untuk mysql
// 2. panggil class ini dari function anda dengan sql_typeeter sql_type = mysql / sqlsrv

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

class koneksi {
    
    public function handler ($sql_type) { try { # ---> $sql_type = mysql / sqlsrv 
        if ($sql_type === "mysql") {return $this->pdo_mysql($sql_type);}
        else if($sql_type === "sqlsrv") {return $this->pdo_sqlserver($sql_type);} 
        else { throw new Exception("please provide sql type. options: sqlsrv / mysql."); }}
        catch (Exception $e){ return $e->getMessage(); }}
    
    private function pdo_sqlserver () {
        try{ $pdo   = new PDO("sqlsrv:server=".SSSERVER.";Database=".SSDBNAME."", "".SSDBUSER."", "".SSDBPASS."" );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { return $e->getMessage(); }
        return $pdo; } 

    private function pdo_mysql () {
        try{ $pdo   = new PDO("mysql:host=".MSSERVER.";dbname=".MSDBNAME."", "".MSDBUSER."", "".MSDBPASS."" );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { return $e->getMessage(); }
        return $pdo; } 
}
?>
