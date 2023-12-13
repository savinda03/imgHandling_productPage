<!DOCTYPE html>
<html>
<head>
    <title>Set prices for the product</title>
</head>
<body>
    <?php

        require_once 'db_connection.php';


        if(isset($_GET['product_id'])){

            $productId = urldecode($_GET['product_id']);

           // echo "<p>Passed Variable: $passed_variable</p>";
        } else {
           //error
        }


        echo "<table>";
        echo "<tr>";
        echo "<th>Item Code</th>";
        echo "<th>Flavour</th>";
        echo "<th>Size</th>";
        echo "<th>Theme</th>";
        echo "<th>Price</th>";
        echo "</tr>";
        


        //fetch everything from items table where product id is as above
        $fetchItemsQuery = "SELECT * FROM items WHERE product_id = '$productId'";
        $resultsItemData = mysqli_query($conn, $fetchItemsQuery);
        //$rowItemData = mysqli_fetch_assoc($resultsItemData);

        if ($resultsItemData->num_rows > 0) {
           
            while($row = $resultsItemData->fetch_assoc()) {
                //echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Price: " . $row["price"]. "<br>";

                $itemId = $row["item_id"];
                $flavourId = $row["flavour_id"];
                $sizeId = $row["size_id"];
                $themeId = $row["theme_id"];
                

                $selectFlavourName = "SELECT flavour_name FROM flavours WHERE flavour_id = '$flavourId'";
                $resultFlavourName = mysqli_query($conn, $selectFlavourName);
                $rowFlavourName = mysqli_fetch_assoc($resultFlavourName);
                $flavourName = $rowFlavourName['flavour_name'];     //flavour


                $selectSizeName = "SELECT size_name FROM sizes WHERE size_id = '$sizeId'";
                $resultSizeName = mysqli_query($conn, $selectSizeName);
                $rowSizeName = mysqli_fetch_assoc($resultSizeName);
                $sizeName = $rowSizeName['size_name'];      //size

                
                $selectThemeName = "SELECT theme_name FROM themes WHERE theme_id = '$themeId'";
                $resultThemeName = mysqli_query($conn, $selectThemeName);
                $rowThemeName = mysqli_fetch_assoc($resultThemeName);
                $themeName = $rowThemeName['theme_name'];       //theme

                echo "<tr>";
                echo "<td>". $itemId . "</td>"; 
                echo "<td>". $flavourName . "</td>"; 
                echo "<td>". $sizeName . "</td>";     
                echo "<td>". $themeName . "</td>";    
                
                echo "<td>";
                
                 echo '<form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">';

                  echo '<input type="text" id="price" name="price" pattern="\d{1,6}(\.\d{1,2})?" title="Enter up to 6 digits and up to 2 decimal places" required>';
                       
                   echo'<input type="submit" value="Submit">';
                    echo '</form>';
            
                   echo'</td>';

                   
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
    
        ?>
        <?php


?>
 


    </body>
    </html>
