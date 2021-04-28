<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>
<div class="container-fluid bg-secondary mt-3 pt-4 pb-4">
    <h4 class="text-center pt-2 pb-2 text-white">Fotos públicas</h4>

    <?php if(count($fotos) != 0): ?>
        <div class="row">
            <?php foreach($fotos as $foto): ?>
                <div class="col-sm-4 col-md-4 col-xl-2 col-lg-3 col-6">
                    <div class="p-1 foto-info text-center">
                        <p><?=$foto['usuario']?></p>
                        <small class="text-center"><?=$foto['data_hora']?></small>
                    </div>
                    <div class="p-2 text-center">
                        <img class="img-fluid mb-5" src="<?=base_url('assets/fotos/'.$foto['foto'])?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Não foram encontradas fotos públicas.</p>
    <?php endif; ?>
</div>