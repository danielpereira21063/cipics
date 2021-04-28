<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplicacao extends CI_Controller {
    
    private function controle() {
        if(!$this->session->has_userdata('id_usuario')) {
            redirect('home');
        }
    }

    public function index() {
        $this->controle();
        $dadosPagina['tituloPagina'] = 'Aplicação';
        //faz a busca pelas imagens que são públicas
        $this->load->model('aplicacao_model', 'aplicacao');
        $dados['fotos'] = $this->aplicacao->fotos_publicas();

        $this->load->view('layout/header', $dadosPagina);
        $this->load->view('aplicacao/barra_usuario');
        $this->load->view('aplicacao/pagina_inicial', $dados);
        $this->load->view('layout/footer');
        
    }

    public function adicionar() {
        $this->controle();
        $dadosPagina['tituloPagina'] = 'Adicionar foto';
        
        if($this->input->method() != 'post') { //se não existir nenhum post
            $dados['erros'] = '';
            $this->load->view('layout/header', $dadosPagina);
            $this->load->view('aplicacao/barra_usuario');
            $this->load->view('aplicacao/adicionar_foto', $dados);
            $this->load->view('layout/footer');
            return;
        }

        $config = [ //configuracao da foto
            'upload_path' => './assets/fotos/',
            'allowed_types' => 'jpg|png|jpeg',
            'max_size' => 1024,
            'max_width' => 2048,
            'max_height' => 2048
        ];
        $arquivo = $_FILES['arquivo_foto']['name']; //pega o nome do arquivo vindo do formulario
        $arquivoSemExtensao = pathinfo($arquivo, PATHINFO_FILENAME); //pega o nome do arquivo sem sua extensão
        $arquivoExtensao = pathinfo($arquivo, PATHINFO_EXTENSION); //pega a extensão do arquivo sem o seu nome

        $this->load->helper('nome_arquivo'); //carrega o helper "nome_arquivo_helper"
        $nomeFotoFinal = definirNomeArquivo($arquivoSemExtensao, $arquivoExtensao); //define o nome do arquivo com um sufixo de letras aleatórias
        $config['file_name'] = $nomeFotoFinal; //define o nome final do arquivo com o sufixo gerado na funcao "definirNomeArquivo"


        $this->load->library('upload', $config); //carrega a biblioteca upload e define suas configurações
        if($this->upload->do_upload('arquivo_foto')) {
            $this->load->model('aplicacao_model', 'aplicacao');

            $publica = true;
            if($this->input->post('check_publica') === null) {
                $publica = false;
            }

            //indica que a foto foi carregada com sucesso
            $this->aplicacao->armazenar_foto($nomeFotoFinal, $publica);
            $this->load->view('layout/header');
            $this->load->view('aplicacao/sucesso');
            $this->load->view('layout/footer');
        } else {
            //erro ao carregar foto
            $dados['erro'] = $this->upload->display_errors();
            $this->load->view('layout/header', $dadosPagina);
            $this->load->view('aplicacao/erro', $dados);
            $this->load->view('layout/footer');
        }
    }

    public function minhas() {
        $this->controle();
        $dadosPagina['tituloPagina'] = 'Minhas fotos';

        $this->load->model('aplicacao_model', 'aplicacao');
        $dados['fotos']= $this->aplicacao->fotos_usuario();
        $this->load->view('layout/header', $dadosPagina);
        $this->load->view('aplicacao/barra_usuario');
        $this->load->view('aplicacao/minhas', $dados);
        $this->load->view('layout/footer', $dados);
    }

    public function privada($id) {
        $this->controle();

        $this->load->model('aplicacao_model', 'aplicacao');
        $this->aplicacao->mudar_para_privada($id);
        redirect('aplicacao/minhas');
    }

    public function publica($id) {
        $this->controle();

        $this->load->model('aplicacao_model', 'aplicacao');
        $this->aplicacao->mudar_para_publica($id);
        redirect('aplicacao/minhas');
    }
    
    public function excluir($id) {
        $this->controle();

        $this->load->model('aplicacao_model' , 'aplicacao');
        $this->aplicacao->excluir_foto($id);
        redirect('aplicacao/minhas');
    }
}