<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 07.04.2015
 * Time: 13:38
 */
include ('../core.php');
$db = new SafeMySQL();
$table = "certificate";
$out_a = array();
$out_b = array();
$add = 'added';

$sql = "SELECT ?n, (
SELECT COUNT( * )
FROM ?n AS  `tbl`
WHERE  `tbl`.?n =  ?n.?n
) AS count
FROM  ?n
GROUP BY  ?n
ORDER BY ?n";
$rows = $db->getAll($sql, $add, $table, $add, $table, $add, $table, $add, $add);

foreach ($rows as $row):
    $output_a = array($row['added']);
    $output_b = array($row['count']);
    array_push($out_a, $output_a);
    array_push($out_b, $output_b);
endforeach;

echo json_encode(array($out_a, $out_b));

?>