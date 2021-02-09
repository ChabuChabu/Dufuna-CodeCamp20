<?php
require_once("cookie.php");

$customer = new Customer();

if (isset($_COOKIE["customers"])) {
    $data = json_decode($_COOKIE["customers"], true);
    } else {
    $data =$customer->allCustomers();
}

try {
    if(count($data) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>S/N</th>";
                echo "<th>Full Name</th>";
                echo "<th>Email Address</th>";
                echo "<th>Created At</th>";
                echo "<th>Actions</th>";
            echo "</tr>";
    
            foreach($data as $row){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['firstname']  ." ". $row['lastname'] . "</td>";
                    echo "<td>" . $row['email_address'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>" . '<a href="./customersOrderList.php?id='. $row['id'] .'">View</a>' . "</td>";
                echo "</tr>";
            }
        echo "</table>";
    
        unset($data);

    } else {
        echo "No records matching your query were found";
    }

} catch (PDOExeption $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
?>