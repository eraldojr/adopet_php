<?php

 ?>
 <div class="row">
   <div class="col-md-8 col-md-offset-2 text-center">
     <h1>Meus Pets</h1>
   </div>
 </div>
 <div class="row">
   <div class="col-md-8 col-md-offset-2">
     <a href="/novo-pet">Cadastrar novo pet</a>
   </div>
 </div>
 <div class="row">
   <div class="col-md-8 col-md-offset-2">
     <table class="table table-hover table-responsive">
       <thead>
         <tr>
           <th>Nome</th>
           <th>Raça</th>
           <th>Ações</th>
         </tr>
       </thead>
       <tbody>
        <?php if(isset($pets)): ?>
            <?php foreach ($pets as $pet): ?>
              <tr>
                <td><?= $pet->name; ?></td>
                <td><?= $pet->breed; ?></td>
                <td>
                  <a href="/pet/<?php echo $pet->id?>/alterar">
                      <span class="glyphicon glyphicon-pencil"></span>
                  </a>
                  |
                  <a href="/pet/<?php echo $pet->id?>/excluir">
                      <span class="glyphicon glyphicon-remove"></span>
                  </a>
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
