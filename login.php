
<main class="form-signin w-100 m-auto">
	<form action="auxiliar.php?login=1" method="POST" >
		<img class="mb-4" src="images/cerveja.jpg" alt="imagem login" width="175" height="175">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="nome@example.com" name="email" required>
      <label for="email">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" id="senha" name="senha" required>
      <label for="senha">Senha</label>
    </div>
	<div class="form-group">
			<input class="w-100 btn btn-lg btn-primary" name="enviar" id="enviar" type="submit" value="Enviar"  />
			<footer>
			<p class="mt-5 mb-3 text-muted">&copy; 2022 - Guilherme Biasus</p>
			</footer>
		</div>
	</form>
</main>