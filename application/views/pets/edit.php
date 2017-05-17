<?php
 ?>
 <div class="row">
   <div class="col-md-8 col-md-offset-2 ">
     <h3>ALTERAR PET</h3>
    <form class="form" action="/pet/<?php echo $pet->id ?>/alterar" name="formPet" method="post">
      <div class="form-group ">
        <label for="name">Nome</label>
        <input class="form-control" type="text" name="name" value="<?php echo $pet->name ?>">
      </div>
      <div class="form-group">
        <label for="age">Idade</label>
        <input class="form-control" type="text" name="age" value="<?php echo $pet->age ?>">
      </div>
      <div class="form-group">
        <label for="weight">Peso</label>
        <input class="form-control" type="text" name="weight" value="<?php echo $pet->weight ?>">
      </div>
      <div class="form-group">
        <label for="breed">Raça</label>
        <input class="form-control" type="text" name="breed" value="<?php echo $pet->breed ?>">
      </div>
      <div class="form-group">
        <label for="postage">Porte</label>
        <input class="form-control" type="text" name="postage" value="<?php echo $pet->postage ?>">
      </div>
      <div class="form-group">
        <label for="description">Descrição</label>
        <input class="form-control" type="text" name="description" value="<?php echo $pet->description ?>">
      </div>
      <button for="formPet" class="btn btn-info" type="submit" name="btnSaveUpdate">Salvar</button>
      <button for="formPet" class="btn btn-warning" type="reset" name="btnReset">Limpar</button>
      <button for="formPet" class="btn btn-default" name="button">Cancelar</button>

    </form>
   </div>

 </div>
