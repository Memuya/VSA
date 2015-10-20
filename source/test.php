<?php
/*include 'test2.php';

use \Test\Tools\Foo;

$foo = new Foo();
$foo->x();
*/

if(isset($_POST['send'])) {
	echo $_POST['name'];
}
?>

<form method="post">
	<input type="text" name="name">
	<input type="submit" name="send">
</form>