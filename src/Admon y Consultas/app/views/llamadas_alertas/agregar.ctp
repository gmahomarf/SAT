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
            var frmVal = new Form.Validator.Inline('LlamadaAlertaAgregarForm', {\n
                                    evaluateFieldsOnChange: false,\n
                                    onElementPass: elPass,\n
                                    onElementFail: elFail,\n
                                    serial: false\n
                                }\n
                        );\n
            }\n
        );\n";
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->tag('h1', 'Agregar Llamada para Alerta');
    echo $html->tag('fieldset');
    echo $html->tag('legend', 'Agregar Llamada para Alerta');
    echo $form->create('LlamadaAlerta', array('url' => 'agregar/'. $alertaId, 'id' => 'LlamadaAlertaAgregarForm'));
        echo $form->input('alerta_id', array('type' => 'hidden', 'value' => $alertaId));
        echo $form->input('telefono', array('class' => 'required'));
        echo $form->input('descripcion', array('class' => 'required'));
    echo $form->end('Guardar');
    echo $html->tag('/fieldset');
?>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('controller' => 'Alertas', 'action' => 'contactos', $alertaId)); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>