<!DOCTYPE html>
<html>
<head></head>
<body>
   
   <div id="login_form">
   	<h1>Anmelden zu ProjectTogether</h1>
   	<form action="ProjectFeed.php" method="post">
   		<label for="username_input">Dein Benutzername:</label>
   		<input id="username_input_login" name="username" type="text"/>
   		
   		<label for="password_input">Dein Passwort:</label>
   		<input id="password_input_login" name="password" type="password"/>
   		
   		<button type="submit">Loslegen</button>
   	</form>
   	
   	</div>
   	<div id="register_button">
   	
   	<button type="button" onclick="hideAndShow()">Ich habe noch keinen Account!</button>

   	</div>

   <div id="register_form">
   	<h1>Registrieren zu ProjectTogether</h1>
   	<form action="register.php" method="post">
   		<label for="username_input">Dein Benutzername:</label>
   		<input id="username_input_register" name="username" type="text"/>
   		
   		<label for="mail_input">Deine E-Mail:</label>
   		<input id="mail_input_register" name="mail" type="email"/>
   		
   		<label for="password_input">Dein Passwort:</label>
   		<input id="password_input_register" name="password" type="password"/>
   		
   		<button type="submit">Registrieren</button>
   	</form>
   	
   	   </div>

   	
   	<script>
   		
   		document.getElementById('register_form').style.display='none'; 
        
   		function hideAndShow(){
		
            document.getElementById('login_form').style.display='none';
            document.getElementById('register_button').style.display='none'; 
            document.getElementById('register_form').style.display='block'; 
		
   		}
   		
   	</script>
   	
   
   	
   	
   	
   
</body>
</html>

