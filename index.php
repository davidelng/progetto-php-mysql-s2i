<?php

include_once 'core/bootstrap.php';

$db = new Database();
$db->openConnection($dbconfig);

$request = new Request;
$data = $request->getBody();

?>

<pre>
<?php
$test = new City($db);
// $test = new Flight($db);
// $test->create();
// $test->update();
// $test->delete();
// $test->selectByCity();
// $test->selectBySeats();
$test->selectAll();
?>
</pre>