<?php
session_start();
require_once 'header.php';

echo "<h3>Welcome to the $clubstr Marketplace.</h3>";
echo "<div>";

if ($loggedin){
    $numuseritems = queryMysql("SELECT COUNT(*) c FROM items WHERE Username = '$user'");
    $row = $numuseritems->fetch_assoc();
    $numuseritems->close();
    printf("Hi $user, you currently have %d items up for trade.<br>\n", $row['c']);
    }
else
    echo 'Please sign up, or log in if you\'re already a member. Join one of the
     most rapidly growing and advanced item trading networks available today -
     your friends are already here.<br>';

// code to display items table
$result = queryMysql("SELECT * FROM items");
$all_property = array();  //declare an array for saving property

//showing property
echo '<br>';
echo '<table class="data-table">
       <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
   echo '<td>' . $property->name . '</td>';  //get field name for header
   array_push($all_property, $property->name);  //save those to array
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   foreach ($all_property as $item) {
       echo '<td>' . $row[$item] . '</td>'; //get items using property value
   }
   echo '</tr>';
}
echo "</table>";
// end code to display items table

echo <<<_END
    </div><br>
_END;

require_once 'footer.php';
?>
