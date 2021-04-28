<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Usuarios_model extends CI_Model {
    public function signup_check_user() {
        $usuario = $this->input->post('text_usuario');
        $resultado = $this->db
        ->from('usuarios')
        ->where('usuario', $usuario)
        ->get();
        return $resultado->num_rows() !== 0 ? true : false;
    }

    public function signup_criar_conta() {
        $dados = [
            'usuario' => $this->input->post('text_usuario'),
            'email' => $this->input->post('text_email'),
            'senha' => md5($this->input->post('text_senha'))
        ];
        $this->db->insert('usuarios', $dados);
    }

    public function verificar_login() {
        $dados = [
            'email' => $this->input->post('text_email'),
            'senha' => md5($this->input->post('text_senha'))
        ];
        $resultado = $this->db->from('usuarios')->where($dados)->get();
        if($resultado->num_rows() != 0) {
            $this->session->set_userdata(
                [
                    'id_usuario' => $resultado->row()->id_usuario,
                    'usuario' => $resultado->row()->usuario,
                    'email' => $resultado->row()->email
                ]
            );
            return true;
        } else {
            return false;
        }
    }
}