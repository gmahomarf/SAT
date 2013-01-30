<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = "$(window).addEvent('domready', function() {\n
    MooTools.lang.setLanguage('es-ES');\n
    function elPass(el) {\n
        el.setStyle('border', '2px solid green');\n
    }\n
    \n
    function elFail(el, fvals) {\n
        el.setStyle('border', '2px solid red');\n
    }\n
    \n
    var frmVal = new Form.Validator.Inline('EstacionAgregarForm', {\n
                            evaluateFieldsOnChange: false,\n
                            onElementPass: elPass,\n
                            onElementFail: elFail,\n
                            serial: false\n
                        }\n
                );\n
    frmVal.add('idEst', {\n
            errorMsg: 'Por favor usa solo n&uacute;meros o las letras de la A a la F en este campo',\n
            test: function(field, props) {\n
                    return (field.get('value').match(new RegExp('^[0-9A-F]+$', 'i')));\n
                }\n
            }\n
        );\n
        \n
    }\n
);\n";
    $tipEst = array(
        '' => '-- Elija una --',
        'Telemetrica Lluvia y Nivel' => 'Telemetrica Lluvia y Nivel',
        'Telemetrica Lluvia' => 'Telemetrica Lluvia',
        'Telemetrica Nivel' => 'Telemetrica Nivel',
        'Telemetrica Meteorologica' => 'Telemetrica Meteorologica'
    );
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->tag('h1', 'Agregar Estaci&oacute;n');
    //echo $html->tag('fieldset');
    //echo $html->tag('legend', 'Nueva Estaci&oacute;n');
    echo $form->create('Estacion', array('action' => 'agregar'));
        //echo $form->input('id');
        echo $form->input('id_satelital', array('class' => 'required idEst minLength:8'));
        echo $form->input('nombre', array('class' => 'required'));
        echo $form->input('Estacion.cuenca_id', array('options' => $cuencas));
        echo $form->input('Estacion.responsable_id', array('options' => $responsable));
        echo $form->input('ciudad');
        echo $form->input('municipio');
        echo $form->input('departamento');
        echo $form->input('utm_x', array('label' => 'UTM X', 'class' => 'validate-numeric'));
        echo $form->input('utm_y', array('label' => 'UTM Y', 'class' => 'validate-numeric'));
        echo $form->input('utm_z', array('label' => 'UTM Z', 'class' => 'validate-numeric'));
        echo $form->input('tipo_estacion', array('label' => 'Tipo de Estaci&oacute;n',
                                                 'options' => $tipEst));
        echo $form->input('Estacion.alerta_id', array('options' => $alertas));
        echo $form->input('activa');
    echo $form->end('Guardar');
    //echo $html->tag('/fieldset');
?>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>