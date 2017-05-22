<?php
if (!isset($pet)) {
  redirect('/adote');
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h1>DETALHES DO PET</h1>
    </div>
  </div>
  <div class="row">
      <h2 class="text-center">Fotos</h2>
      <hr>
      <div class="col-md-12">
        <div class="row">
          <?php for ($i=2; $i < 5; $i++):?>
           <div class="col-md-4">
             <?php if(isset($data[$pet->id]['photos'][$i])): ?>
               <img src="<?php echo DATAPATH . 'pets/' . $pet->id . '/'  .  $data[$pet->id]['photos'][$i] ?>" class="center-block img-responsive img-thumbnail img-deco" width="300px" alt="Imagens do pet">
             <?php endif ?>
          </div>
        <?php endfor ?>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center">Dados</h2>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 panel panel-default">
      <label for="owner">Anunciante</label>
      <input type="text"  class="form-control" name="owner" id="owner" value="<?php echo $owner['name'] ?>" readonly="">
      <div class="row">
        <div class="col-md-6">
          <label for="owner">Telefone</label>
          <input type="text"  class="form-control" name="phone" id="phone" value="<?php echo $owner['phone'] ?>" readonly="">
        </div>
        <div class="col-md-6">
          <label for="owner">Email</label>
          <input type="text"  class="form-control" name="email" id="email" value="<?php echo $owner['email'] ?>" readonly="">
        </div>
      </div>
      <div class="espaco"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 panel panel-default">
      <div class="form-group">
        <label for="name">Nome</label>
        <input class="form-control" type="text" name="name" placeholder="Nome" value="<?php echo $pet->name ?>" readonly>
      </div>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label for="age">Idade</label>
            <input class="form-control" type="text" name="age" placeholder="Ex.: 6 meses" value="<?php echo $pet->age ?>" readonly>
          </div>
        </div>
        <div class="col-md-2 col-md-push-1">
          <div class="form-group">
            <label for="weight">Peso</label>
            <input class="form-control" type="text" name="weight" placeholder="Peso" value="<?php echo $pet->weight ?>" readonly>
          </div>
        </div>
        <div class="col-md-6 col-md-push-2">
          <div class="form-group">
            <label for="postage">Porte</label>
            <input class="form-control" type="text" name="postage" placeholder="Porte" value="<?php echo $pet->postage ?>" readonly>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="breed">Raça</label>
            <input class="form-control" type="text" name="breed" placeholder="Raça" value="<?php echo $pet->breed ?>" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="gender">Sexo</label>
            <input class="form-control" type="text" name="gender" placeholder="Sexo" value="<?php echo $pet->gender ?>" readonly>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="description">Descrição</label>
        <textarea class="form-control" name="description" rows="3" cols="80" placeholder="Descrição" readonly><?php echo $pet->description ?></textarea>
      </div>
    </div>
  </div>
  <div class="espaco-2x"></div>
</div>
<script src="/js/petsScript.js"></script>

</script>
