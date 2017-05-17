<?php
 ?>

 <div class="row">
   <div class="col-md-8 col-md-offset-2 ">
     <h3>CADASTRAR NOVO PET</h3>
    <form class="form" action="/novo-pet" enctype="multipart/form-data" name="formPet" method="post">
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
        <textarea class="form-control" name="description" rows="3" cols="80"></textarea>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="fileUpload btn btn-success">
            <span>Selecione</span>
            <input type="file" id="photo1" name="photo1"  onchange="setFileNameCreate(this.id);" title="Selecione uma foto" class="uploadPhoto">
          </div>
          <input id="uploadFileName1" placeholder="Selecione uma foto" disabled="disabled" />
        </div>
        <div class="col-md-4">
          <div class="fileUpload btn btn-success">
            <span>Selecione</span>
            <input type="file" id="photo2" name="photo2" onchange="setFileNameCreate(this.id);" title="Selecione uma foto" class="uploadPhoto">
          </div>
          <input id="uploadFileName2" placeholder="Selecione uma foto" disabled="disabled" />
        </div>
        <div class="col-md-4">
          <div class="fileUpload btn btn-success">
            <span>Selecione</span>
            <input type="file" id="photo3" name="photo3" onchange="setFileNameCreate(this.id);" title="Selecione uma foto" class="uploadPhoto">
          </div>
          <input id="uploadFileName3" placeholder="Selecione uma foto" disabled="disabled" />
        </div>
      </div>
      <div class="row">
        <hr>
        <div class="col-md-2 col-md-offset-3">
          <button for="formPet" class="btn btn-info btn-block" type="submit" name="btnSave">Salvar</button>
        </div>
        <div class="col-md-2">
          <button for="formPet" class="btn btn-warning btn-block" type="reset" name="btnReset">Limpar</button>
        </div>
        <div class="col-md-2">
          <button for="formPet" class="btn btn-default btn-block" name="button">Cancelar</button>
        </div>

      </div>
    </form>
   </div>

 </div>
<script src="js/petsScript.js"></script>
