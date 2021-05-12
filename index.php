<!DOCTYPE html>
<html>
<head>
	<title>Comentarios CRUD | PHP e AJAX</title>

	<link rel="stylesheet" href="assets/css/newStyle.css<?php echo '?t=' . date('His')?>">
</head>
<body>
	<section class="content">
		<div class="box_form">
			<div class="login">
			<h1>Deixe seu Comentário:</h1>
				<form>
					<div class="user">
						<label for="user">Usuario: </label><br>
						<input type="text" name="user" id="user"><br>
					</div>
					<div class="password">
						<label for="user">Usuario: </label><br>
						<input type="text" name="user" id="user">
					</div>
					<br>
					<input type="submit" form="form1" class="btn-sub" value="Login/Cadastrar."/>
				</form>
			</div>
			<form id="form1">
				<input type="hidden" name="id" id="id">
				<label for="name">Nome</label><br>
				<input type="text" name="name" id="name"/><br><br>

				<label for="comment">Comentário</label><br>
				<textarea name="comment" id="comment"></textarea><br><br>

				<input type="submit" form="form1" class="btn-sub" value="Enviar Comentário"/><br><br>
			</form>
		</div>

		<div class="box_comment">
			
		</div>
	</section>
	
	<script src="assets/js/jQuery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/script.js<?php echo '?t=' . date('His')?>"></script>
</body>
</html>