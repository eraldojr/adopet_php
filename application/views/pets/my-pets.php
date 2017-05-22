<?php
 ?>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-8 col-md-offset-2 text-center">
       <h1>MEUS PETS</h1>
     </div>
   </div>
   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <a id="linkNewPet" href="/novo-pet"><h3><img src="/img/add3.png" width="30"> Cadastrar novo pet</h3></a>
     </div>
   </div>
   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <table class="table table-hover table-responsive">
         <tbody>
          <?php if($pets != null): ?>
              <?php foreach ($pets as $pet): ?>
                <tr onclick="petDetail(<?php echo $pet->id ?>);">
                  <?php if($data != null): ?>
                  <td width="100px "><img src="<?php echo  DATAPATH . 'pets/' . $pet->id . '/'  .  $data[$pet->id]['photos'][2] ?>" class="center-block img-responsive img-thumbnail img-deco" width="100px" alt="Imagens do pet"></td>
                  <?php else: ?>
                    <td width="100px "><img src="<?php echo  base_url('img/pets/pets.png') ?>" class="center-block img-responsive img-thumbnail img-deco" width="100px" alt="Imagens do pet"></td>
                  <?php endif ?>
                  <td><p class="itemTable"><?= $pet->name?></p></td>
                  <td>
                    <p class="itemTable itemTable2">
                      <a href="/pet/<?php echo $pet->id?>/alterar">
                            Editar
                            <i class="fa fa-edit (alias) fa-lg"></i>
                      </a>
                      |
                      <a href="/pet/<?php echo $pet->id?>/excluir">
                        Excluir
                      <i class="fa fa-close (alias) fa-lg"></i>
                      </a>
                    </p>
                  </td>
                </tr>
              <?php endforeach ?>
          <?php else: ?>
            <h3>Parece que não há nada aqui...</h3>
          <?php endif ?>
        </tbody>

      </table>
     </div>
   </div>
 </div>
 <script src="/js/petsScript.js"></script>
