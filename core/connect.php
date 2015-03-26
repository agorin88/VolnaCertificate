<?php
//connection to the database
$dbhandle = mysql_connect($host, $db_user, $password)
or die("Unable to connect to MySQL");
//select a database to work with
$selected = mysql_select_db("cert",$dbhandle)
or die("Could not select examples");
?>

<?php
class db {
function __construct()
    {
        global $dbh;
        if (!is_null($dbh)) return;
        $dbh = mysql_connect('localhost', 'user', 'password');
        mysql_select_db('cert');
        mysql_query('SET NAMES utf8');
    }
    function select_list($query)
    {
        $q = mysql_query($query);
        if (!$q) return null;
        $ret = array();
        while ($row = mysql_fetch_array($q, MYSQL_ASSOC)) {
            array_push($ret, $row);
        }
        mysql_free_result($q);
        return $ret;
    }
}
?>