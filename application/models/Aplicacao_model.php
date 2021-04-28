<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Aplicacao_model extends CI_Model {
    public function fotos_publicas() {
        $resultado = $this->db
        ->select('*')
        ->from('fotos')
        ->join('usuarios', 'usuarios.id_usuario = fotos.id_usuario')
        ->where('publica', true)
        ->get();
        
        return $resultado->result_array();
    }


    public function armazenar_foto($nomeFoto, $publica) {
        $dados = [
            'id_usuario' => $this->session->id_usuario,
            'foto' => $nomeFoto,
            'data_hora' => date('Y-m-d H:m:s'),
            'publica' => $publica
        ];
        $this->db->insert('fotos', $dados);
    }

    public function fotos_usuario() {
        $resultado = $this->db
        ->select('*')
        ->from('fotos')
        ->join('usuarios', 'usuarios.id_usuario = fotos.id_usuario')
        ->where('fotos.id_usuario', $this->session->id_usuario)
        ->get();
        
        return $resultado->result_array();
    }

    public function mudar_para_privada($id) {
        $this->db
        ->set('publica', false)
        ->where('id_foto', $id)
        ->update('fotos');
    }
    public function mudar_para_publica($id) {
        $this->db
        ->set('publica', true)
        ->where('id_foto', $id)
        ->update('fotos');
    }

    public function excluir_foto($id) {
        $resultado = $this->db
        ->from('fotos')
        ->where('id_foto', $id)
        ->get();
        
        if($resultado->num_rows !== 0) {
            $this->db->delete('fotos', array('id_foto' => $id));

            $foto = $resultado->row()->foto;
            if(file_exists('./assets/fotos/'.$foto)) {
                unlink('./assets/fotos/'.$foto);
            }
        }
    }
}