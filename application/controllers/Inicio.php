<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
    public function index() {

        if($this->session->has_userdata('id_usuario')) {
            redirect('aplicacao');
        } else {
            $this->home();
        }
    }
    
    public function home() {
        if($this->session->has_userdata('id_usuario')) {
            redirect('aplicacao');
        } else {
            $dados =[
                'tituloPagina' => 'CIPICS'
            ];
            $this->load->view('layout/header', $dados);
            $this->load->view('home');
            $this->load->view('layout/footer');
        }
    }
}