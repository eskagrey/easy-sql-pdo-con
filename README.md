# easy-sql-pdo-con
easily switch pdo connection between mysql &amp; sql server

ini adalah class untuk mengambil koneksi PDO berdasarkan parameter 
saat ini hanya tersedia untuk koneksi mysql dan sqlserver
1. atur connection_string dulu sebelum digunakan, line 10-13 untuk sqlserver, line 16-19 untuk mysql
2. panggil class ini dengan parameter sql_type = mysql / sqlsrv
