<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
    case 'login':
        echo '<div class="panel panel-default col-md-5">';
        echo '<div class="panel-body">';
        echo form_open('usuarios/login', array('class'=>'form-group loginform'));
        echo form_fieldset('Identifique-se');
        echo form_label('Usuario');
        echo form_input(array('name'=>'usuario', 'class'=>'form-control', 'placeholder'=>'Login'), set_value('usuario'), 'autofocus');
        echo form_label('Senha');
        echo form_password(array('name'=>'senha', 'class'=>'form-control', 'placeholder'=>'Senha'), set_value('senha'));
        echo '<div class="">';
        echo form_submit(array('name'=>'logar', 'class'=>'btn btn-primary text-right'), 'Login');
        echo '<p class="text-left">'.anchor('usuarios/nova_senha', 'Esqueci minha senha').'</p>';
        echo '</div>';
        echo form_fieldset_close();
        echo '</div>';
        echo '</div>';

     break;

    default:
        echo '<div class="alert-warning"><p>A tela solicitada não existe</p></div>';
        break;
}