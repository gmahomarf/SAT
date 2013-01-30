<?php
    //$this->Acl->allow();
    echo $html->tag('h1', 'Sistema de Alerta Temprana a Inundaciones');
    echo $html->tag('h2', 'Men&uacute; Principal');
    echo $html->link('Consultas', array('controller'=>'Consultas'));
    echo $html->tag('br');
    if($session->read('Auth.Usuario.grupo') == 1) {
        echo $html->link('Administracion de Estaciones', array('controller'=>'Estaciones'));
        echo $html->tag('br');
        echo $html->link('Administracion de Alertas', array('controller'=>'Alertas'));
        echo $html->tag('br');
        echo $html->link('Administracion de Cuencas', array('controller'=>'Cuencas'));
        echo $html->tag('br');
        echo $html->link('Administracion de Responsables', array('controller'=>'Responsables'));
        echo $html->tag('br');
        echo $html->link('Administracion de Usuarios', array('controller'=>'Usuarios'));
        echo $html->tag('br');
    }
    echo $html->tag('br');
    if ($session->read('Auth.Usuario.nombre_usuario') != '') {
        echo $html->tag('h3', 'Sesi&oacute;n iniciada como '. $session->read('Auth.Usuario.nombre').' '. $session->read('Auth.Usuario.apellido') . ' ('. $session->read('Auth.Usuario.nombre_usuario') .')');
        echo $html->link('Cerrar Sesion', array('controller'=>'usuarios', 'action' => 'logout'));
    }
    else {
        echo $html->link('Iniciar Sesion', array('controller'=>'usuarios', 'action' => 'login'));
    }
?>