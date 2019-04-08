<form action="index.php" method="post" name="Add friend">
Names: <input type="text" name="name">
<button type="submit">Add new friend </button><br>
</form>



<?php

echo "<h1>" ; 
echo "My best friends " ; 
echo "</h1>" ;
echo "<ul id=";
echo "listF>" ; 

/// 1. Read all names from the file into array
$filename = 'friends.txt';
$file = fopen( $filename, "r" );
$friendsArray = array();
  if( $file !=false ) {
    while(!feof($file)) {
		$name = fgets($file);
		if (strlen($name)>0) {
			$friendsArray[] = $name;
   		}
	}
 }
fclose($file);





//// Display all names filter / starting filter ... 
$i = 0 ; 
echo "<form action=" ; 
echo "index.php" ; 
echo "method=" ; 
echo "post" ; 
echo ">" ;
foreach($friendsArray as $friend){
        
  	if(trim($_POST['nameFilter']) == ''){ // there is no filter selection, display all names 
    		echo "<li>" ; 
		echo "$friend" ;		
    		echo "</li>" ; 
		
  	}else{ // there is a filter selection 

    		if(strstr($friend,$_POST['nameFilter'])){ // if the filter pattern is 

			if (isset($_POST['startingWith'])){ // if the startingWith is selectec 
				if (substr($friend,0,strlen($_POST['nameFilter'])) == $_POST['nameFilter']){ // Verify if the name begins with the patter filter
					echo "<li>" ; 
       					echo "$friend" ;
        				echo "</li>" ; 
				}
       			}else{ // if the startingWith is not selected, display just the filter selection 
				echo "<li>" ; 
       				echo "$friend" ;
        			echo "</li>" ; 
        		}	
     		}
	}
	$i = $i+1 ; 
}

// adding new names to array
if (isset($_POST['name']) && strlen($_POST['name'])>0) {
// appending to file
  $file = fopen( $filename, "a" );
  fwrite( $file, $_POST['name']);
  fwrite( $file, "\n");
  echo "<li>" ; 
  echo "<b>" ; 
  echo $_POST['name'] ;
  echo "</b>" ; 
  echo "</li>" ; 
  $i = $i+1 ; 
}
echo "</form>" ; 
echo "</ul>" ;
?>



<form action="index.php" method="post" name="Add friend">
<input type="text" name="nameFilter" value="<?php echo $_POST['nameFilter']?>">
<input type="checkbox" name="startingWith">Only names starting with</input>
<button type="submit">Filter list </button><br>
</form>





