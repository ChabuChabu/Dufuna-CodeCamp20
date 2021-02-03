<?php

require_once("connection.php");

echo "<h3> Customer Details </h3>";

//Querying the database to select all information available in the table
class QueryDb extends Connect {
    public function customers() {
        try {
            $sql= "SELECT * FROM customers";
            $stmt = $this->conn()->query($sql);
            $result = $stmt->fetchAll();
            
        // setting up the cookie to save the result in the databsae
        setcookie("customers", serialize($result), time()+7200, "/");
        return $result;
        } catch (PDOException $e) {
            die ('could not execute ' . $sql . $e->getMessage());
        }
    }
}
//To call the customers function
$query = new QueryDb();
$result = isset($_COOKIE['customers']) ? unserialize($_COOKIE['customers']) : $query->customers();

    if(count($result) > 0)  {
        echo "<table>";
            echo "<tr>";
                echo "<th> S/N </th>";
                echo "<th> Full Name </th>";
                echo "<th> Email Address </th>";
                echo "<th> Created At</th>";
                echo "<th> Actions </th>";
            echo "</tr>";
            foreach($result as $row) {
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name']. " " .$row['last_name'] ."<td>";
                    echo "<td>" . $row['email_address'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>" . '<button><a href="./listView.php?id='. $row['id'] .'">View</a></button>' . "</td>";
                echo "</tr>";
            }
        echo "</table>";
        unset($result);
    }   else {
        echo "could not execute query";
    }
?>