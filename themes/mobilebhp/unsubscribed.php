				<?php
			      include("connect.php");
				 $email=base64_decode($_POST['email']);
									$sql_num_rows=@mysqli_num_rows(mysqli_query("select * from subscribefornewsletter where email='".$email."'"));
										if($sql_num_rows==1)
											{
											$del_email=@mysqli_query("delete from subscribefornewsletter where email='".$email."'");
											}
											else
											{
											echo "Email does not exist";
											}
				
				?>
							 
