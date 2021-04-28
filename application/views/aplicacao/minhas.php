<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid bg-secondary mt-3 pt-4 pb-4">
    <h4 class="text-center pt-2 pb-3 text-white">
        Minhas fotos
    </h4>

    <?php if(count($fotos) > 0): ?>
        <div class="row">
            <?php foreach($fotos as $foto): ?>
                <div class="col-sm-4 col-md-4 col-xl-2 col-lg-3 col-6">
                    <!-- FOTO PÚBLICA -->
                    <?php if($foto['publica']): ?> 
                        <div class="foto-info-publica">
                            <div class="row p-1">
                                <div class="col-8 text-left">
                                    <div class="p-2">
                                        <small><?=$foto['data_hora']?></small>
                                    </div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="p-0">
                                        <a class="mr-3" href="<?=site_url('aplicacao/privada/'.$foto['id_foto'])?>"><i class="fa fa-unlock-alt"></i></a>
                                        <a href="<?=site_url('aplicacao/excluir/'.$foto['id_foto'])?>"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- FOTO PRIVADA -->
                        <div class="foto-info-privada">
                            <div class="row p-1">
                                <div class="col-8 text-left">
                                    <div class="p-2">
                                        <small><?=$foto['data_hora']?></small>
                                    </div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="p-0">
                                        <a class="mr-3" href="<?=site_url('aplicacao/publica/'.$foto['id_foto'])?>"><i class="fa fa-lock"></i></a>
                                        <a href="<?=site_url('aplicacao/excluir/'.$foto['id_foto'])?>"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="foto-size p-2">
                        <img class="img-fluid" src="<?=site_url('assets/fotos/'.$foto['foto'])?>" alt="img">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Não existem fotos na sua conta</p>
    <?php endif; ?>
</div>