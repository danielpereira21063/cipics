<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 offset-sm-3 card p-4 mt-2">
            <?= $erros ?>

            <h3>Adicionar foto</h3>
            <hr>
            <?=form_open_multipart('aplicacao/adicionar')?>
            <div class="form-group">
                <input class="form-control" type="file" name="arquivo_foto" id="check_publica" required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check_publica" checked>
                <label class="form-check-label" for="check_publica">Definir foto como pública</label>
            </div>

            <div class="text-center mt-3">
                <a class="btn btn-primary" href="<?=base_url('aplicacao')?>">Cancelar</a>
                <button class="btn btn-primary" type="submit">Adicionar</button>
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>
