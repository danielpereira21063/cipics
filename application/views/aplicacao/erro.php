<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-5 mb-5">
    <div class="text-center alert alert-danger">
        <?=$erros?>
    </div>

    <div class="text-center">
        <a class="btn btn-primary" href="<?=base_url('aplicacao')?>">Cancelar</a>
        <a class="btn btn-primary" href="<?=base_url('aplicacao/adicionar')?>">Tentar novamente</a>
    </div>
</div>