<?php

 ?>
<div class="container-fluid">
  <section>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h1>MEUS DADOS</h1>
      </div>
    </div>
    <!--Begin Modal Login -->
    <div class="modal fade" id="modalPhoto" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <img src="/img/logo-md.png" class="img-responsive" alt="Logo Adopet" height="100px">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3 class="modal-title text-center">Trocar foto de perfil</h3>
              </div>
            </div>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <form class="form-horizontal" id="formFoto" enctype="multipart/form-data" action="/atualizar-foto" method="post">
                <div class="fileUpload btn btn-success">
                  <span>Selecione</span>
                  <input type="file" id="photo" name="photo"  onchange="setFileName()" title="Selecione uma foto" class="uploadPhoto">
                </div>
                <input id="uploadFileName" placeholder="Selecione uma foto" disabled="disabled" />
              </form>
            </div>
          </div>
          </div>
          <div class="modal-footer">
              <button type="submit" form="formFoto" class="btn btn-info">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
    <!--End Modal Login -->
  </section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="text-center">
          <?php if($data['photo'] == null): ?>
            <a href="#" data-toggle="modal" data-target="#modalPhoto"><img class="img-responvive img-circle center-block" width="300" src="<?php echo  base_url('/img/users/user.png')  ?>" alt="Sua foto" width="300px" id="userImage" class="userImage"></a>-
          <?php else: ?>
            <a href="#" data-toggle="modal" data-target="#modalPhoto"><img class="img-responvive img-circle center-block" width="300" src="<?php echo DATAPATH . 'users/' . $user->email . '/'  .  $data['photo'][2]  ?>" alt="Sua foto" width="300px" id="userImage" class="userImage"></a>
          <?php endif ?>
        <label class="text-center text-muted" for="userImage"><i>Clique na foto para alterá-la</i></label>
        </div>
        <form class="form" action="/atualizar-cadastro/" method="post" name="formUser">
          <label for="name">Nome</label>
          <input class="form-control" type="text" name="name" value="<?php echo $user->name ?>" placeholder="Nome">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" value="<?php echo $user->email ?>" placeholder="Email">
          <label for="phone">Telefone</label>
          <input class="form-control" type="text" name="phone" value="<?php echo $user->phone ?>" placeholder="Telefone">
          <label for="password">Senha</label>
          <input class="form-control" type="password" onkeydown="setChangePass();" name="pass" value="" placeholder="Senha">
          <input type="text" name="changePass" id="changePass" hidden="hidden" value="false">
          <button type="submit" class="btn btn-info" name="submit" for="formUser">Salvar</button>
          <button class="btn btn-default" type="button" name="voltar" for="formUser">Voltar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="/js/userScript.js"></script>
