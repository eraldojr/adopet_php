<?php

 ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="center-block text-center">
        <a href="#"><img class="img-responsive center-block" src="img/user.png" alt="Sua foto" width="300px" id="userImage" class="userImage"></a>
        <label class="text-center" for="userImage"><i>Clique na foto para alterá-la</i></label>
      </div>
      <form class="form" action="/atualizar-cadastro/" method="post" name="formUser">
        <label for="name">Nome</label>
        <input class="form-control" type="text" name="name" value="<?php echo $user->name ?>" placeholder="Nome">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" value="<?php echo $user->email ?>" placeholder="Email">
        <label for="phone">Telefone</label>
        <input class="form-control" type="text" name="phone" value="<?php echo $user->phone ?>" placeholder="Telefone">
        <label for="password">Senha</label>
        <input class="form-control" type="password" onkeydown="setChangePass();" name="pass" value="<?php echo "********" ?>" placeholder="Senha">
        <input type="text" name="changePass" id="changePass" hidden="hidden" value="false">
        <button type="submit" class="btn btn-info" name="submit" for="formUser">Salvar</button>
        <button class="btn btn-default" type="button" name="voltar" for="formUser">Voltar</button>
      </form>
    </div>
  </div>
</div>
