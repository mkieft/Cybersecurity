<?php

/* 
    TODO: Don't let users log in here until they have been authenticated
    If they try to come here without a valid session, they should be rejected and 
    sent to the login page. You should also probably clean up this code a bit.
*/

$response = '';
$textBox = '';

if(isset($_POST['student']) && isset($_POST['mainText'])){
        if($_POST['mainText']){
                $is_student = true; // TODO: Update this
                $question = ucfirst($_POST['mainText']);
                if(strlen($question) < 5){
                        $con = mysqli_connect('', '', '', '') or die('Could not connect to mySQL server!');
                        
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        
                        $query = ""; // MySQL query should be structured according to DB
                        
                        //@mysqli_multi_query($con, $query); // Use this when you want to hack the site
                        @mysqli_query();
                        
                        $response = "Question submitted successfully!";
                        $color = 'green';
                }
                else{
                        $textBox = $question;
                        $response = 'Your question was *a little* too long';
                        $color = 'red';
                }
        }
        else{
                $response = 'Error! one or more fields missing!';
                $color = 'red';
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
	<title>Questions</title>
	<link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="test.css">
</head>
<body>
	<div id="mainWrapper">
		<div id="bodyDiv">
		
			<section id="mainSection">
				<article>
					<header>
						<hgroup>
							<h1>Have questions? Ask them at our conference!</h1>
                                                        
                                                        <?php if($response){
                                                                echo '<br/><br/><h3 style="color:'.$color.';">'.$response.'<h3>';
                                                        }?>
						</hgroup>
					</header>
                                        
					<form action="" method="POST" enctype="multipart/form-data">
                                                <br/>Are you a student?<br/>
                                                <input type="radio" name="student" value="Yes">Yes<br>
                                                <input type="radio" name="student" value="No">No<br>
                                                <br/>Ask your question below:<br/>
                                                <textarea id="suggest" placeholder="Example: What is a cross-site scripting attack?" 
                                                rows="6" cols="100" name="" ><?php echo $textBox; ?></textarea>
                                                <br/>
                                                <input type="submit" value="Send" id="sendButton"/>
                                                
                                        </form>
                                        
				</article>
                                
                                <article>
					<header>
						<hgroup>
							<h1>Take a look at some questions already asked!</h1>
						</hgroup>
					</header>
                                        
					<table>
                                                <tr>
                                                        <th>Student?</th>
                                                        <th>Question</th>
                                                </tr>
                                                <?php
                                                $con = mysqli_connect('', '', '', '') or die('Could not connect to mySQL server!');
                                                
                                                $query = "SELECT * FROM `XSS` ORDER BY Student, Question";
                                                
                                                if($results = mysqli_query($con, $query)){
                                                        while($row = mysqli_fetch_array($results)){
                                                                echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
                                                        }
                                                        
                                                }
                                                else{
                                                        echo mysqli_error($con);
                                                }
                                                
                                                ?>
                                                
                                        </table>
                                        
				</article>
			</section>
			
			
		
		</div>
		
	</div>
</body>
</html>