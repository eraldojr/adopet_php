<?php

 ?>
 <div class="row">
   <div class="col-md-8 col-md-offset-2 text-center">
     <h1>ADOTE</h1>
   </div>
 </div>
 <div class="row">
   <div class="col-md-8 col-md-offset-2">
     <table class="table table-hover table-responsive">
       <tbody>
        <?php if(isset($pets)): ?>
            <?php foreach ($pets as $pet): ?>
              <tr onclick="petShow(<?php echo $pet->id ?>);">
                <?php if(isset($data[$pet->id][2])): ?>
                <td width="100px  "><img src="<?php echo base_url('/uploads/pets/' . $pet->id . '/'  .  $data[$pet->id][2] ) ?>" class="center-block img-responsive img-thumbnail img-deco" width="100px" alt="Imagens do pet"></td>
                <?php endif ?>
                <td><p class="itemTable"><?= $pet->name; ?></p></td>
              </tr>
            <?php endforeach ?>
        <?php else: ?>
          <h3>Parece que não há nada aqui...</h3>
        <?php endif ?>
      </tbody>

    </table>
   </div>
 </div>

 <script src="/js/petsScript.js"></script>
