<?php
if (!isset($pet)) {
  redirect('/meus-pets');
}
 ?>
 <!--Begin Modal Photo -->
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
             <h3 class="modal-title text-center">Adicionar foto do pet</h3>
           </div>
         </div>
       </div>
       <div class="modal-body">
       <div class="row">
         <div class="col-md-10 col-md-offset-1">
           <form class="form-horizontal" id="formFoto" enctype="multipart/form-data" action="/pet/<?php  echo $pet->id ?>/adicionar-foto" method="post">
             <div class="fileUpload btn btn-success">
               <span>Selecione</span>
               <input type="file" id="photo" name="photo"  onchange="setFileName(this.id)" title="Selecione uma foto" class="uploadPhoto">
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
 <!--End Modal Photo -->
 <!--Begin Modal Delete -->
 <div class="modal fade" id="modalDeletePet" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <div class="row">
           <div class="col-md-8 col-md-offset-2">
             <img src="/img/logo-md.png" class="img-responsive" alt="Logo Adopet" height="100px">
           </div>
         </div>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-md-12 text-center">
             <h3 class="modal-title text-center">Tem certeza que deseja excluir?</h3>
             <h4 class="text-muted"><i>Esta operação não poderá ser desfeita</i></h4>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <div class="row">
           <div class="col-md-6">
           <button class="btn btn-danger btn-block" onclick=" location.href ='<?php echo "excluir"?>' " name="button">Sim</button>
           </div>
           <div class="col-md-6">
             <button class="btn btn-default btn-block" type="button" data-dismiss="modal">Não</button>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!--End Modal Delete -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h1>Detalhes do Pet</h1>
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
               <img src="<?php echo DATAPATH . 'pets/' . $pet->id . '/' . $data[$pet->id]['photos'][$i] ?>" class="center-block img-responsive img-thumbnail img-deco" width="300px" alt="Imagens do pet">
             <?php else: ?>
               <a href="#" data-toggle="modal" data-target="#modalPhoto"><img src="<?php echo base_url('img/pets/pets.png') ?>" class="center-block img-responsive img-thumbnail img-deco" width="300px" alt="Imagens do pet"></a>
             <?php endif ?>
          </div>
        <?php endfor ?>
        </div>
      </div>
  </div>
  <div class="row">
    <h2 class="text-center">Dados</h2>
    <hr>
    <div class="col-md-6 col-md-offset-3 panel panel-default">
      <form  action="/pet/<?php echo $pet->id ?>/alterar" method="post">
        <div class="form-group">
          <label for="name">Nome</label>
          <input class="form-control" type="text" name="name" placeholder="Nome" value="<?php echo $pet->name ?>">
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="age">Idade</label>
              <input class="form-control" type="text" name="age" placeholder="Ex.: 6 meses" value="<?php echo $pet->age ?>">
            </div>
          </div>
          <div class="col-md-2 col-md-push-1">
            <div class="form-group">
              <label for="weight">Peso</label>
              <input class="form-control" type="text" name="weight" placeholder="Peso" value="<?php echo $pet->weight ?>">
            </div>
          </div>
          <div class="col-md-6 col-md-push-2">
            <div class="form-group">
              <label for="postage">Porte</label>
              <input class="form-control" type="text" name="postage" placeholder="Porte" value="<?php echo $pet->postage ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="breed">Raça</label>
              <input class="form-control" type="text" name="breed" placeholder="Raça" value="<?php echo $pet->breed ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="gender">Sexo</label>
              <input class="form-control" type="text" name="gender" placeholder="Sexo" value="<?php echo $pet->gender ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Descrição</label>
          <textarea class="form-control" name="description" rows="5" cols="80" placeholder="Descrição"><?php echo $pet->description ?></textarea>
        </div>
        <div class="col-md-4 col-md-offset-2">
          <button class="btn btn-block btn-info" type="submit" name="button">Salvar</button>
        </div>
      </form>
      <div class="col-md-4">
        <button class="btn btn-block btn-danger" name="delete" data-toggle="modal" data-target="#modalDeletePet" >Excluir</button>
        <div class="espaco">
      </div>

    </div>

    </div>
  </div>
  <div class="espaco-2x">
  </div>
</div>
<script src="/js/petsScript.js"></script>

</script>
