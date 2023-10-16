<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:ccu-dorm-for-grads.database.windows.net,1433; Database = CDFG_SQL", "dev", "{112-c-d-f-g}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// phpinfo();

$query = 'select * from dbo.test';
$stmt = $conn->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}

$conn = null;

?>