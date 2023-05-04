<?php
include("tables.php");
include("../header_inner.php");

$del_id=0;
$i=0;
?>


		<link rel="stylesheet" type="text/css" href="datatables.min.css">
 
		<script type="text/javascript" src="datatables.min.js"></script>
		

<style>
.hiddentd
{
display:inline-block;
    width:180px;
    white-space: nowrap;
    overflow:hidden !important;
   
}
</style>


<div class="">
<?php

	echo "<div class='col-sm-2' style='float:right;margin-bottom:10px;'><form action='form.php' method='post'><input type='submit' name='view' value='Add New' class='form-control btn-danger'></form></div>";
	
?>
<div class="clearfix"></div>
<table id="example" class="table table-striped table-bordered dataTable no-footer" cellspacing="0"  role="grid" aria-describedby="example_info" >

       
        
            
          <?php
	
		  include("../connection.php");
	
	
	
	
	
	
	
	
if(isset($_REQUEST['del_id']))
{
$del_id=$_REQUEST['del_id'];
mysqli_query($con,"delete from $table where id='$del_id'");
//if($del_id!="")
}
	?>
    <script>


function rem()
{
if(confirm('Are you sure you want to delete this record?')){
return true;
}
else
{
return false;
}
}


function rem2()
{
if(confirm('Are you sure you want to deactive this record?')){
return true;
}
else
{
return false;
}
}
</script>
    

<form method="post">
		<label>Name ‎ </label>
		<input type="text" name="name">
		<label>‎ ‎  Description ‎ </label>
		<select name="dept">
		<?php
		$sel=mysqli_query($con,"SELECT * FROM `department`");
		while($row=mysqli_fetch_array($sel))
		{
		?>
		<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
		<?php
		}
		?>
	  </select>
		<input type="submit" name="search">
   </form>
	
	<?php


	
	
	

	
	
		  $result2 = mysqli_query($con,"SHOW FIELDS FROM $table");

 echo "<thead><tr>";

while ($row2 = mysqli_fetch_array($result2))
 {

  $name=$row2['Field'];

  echo "<th>".
  str_replace('_', ' ', $name)
  ."</th>";
 $i++;
 }
 echo "
<th>Update</th>
 
 <th>Del</th> 
 </tr></thead>";
   
  // $i=0;
   echo "<tbody>";
   
            
   if(isset($_POST['search']))
   {
	   $name=$_POST['name'];
	   $dept=$_POST['dept'];
	   $result=mysqli_query($con,"SELECT * FROM `student` where name='$name' or 	department='$dept'");
	   //echo "SELECT * FROM `student` where name='$name' and 	department='$dept'";
	   $rows=mysqli_num_rows($result);
	   if($rows==0)
	   {
		   echo "<p style='color:red;'>Not Found</p>";
	   }
   }        
   else{   
	$result = mysqli_query($con,"SELECT * FROM $table ");
   }      
	

		while($row = mysqli_fetch_array($result))
		{
		$id=$row['0'];
		echo "<tr>";
		for($k=0;$k<$i;$k++)
		{
	
			
			if($k==30)
			{
			  $sql2 = "select *  from customer where id='$_SESSION[userid]' ";
    $result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
$row2 =mysqli_fetch_array($result2);
		
		

			echo "<td >  $row2[contact_person]</td>";
				
			}
			elseif($k==9)
			{
			  

			echo "<td> <img src='uploads/$row[$k]' width='100'></td>";
				
			}
			
			elseif($k==6)
			{
			  
			$sql2 = "select *  from department where id='$row[$k]' ";
			$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
			$row2 =mysqli_fetch_array($result2);
		

			echo "<td >  $row2[name]</td>";
				
			}
			
				
			elseif($k==31)
			{
				

			echo "<td class='hiddentd'> $row[content] </td>";
				
			}
			
			
				
			
			else
			{
			echo "<td >$row[$k]</td>";
			}
		
		
		
		
		
		}
		
		
		
		
		
			echo "
			
			<td><a href='update.php?id=$id'>Update</a></td>
			
			<td><a href='?del_id=$id' onclick='return rem()'>Del</a></td>
		
			</tr>";
		
		
		
		}
        
        ?>
        </tbody>
    </table>
			
		



<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>

<div class="clearfix"></div>
	
    </div> 
    <?php
	
//	include("../footer_inner.php");
	?>
