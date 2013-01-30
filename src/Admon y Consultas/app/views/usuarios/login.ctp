<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = 
        "$(window).addEvent('domready', function() {\n
            MooTools.lang.setLanguage('es-ES');\n
            function elPass(el) {\n
                el.setStyle('border', '2px solid green');\n
            }\n
            \n
            function elFail(el, fvals) {\n
                el.setStyle('border', '2px solid red');\n
            }\n
            \n
            var frmVal = new Form.Validator.Inline('UsuarioLoginForm', {\n
                                    evaluateFieldsOnChange: false,\n
                                    onElementPass: elPass,\n
                                    onElementFail: elFail,\n
                                    serial: false\n
                                }\n
                        );\n
            }\n
        );\n";
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->tag('h1', 'Inicio de Sesi&oacute;n');
    //echo $html->tag('fieldset');
    //echo $html->tag('legend', 'Nueva Estaci&oacute;n');
    $session->flash('auth');
    echo $form->create('Usuario', array('action' => 'login'));
        echo $form->input('nombre_usuario', array('label' => 'Usuario', 'class' => 'required'));
        echo $form->input('contra', array('label' => 'Contrase&ntilde;a', 'class' => 'required', 'type' => 'password'));
    echo $form->end('Iniciar Sesion');
    //echo $html->tag('/fieldset');
?>
<br>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>