<?php
 ?>
 <div class="row">
   <div class="col-md-8 col-md-offset-2 ">
     <h3>Cadastrar Novo Pet</h3>
    <form class="form" action="/novo-pet" name="formPet" method="post">
      <div class="form-group ">
        <label for="name">Nome</label>
        <input class="form-control" type="text" name="name" value="">
      </div>
      <div class="form-group">
        <label for="age">Idade</label>
        <input class="form-control" type="text" name="age" value="">
      </div>
      <div class="form-group">
        <label for="weight">Peso</label>
        <input class="form-control" type="text" name="weight" value="">
      </div>
      <div class="form-group">
        <label for="breed">Raça</label>
        <input class="form-control" type="text" name="breed" value="">
      </div>
      <div class="form-group">
        <label for="postage">Porte</label>
        <input class="form-control" type="text" name="postage" value="">
      </div>
      <div class="form-group">
        <label for="description">Descrição</label>
        <input class="form-control" type="text" name="description" value="">
      </div>
      <button for="formPet" class="btn btn-info" type="submit" name="btnSave">Salvar</button>
      <button for="formPet" class="btn btn-warning" type="reset" name="btnReset">Limpar</button>
      <button for="formPet" class="btn btn-default" name="button">Cancelar</button>

    </form>
   </div>

 </div>
