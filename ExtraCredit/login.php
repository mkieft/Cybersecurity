<?php

$response = '';
$textBox = '';

if(isset($_POST['username']) && isset($_POST['password'])){
        //
        // TODO: Authenticate the user in the MySQL database!
        // Once you do this, you can then assign them a valid session cookie,
        // which they can take to the forum page and begin using the page
        //
        $sql = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password" );

        //check number of users in database
        $num_rows = mysql_num_rows($sql);
        if($num_rows > 0){
        	//grab and create session
        	$gid = mysql_query("SELECT * FROM users_column WHERE username = '$username' AND password = '$password");
        	$row = mysql_fetch_assoc($gid);
        	$uid = $row[userid];

        	//register the session
        	$_SESSION[valid_user]=$uid;

        	//send user to forum page 
        	//header("Location: forum.php?userid='.$userid);") userid is what the session include runs against 
        	 header("Location: forum.php");   
        }


           
}

if(isset($_POST['student']) != isset($_POST['mainText'])){
        $response = 'Error! one or more fields missing!';
        $color = 'red';
        $textBox = $_POST['mainText'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Login</title>
	<!-- TODO: Link the CSS file -->
</head>
<body>
	<div id="mainWrapper">
		<div id="bodyDiv">
		
			<section id="mainSection">
				<article>
					<header>
						<hgroup>
							<h1>Please log in to ask questions at our conference!</h1>
                                                        
                                                        <?php if($response){
                                                                echo '<br/><br/><h3 style="color:'.$color.';">'.$response.'<h3>';
                                                        }?>
						</hgroup>
					</header>
                                        
					<form action="login.php" method="POST" enctype="multipart/form-data">
                                                <br/>
                                                <h2>Please log in here!</h2>
                                                <br/>
                                                Username: <input type="text" name=""><br/>
                                                Password: <input type="text" name=""><br/>
                                                <input type="submit" value="Send" id="sendButton"/>
                                                
                                        </form>
                             
				</article>
			</section>
			
			
		
		</div>
		
	</div>
</body>
</html>