<?php
	
	$servername="sql6.freemysqlhosting.net";
	$username="sql6440524";
	$password="mF1vtrwrr2";
	$database="sql6440524";
	$conn=mysqli_connect($servername,$username,$password,$database);
	
	if(isset($_POST['shouldedit'])){
		$shouldedit=$_POST['shouldedit'];
	}
	else{
		$shouldedit=2 ;
	}

	if($conn && $shouldedit==0){
		$notetitle=$_POST['notetitle'];
		$note=$_POST['note'];
		date_default_timezone_set("Asia/Calcutta");
		$time=date("d/m/Y @ h:i:s A");
		$sql="INSERT INTO notes (notetitle,description,dtime) VALUES ('$notetitle','$note','$time')";
		$result=mysqli_query($conn,$sql);
		unset($_POST['shouldedit']);
	}
	elseif ($conn && $shouldedit==1) {
		$editsno=$_POST['editsno'];
		$editednotetitle=$_POST['editednotetitle'];
		$editednote=$_POST['editednote'];
		date_default_timezone_set("Asia/Calcutta");
		$time=date("d/m/Y @ h:i:s A");
		$sql="UPDATE notes SET notetitle='$editednotetitle',description='$editednote',dtime='$time' WHERE sno='$editsno'";
		$result=mysqli_query($conn,$sql);
		unset($_POST['shouldedit']);
		
	}
	elseif($conn && isset($_POST['deletesno'])){
		$deletesno=$_POST['deletesno'];
		$sql="DELETE FROM notes WHERE sno='$deletesno'";
		$result=mysqli_query($conn,$sql);
		unset($_POST['deletesno']);
	}
	elseif(!$conn){
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  			<strong>Error Connecting To The Database </strong>We regret the inconvenience caused.
  			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
	}

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>NoteSet</title>
	<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- Datatables plug in --> 
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
		
	<!-- Font awesome CDN -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- Local CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Edit Modal -->

		<!-- Button trigger modal -->
			<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
			  Launch demo modal
			</button> -->

			<!-- Modal -->
			<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">

					<form action="index.php" method="POST">
					  <input type="hidden" name="shouldedit" id="shouldedit2">
					  <input type="hidden" name="editsno" id="editsno">
					  <div class="mb-3 mt-4 col-lg-9 m-auto">
					
					    <label for="exampleInputEmail1" class="form-label">Note Title</label>
					    <input type="text" name="editednotetitle" class="form-control" id="editednotetitle" aria-describedby="emailHelp">
					  </div>
					  <div class="mb-3 mt-4 col-lg-9 m-auto">
					    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
					    <textarea class="form-control" name="editednote" id="editednote" rows="3"></textarea>
					   	
					  </div>
						<div class="modal-footer">
					  		<button type="submit" class="btn btn-primary " id="editButton">Save Changes</button>
				        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        
				      	</div>
					</form>

			      </div>
				  
			        
			      
			    </div>
			  </div>
			</div>



	<!-- Edit Modal -->

	<!-- Delete Modal -->


		<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this note ?</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">

					<form action="index.php" method="POST">
					  
					  <input type="hidden" name="deletesno" id="deletesno">
					  
					  
						<div class="modal-footer">
					  		<button type="submit" class="btn btn-primary " id="deleteButton">Confirm Delete</button>
				        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				        
				      	</div>
					</form>

			      </div>
				  
			        
			      
			    </div>
			  </div>
			</div>





	<!-- Delete Modal -->


	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <div class="container-fluid">
	  	<img class="logo" src="logo.jpg">
	    <a class="navbar-brand" href="#"> NoteSet</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="aboutus.php">About Us</a>
	        </li>
	        
	      </ul>
	      <form class="d-flex py-0 m-0">
	        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
	        <button class="btn btn-outline-success" type="submit">Search</button>
	      </form>
	    </div>
	  </div>
	</nav>


	<!-- View Note Modal  -->


		<div class="modal fade" id="viewNoteModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    
			    	
			      		
			        	<h3 style="color:black;margin-bottom: 4%;" class="modal-title" id="viewModalLabel">View Note</h3>
			        	
			        	
			        		
			        	
			    <table>  	
			      	<tr>
			      		<th class="viewNoteContent">
			      			 
			      			 <h5>Note Title : </h5>
			      		</th>
			      		<th class="viewNoteContent">
			      			 <h5 id="viewNoteTitle"></h5>
			      		</th>
			      	</tr>
			      	<tr>
			      		<th class="viewNoteContent">
			      			 
			      			 <h5>Description : </h5>
			      		</th>
			      		<th class="viewNoteContent">
			      			 <h5 id="viewNote"></h5>
			      		</th>
			      	</tr>
			      	<tr>
			      		<th class="viewNoteContent">
			      			 
			      			 <h5>Created On : </h5>
			      		</th>
			      		<th class="viewNoteContent"> 
			      			 <h5 id="viewTimestamp"></h5>
			      		</th>
			      		
			      	</tr>
			      	
			     			
	      		</table>
	      		<div class="modal-footer">
					  		
				        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				        
				    </div>

			      
				  
			        
			      
			    </div>
			  </div>
			</div>







	<!-- View Note Modal -->
	

	<!-- Note Taking Form  --> 
	<div class="container">
		<form action="index.php" method="POST">
			<input type="hidden" name="shouldedit" id="shouldedit">
		  <div class="mb-3 mt-4 col-lg-9 m-auto">
		  	<h2>Add a Note</h2>
		    <label for="exampleInputEmail1" class="form-label">Note Title</label>
		    <input type="text" name="notetitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		  </div>
		  <div class="mb-3 mt-4 col-lg-9 m-auto">
		    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
		    <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
		    <button type="submit" class="btn btn-primary mt-4" id="insertButton">Add Note</button>
		  </div>
		  
		</form>
	</div>
	<div class="container container-table">
		
		<table class="table" id="myTable">
		  <thead>
		    <tr>
		      <th scope="col">S.No</th>
		      <th scope="col">Note Title</th>
		      <th scope="col">Note</th>
		      <th scope="col">TimeStamp</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php
		    	$sql="SELECT * FROM notes";
		    	$result=mysqli_query($conn,$sql);
		    	
		    	while($row=mysqli_fetch_assoc($result)){
		    		echo "<tr>";
		    		echo "<td class='eachNote'>$row[sno]</td>";
		    		echo "<td class='eachNote'>$row[notetitle]</td>";
		    		echo "<td class='eachNote'>$row[description]</td>";
		    		echo "<td class='eachNote'>$row[dtime]</td>";
		    		echo '<td><a class="edit"><i class="icon far fa-edit"></i></a><a class="delete"><i class="icon far fa-trash-alt"></i></a></td>';
		    		echo "</tr>";
		    		
		    				    		
		    		
		    		
		    	}
		    ?>
		  </tbody>
		</table>



	</div>
	

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function () {
    		$('#myTable').DataTable();
		} );
	</script>
	<script type="text/javascript" src="index.js"></script>

	<!-- Modal Trigger & Edit , Delete buttons event listeners Javascript code -->

	<script>
		edits=document.getElementsByClassName('edit');
		len=edits.length;
		for(i=0;i<len;i++){
				edits[i].addEventListener("click",function(event){
					tr=event.target.parentElement.parentElement.parentElement;
					tds=tr.getElementsByTagName("td");
					title=tds[1].innerText;
					description=tds[2].innerText;
					editsno=tds[0].innerText;
					document.getElementById('editednotetitle').value=title;
					document.getElementById('editednote').value=description;
					document.getElementById('editsno').value=editsno;
					$("#editModal").modal('toggle');
					
				}
		
			);	
		
		
		}

		deletes=document.getElementsByClassName('delete');
		len=deletes.length;
		for(i=0;i<len;i++){
			deletes[i].addEventListener("click",function(event){
				tr=event.target.parentElement.parentElement.parentElement;
				deletesno=tr.getElementsByTagName("td")[0].innerText;
				document.getElementById("deletesno").value=deletesno;
				$("#deleteModal").modal('toggle');
			}
				
			);	
			
				
		}





	</script>

	<!-- Should Edit or Insert Javascript code -->
	
	<script >
		insertButton=document.getElementById("insertButton");
		insertButton.addEventListener("click",function(){
			document.getElementById("shouldedit").value=0;
		});

		editButton=document.getElementById("editButton");
		editButton.addEventListener("click",function(){

			document.getElementById("shouldedit2").value=1;
		});

	</script>




	
	
	
</body>
</html>