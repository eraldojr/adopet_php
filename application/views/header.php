<?php
$user = null;
if(isset($this->session)){
  $user = $this->session->user;
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="stylesheet" href="/css/bootstrap.min.css">
    <link  rel="stylesheet" href="/css/style.css">

    <title>Adopet</title>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><img src="/img/logo-mini.png" height="50px" alt="Logo Adopet"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Início</a></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#">Adote</a></li>
            <li><a href="#">Contato</a></li>
            <?php if($user == null ):?>
            <li><a href="#" data-toggle="modal" data-target="#modalLogin">Entrar</a></li>
            <?php else:?>
            <li><a href="/logout">Olá, <?php echo $user->name ?></a></li>
            <?php endif?>
          </ul>
        </div>
      </div>
    </nav>
    <!--Begin Modal Login -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog">
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
                <h4 class="modal-title text-center">Seja bem vindo!</h4>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="formLogin" action="/login" method="post">
              <div class="form-group">
                <div class="row col-md-8 col-md-offset-2">
                  <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email" required="true" title="Digite seu email">
                </div>
              </div>
              <div class="form-group">
                <div class="row col-md-8 col-md-offset-2">
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha" required="true" title="Digite sua senha">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <a href="/recuperar-senha">Esqueci minha senha</a>
                </div>
                <div class="col-md-12 text-center">
                  <a href="/registro">Ainda não é cadastrado?</a>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
              <button type="submit" form="formLogin" class="btn btn-info">Entrar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--End Modal Login -->
    </header>
