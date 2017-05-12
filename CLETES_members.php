<?php 
include "header.php";
include "includes/config.php";
include "includes/connect.php";
include "includes/methods.php";
?>

<div id="wrapper">
<body>

<?PHP
//---------------------------------------------------------------------------
function display_dropdown($db,$select_name,$id_col, $display_name, $table_name)
{
	  print "<select name='$select_name'>";
	  print "<option value=''> Select  </option>";     
	  $qry = "SELECT $id_col, $display_name FROM $table_name ORDER BY $display_name";
 //     print "$qry<br>" ;
	  $result = mysqli_query ($db, $qry); 
	  if (!$result)
	      die ("SELECT error:  ". mysqli_error ($db));
	  $numrows = mysqli_num_rows($result);
	 // print "$numrows<br>";
	  
      for ($i=0; $i<$numrows; $i++) {
             $row = mysqli_fetch_assoc($result);
		     $id = $row[$id_col];
             $name = $row[$display_name];
             print "<option value='$id'>$name</option>";
       }	
       print "</select>";	
}


//---------------------------EXECUTION STARTS HERE  ------------------------------

// Add members
// print_r ($_POST);

if (isset($_POST['add_member'])) {      

   // NAME IN POST MUST MATCH NAMES IN FORM!!!!!!!
	    $fn      = $_POST['first_name'];
		$ln      = $_POST['last_name'];
        $gender  = $_POST['gender'];
		$dob     = $_POST['dob'];
		$address = $_POST['address'];
		$city    = $_POST['city'];
		$state   = $_POST['state'];
		$zip     = $_POST['zip'];
		$phone   = $_POST['phone'];
		$team_id = $_POST['team_id']; 

        $query = 
		"INSERT INTO members(first_name, last_name, gender, date_of_birth, address, city, state, zip, phone_number, team_id ) VALUES
		('$fn','$ln','$gender','$dob','$address','$city','$state','$zip','$phone','$team_id')"; 
       // print $query;
         $result = mysqli_query ($db, $query);
         if (!$result) 
             print "ERROR: on INSERT " . mysqli_error($db);
         else {
             print "<br>New Member $fn $ln added to database <br>";
		    $query="SELECT concat(m.first_name,' ',m.last_name) as Member, m.phone_number as Phone,
			m.address as Address, m.city as City, m.state as State, m.zip as 'ZIP Code', 
			t.team_description as Team
			FROM       members   M 
			INNER JOIN teams     T ON t.team_id = m.team_id;";

        //print $query;
        $result = mysqli_query ($db,$query);
        if (!$result)
             print "Error: " . mysqli_error($db);
        else { 
            
			$numrows = mysqli_num_rows($result);
			if ($numrows == 0)
			    print "This is not Kosher<br>";
			else {
			  print "<table class='data'>";
	          print "<th>Member</th><th>Phone</th><th>Address</th><th>City</th><th>State</th><th>ZIP Code</th><th>Team</th>";
			  for ($i=0; $i<$numrows; $i++) {
				print "<tr>";
				$row = mysqli_fetch_assoc($result);
				print "<td>" . $row['Member'] . "</td>";
			    print "<td>" . $row['Phone'] . "</td>";
			    print "<td>" . $row['Address'] . "</td>";
    			print "<td>" . $row['City'] . "</td>";
				print "<td>" . $row['State'] . "</td>";
				print "<td>" . $row['ZIP Code'] . "</td>";
				print "<td>" . $row['Team'] . "</td>";
				print "</tr>";
		      }
			}  
		print "</table><br>";
        }
	} 
} 

	if (isset($_POST['delete_member'])) { 
	
	$member_id = $_POST['member_id'];
	$query ="DELETE FROM members
	WHERE member_id = $member_id";
	         $result = mysqli_query ($db, $query);
         if (!$result) 
             print "ERROR: on INSERT " . mysqli_error($db);
         else {
			print "Member deleted"; 
			
            $query="SELECT concat(m.first_name,' ',m.last_name) as Member, m.phone_number as Phone,
			m.address as Address, m.city as City, m.state as State, m.zip as 'ZIP Code', 
			t.team_description as Team
			FROM       members   M 
			INNER JOIN teams     T ON t.team_id = m.team_id;";

        //print $query;
        $result = mysqli_query ($db,$query);
        if (!$result)
             print "Error: " . mysqli_error($db);
        else { 
            
			$numrows = mysqli_num_rows($result);
			if ($numrows == 0)
			    print "This is not Kosher<br>";
			else {
			  print "<table class='data'>";
	          print "<th>Member</th><th>Phone</th><th>Address</th><th>City</th><th>State</th><th>ZIP Code</th><th>Team</th>";
			  for ($i=0; $i<$numrows; $i++) {
				print "<tr>";
				$row = mysqli_fetch_assoc($result);
				print "<td>" . $row['Member'] . "</td>";
			    print "<td>" . $row['Phone'] . "</td>";
			    print "<td>" . $row['Address'] . "</td>";
    			print "<td>" . $row['City'] . "</td>";
				print "<td>" . $row['State'] . "</td>";
				print "<td>" . $row['ZIP Code'] . "</td>";
				print "<td>" . $row['Team'] . "</td>";
				print "</tr>";
		      }
			}  
		print "</table><br>";
        }
	} 
} 

?>
   
<!-- 
Display the form
-->
<form method = 'post' >
<table class="data-input">
<tr>
<td> Click Button => </td>
<td><input type='submit' value='Show Members' name ='show_all_members'/></td>
</tr><tr>
   <td>First Name:</td>
   <td><input type='text'  name='first_name' />*</td>
</tr><tr>
   <td>Last name:</td>
   <td><input type='text'  name='last_name' />*</td>
</tr><tr>
   <td>Gender</td>
   <td><input type="radio" name="gender" value="male"> Male</td>
   <td><input type="radio" name="gender" value="female"> Female</td>
</tr><tr>
   <td>Date of Birth:</td>
   <td><input type='date' name='dob' /></td>
</tr><tr>   
   <td>Street Address:</td>
   <td><input type='text'  name='address' />*</td>
</tr><tr>
   <td>City:</td>
   <td><input type='text'  name='city' />*</td>
</tr><tr>
   <td>State:</td>
   <td><input type='text'  name='state' size=2 />*</td>
</tr><tr>
   <td>Zip:</td>
   <td><input type='text'  name='zip' size=5 />*</td>
</tr><tr>
   <td>Phone Number:</td>
   <td><input type='text'  name='phone' size=12 />*</td>
</tr><tr> 
   <td>Team:</td>
   <td><?php display_dropdown ($db,'team_id','team_id','team_description','teams'); ?>*</td>   
   <td>&nbsp;</td>
   <td><input type='submit' name='add_member' value='Add'/></td>
</tr><tr>
   <td>Delete Member</td>
   <td><?php display_dropdown ($db,'member_id','member_id','concat(first_name," ",last_name)','members'); ?>*</td>
   <td>&nbsp;</td>
   <td><input type='submit' name='delete_member' value='Delete'/></td>
</tr>
</table>
</form>

</div>

<?php
			 
//include "footer.php";
?>