<?php
//CREATES A CSV FILE WITH 25 RANDOM CONTACTS
function generateRandomName() {
    $firstNames = ['John', 'Jane', 'Peter', 'Susan', 'Mike', 'Laura', 'Chris', 'Anna'];
    $lastNames = ['Doe', 'Smith', 'Jones', 'Williams', 'Brown', 'Davis', 'Miller', 'Wilson'];
    return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
}

function generateRandomEmail($name) {
    return strtolower(str_replace(' ', '.', $name)) . '@example.com';
}

function generateRandomPhoneNumber() {
    $number = '777.' . str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT) . '.' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
    return $number;
}

$list = [
    ['Name', 'Email', 'Phone']
];

for ($i = 0; $i < 25; $i++) {
    $name = generateRandomName();
    $email = generateRandomEmail($name);
    $phone = generateRandomPhoneNumber();
    $list[] = [$name, $email, $phone];
}

$handle = fopen('files/contactlist.csv', 'w');
if (!$handle) {
    throw new Exception("Cannot open users.csv for writing");
}

//CLEARS THE CSV FILE
$output = "<p>File cleared</p>";
fwrite($handle, "");


//GOES THROUGH THE LIST AND WRITES THE CONTACTS TO A TABLE
foreach ($list as $fields) {
    fputcsv($handle, $fields);
}
fclose($handle);

$output .= "<p>CSV file 'users.csv' created successfully.</p>";

$output .= "<p>File Contents</p>";

$rows = [];
$handle = fopen('files/contactlist.csv', 'r');
if (!$handle) {
    throw new Exception("Cannot open users.csv for reading");
}

while (($data = fgetcsv($handle)) !== FALSE) {
    $rows[] = $data;
}
fclose($handle);


$output .= "<table class='table table-striped'>";
$output .= "<thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead>";
$output .= "<tbody>";

foreach ($rows as $row) {
    $output .= "<tr>";
    foreach ($row as $cell) {
        $output .= "<td>" . htmlspecialchars($cell) . "</td>";
    }
    $output .= "</tr>";
}

$output .= "</tbody>";
$output .= "</table>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Write to CSV file</title>
</head>
<body class="container">
    <?php echo $output; ?>
</body>
</html>