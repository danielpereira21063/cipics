<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-8 offset-3 offset-2 m-auto">
            <div class="card p-4">
                <h4 class="text-center">Nova conta de usuário</h4>
                <hr>
                <form action="<?=site_url('usuarios/signup')?>" method="POST">
                    <?php if(isset($erro)): ?>
                        <p class="alert alert-danger text-center"><?=$erro?></p>
                    <?php endif; ?>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome de usuário" name="text_usuario" required autofocus>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Endereço de e-mail" name="text_email" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Senha" name="text_senha" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Repita a senha" name="text_senha_2" required>
                    </div>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-block btn-primary" href="<?=site_url('inicio')?>">Cancelar</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-primary" type="submit">Criar conta</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>