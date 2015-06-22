<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->library('sistema');
        init_painel();
    }

    public function index(){
            $this->load->view('');
    }
    
    public function login(){
        $this->form_validation->set_rules('usuario', 'USUÁRIO', 'trim|required|min_lenght[4]|strtolower');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_lenght[4]|strtolower');
        if($this->form_validation->run() == TRUE):
            $usuario = $this->input->post('usuario', TRUE);
            $senha = md5($this->input->post('senha', TRUE));
            if($this->usuarios->do_login($usuario, $senha) == TRUE):
                echo 'login OK';
            else:
                echo 'login falou';
            endif;
        else:
        endif;
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'login'));
        set_tema('rodape', '');
        load_template();
    } 
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */