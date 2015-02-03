<?php
include 'session.php';

header("Cache-Control: no-cache, must-revalidate");

$sql = 'SELECT lectureid, lecture_name FROM system_lectures WHERE userid = "'.$userid.'"';

$res = $pdo->query($sql);
$res->setFetchMode(PDO::FETCH_OBJ);

$out = array();
foreach($res as $row)
{
  $out[] = array(
    'id'    => $row->taskid,
    'title' => $row->task_name,
    'url'   => $row->task_url,
	'class' => $row->task_class,
    'start' => strtotime($row->task_startdate) . '000',
    'end'   => strtotime($row->task_duedate) .'000'
   );
}

echo json_encode(array('success' => 1, 'result' => $out));
exit;