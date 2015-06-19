<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//carrega um modulo do sistema devolvendo a tela solicitada
    function load_modulo($modulo = NULL, $tela = NULL, $diretorio = 'painel'){
        
        $CI =& get_instance();
        if($modulo != NULL):
            return $CI->load->view("$diretorio/$modulo", array('tela'=>$tela), TRUE);
        else:
            return FALSE;
        endif;
    }

//seta valores ao array $tema da classe sistema
    function set_tema($propr, $valor, $replace = TRUE){
        
        $CI =& get_instance();
        $CI->load->library('sistema');
         if($replace):
             $CI->sistema->tema[$propr] = $valor;
            else:
            if(!isset($CI->sistema->tema[$propr])):
                $CI->sistema->tema[$propr] = '';
            endif;
            $CI->sistema->tema[$propr] .= $valor;
         endif;
    }
    
//retornar os valores do array $tema da classe sistema
    function get_tema(){
        
        $CI =& get_instance();
        $CI->load->library('sistema');
        return $CI->sistema->tema;
    }

// inicializar o painel ADM carregando os recursos necessarios
    function init_painel(){
        
        $CI =& get_instance();
        $CI->load->library(array('sistema', 'parser', 'session', 'form_validation'));
        $CI->load->helper(array('form','url', 'array', 'text'));
        
        //carregamento dos models
        
        set_tema('titulo_padrao', 'Painel ADM');
        set_tema('rodape', '<p>&copy; 2015 | Todos os direitos reservados');
        set_tema('template', 'painel_view');
        set_tema('headerinc', load_css(array('bootstrap.min', 'bootstrap')), FALSE);
        set_tema('footerinc', load_js(array('bootstrap.min')));
    }
    
//carrega um template passando o array $tema como parametro
    function load_template(){
        
        $CI =& get_instance();
        $CI->load->library('sistema');
        $CI->parser->parse($CI->sistema->tema['template'], get_tema());
        
    }

// carregar um ou varios arquivos .css de uma pasta
    function load_css($arquivo = NULL, $pasta = 'css', $midia = 'all'){
        
        if($arquivo != NULL):
            $CI =& get_instance();
            $CI->load->helper('url');
            $retorno = '';
            if(is_array($arquivo)):
                foreach ($arquivo as $css):
                    $retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$midia.'" />';
                endforeach;
                
            else:
                $retorno = '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$midia.'" />';
            endif;
        endif;
        return $retorno;
    }
    
// carregar um ou varios arquivos .js de uma pasta ou servidor remoto
    function load_js($arquivo = NULL, $pasta = 'js', $remoto = FALSE){
        
        if($arquivo != NULL):
            $CI =& get_instance();
            $CI->load->helper('url');
            $retorno = '';
            if(is_array($arquivo)):
                foreach ($arquivo as $js):
                    if($remoto):
                        $retorno .= '<script type="text/javascript" src="'.$js.'" ></script>';
                    else:
                        $retorno .= '<script type="text/javascript" src="'.  base_url("$pasta/$js.js").'" ></script>';
                    endif;
                endforeach;             
            else:
               if($remoto):
                    $retorno .= '<script type="text/javascript" src="'.$arquivo.'" ></script>';
                else:
                    $retorno .= '<script type="text/javascript" src="'.  base_url("$pasta/$arquivo.js").'" ></script>';
                endif;
            endif;
        endif;
        return $retorno;
    }