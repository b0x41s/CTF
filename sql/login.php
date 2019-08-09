<?php
$name = isset($_POST['name']) ? $_POST['name'] : '' ;
$pass = isset($_POST['pass']) ? $_POST['pass'] : '' ;
?>
<?php
echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<?php
$link = new PDO('mysql:dbname=test;host=localhost', 'vulnuser', 'dmLeSF4BSxmyjWzV');

$sql = "SELECT * FROM users WHERE
	name = '{$name}'
	AND pass = '{$pass}' ";
/*
$sql = 'SELECT * FROM users WHERE ' .
	"name = '" . mysqli_real_escape_string($name, $link) . "' " .
	"AND pass = '" . mysqli_real_escape_string($pass, $link) . "'";
*/

$result = $link->query($sql);


if (!$result) {
    header('HTTP/1.0 500 Internal Serever Error');
    echo 'Internal Serever Error: ';
    exit;
}

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$rows[] = $row;
}



if (empty($rows)) {
    header('HTTP/1.0 404 Not Found');
    echo '<br><br><br><br><br><br><br><div align=center><h1>Permission denied!!</h1></div>';
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SQL injection Demo</title>
</head>
<body>
<div align=center>
<h1>Welcome
<?php
if (!empty($rows)) {
    

    echo htmlspecialchars($rows[0]['name'], ENT_QUOTES, 'UTF-8'); 
}
?>


</h1>
<h3>The flag is: I_like_sql_injection_alot </h3>
</div>

</form>
</body>
</html>
