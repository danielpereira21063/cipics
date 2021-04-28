<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Usuarios extends CI_Controller {
    public function signup() {
        $dadosPagina['tituloPagina'] = 'Criar uma conta';

        if ( $this->input->method() != 'post' ) {
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/signup' );
            $this->load->view( 'layout/footer' );
            return;
        }

        if ( $this->input->post( 'text_senha' ) !== $this->input->post( 'text_senha_2' ) ) {
            $dados['erro'] = 'As senhas não correspondem';
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/signup', $dados );
            $this->load->view( 'layout/footer' );
            return;
        }

        $this->load->model( 'usuarios_model', 'usuarios' );
        if ( $this->usuarios->signup_check_user() ) {
            $dados['erro'] = 'Já existe um usuário com o mesmo e-mail';
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/signup', $dados );
            $this->load->view( 'layout/footer' );
            return;
        }

        //executa o signup
        $this->usuarios->signup_criar_conta();
        //exibe as views
        $dadosPagina['tituloPagina'] = 'Conta criada com successo';
        $this->load->view( 'layout/header', $dadosPagina );
        $this->load->view( 'usuarios/signup_sucesso' );
        $this->load->view( 'layout/footer' );
    }



    public function login() {
        $dadosPagina['tituloPagina'] = 'Login';
        if ( $this->input->method() != 'post' ) {
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/login' );
            $this->load->view( 'layout/footer' );
            return;
        }

        if ( $this->input->post( 'text_email' ) == '' || $this->input->post( 'text_senha' ) == '' ) {
            $dados['erro'] = 'Os dois campos são de preenchimento obrigatório';
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/login', $dados );
            $this->load->view( 'layout/footer' );
            return;
        }

        $this->load->model( 'usuarios_model', 'usuarios' );
        if ( $this->usuarios->verificar_login() ) {
            redirect( '' );
        } else {
            $dados['erro'] = 'E-mail ou senha inválidos';
            $this->load->view( 'layout/header', $dadosPagina );
            $this->load->view( 'usuarios/login', $dados );
            $this->load->view( 'layout/footer' );
        }
    }

    public function logout() {
        if($this->session->has_userdata('id_usuario')) {
            $this->session->unset_userdata('id_usuario');
            $this->session->unset_userdata('usuario');
            $this->session->unset_userdata('email');
            redirect('inicio');
        } else {
            redirect('inicio');
        }
    }
}