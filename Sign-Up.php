<!DOCTYPE html>
<html>
    
<head>
	<title>SignUp</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<div class="container" id="wrap">
	  <div class="row">
        <div class="col-md-6 col-md-offset-3" >
		<div class="brand_logo_container">
						<img src="./images/icon.png"  alt="ToDoListApp">
					</div>
            <form action="./controllers/signup.php" method="post" accept-charset="utf-8" class="form" role="form">   <legend>Sign Up in ToDoApp</legend>
                    <h4>It's free and always will be... I hope</h4>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
							<input type="text" name="firstname" value="" class="form-control input-lg" placeholder="First Name"  />
						</div>
                        <div class="col-xs-6 col-md-6">
							<input type="text" name="lastname" value="" class="form-control input-lg" placeholder="Last Name"  />
						</div>
                    </div>
                    <input type="text" name="email" value="" class="form-control input-lg" placeholder="Your Email"  />
					<input type="password" name="password" value="" class="form-control input-lg" placeholder="Password"  />
					<div class="row">
					<br />
			  <span class="help-block">By clicking Create my account, you will have access to all the functions of ToDoApp.</span>		
                    <button class="btn btn-lg btn-success btn-block signup-btn" type="submit">
                        Create my account</button>
						<div class="mt-4">
			  <div class="d-flex justify-content-center links">
						Or <a href="./index.html" class="ml-2">Login</a>					
					</div>
</div>
					</form>  
			        
          </div>
</div>            
</div>
</div>
</body>
</html>