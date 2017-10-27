<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<title>Movie Database Query System - Search </title>
	<style>	
	.form-horizontal{
	    display:block;
	    width:50%;
	    margin:0 auto;
	}
	table{
		width: 50%;
	}
	table, th, td{
		border: 1px solid grey;
		border-collapse: collapse;
	}
	th,td{
		padding: 3px;
		text-align: left;
	}
	tr:nth-child(even){
		background-color: #eee;
	}
	tr:nth-child(odd){
		background-color: #fff;
	}
	th{
		background-color:white;
		color:black;
	}
	</style>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">Movie Database Query System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item ">
	        <a class="nav-link" href="./homepage.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="./update.php">Update</a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="./browse.php">Browse</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="./search.php">Search</a>
	      </li>
	    </ul>
	  </div>
	</nav>
</head>

<body>
		<input type="hidden" name="actor" value="<?php echo $_POST['actorOpt']; ?>">
		<ul class="nav nav-tabs flex-column">
			<li class="nav-item"><h2>Actor Information Page</h2></li>
		</ul >
		<ul class="nav nav-tabs flex-column">
			<li class="nav-item"><h4>Actor Information</h4></li>
			<?php
					$db_connection = mysql_connect("localhost", "cs143", "");
					if(!$db_connection){
						$errmsg = mysql_error($db_connection);
						echo "Connection failed: $errmsg <br/>";
						exit(1);
					}
					mysql_select_db("CS143", $db_connection);
					$actor = $_POST["actor"];
					if($actor){
						$query = "SELECT last, first, id, dob, dod FROM Actor WHERE id =".$actor.";";
						$rs=mysql_query($query, $db_connection) or die(mysql_error());
						$row=mysql_fetch_row($rs);
						$first=$row[1];
						$last=$row[0];
						$id=$row[2];
						$dob = $row[3];
						$dod = $row[4];
						echo '<li class="nav-item">Name:'.$first.' '.$last.'</li>';
						echo '<li class="nav-item">Date of Birth:'.$dob.'</li>';
						if(!$dob){
							echo '<li class="nav-item">Date of Death: Still Alive </li>';
						}
						else echo '<li class="nav-item">Date of Death:'.$dob.'</li>';
					}
			?>
		</ul>
		<ul class="nav nav-tabs flex-column">
			<li class="nav-item"><h4>Actor's Movies and Role</h4></li>
			<?php
				echo '<table>';
				echo '<tr>';
				echo '<th> Movie Title </th>';
				echo '<th> Role </th>';
				echo '</tr>';
				if($movie){
					$query="SELECT title, role FROM Moive M, MovieActor MA WHERE M.id=MA.mid AND MD.aid=".$id.";";
						$rs=mysql_query($query, $db_connection) or die(mysql_error());
						while($row = mysql_fetch_row($rs)) {
							$title=$row[0];
							$role=$row[1];
							echo '<tr>';
							echo '<td>'.$title.'</td>';
							echo '<td>'.$role.'</td>';
							echo '</tr>';	
						}							
					}
				}
				echo '</table>';
			mysql_close($db_connection); 
			?>
		</ul>
	</form>
</body>
</html>