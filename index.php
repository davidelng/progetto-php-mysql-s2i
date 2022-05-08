<?php

include_once 'core/bootstrap.php';

$db = new Database();

$db->openConnection($dbconfig);

?>

<pre>
<?php
// $test = new City($db);
$test = new Flight($db);
// $test->create();
// $test->update();
// $test->delete();
// $test->selectByCity('Roma');
// $test->selectBySeats(30);
$test->selectAll();
?>
</pre>