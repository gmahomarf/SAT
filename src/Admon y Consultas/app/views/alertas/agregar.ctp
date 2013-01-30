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
    var frmVal = new Form.Validator.Inline('AlertaAgregarForm', {\n
                            evaluateFieldsOnChange: false,\n
                            onElementPass: elPass,\n
                            onElementFail: elFail,\n
                            serial: false\n
                        }\n
                );\n
        \n
    }\n
);\n";
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->tag('h1', 'Agregar Alerta');
    echo $html->tag('fieldset');
    echo $html->tag('legend', 'Agregar Alerta');
    echo $form->create('Alerta', array('action' => 'agregar'));
        echo $form->input('descripcion', array('class' => 'required maxLength:100', 'type' => 'textarea'));
        echo $form->input('umbral_nivel_verde', array('label' => 'Nivel para Alerta Verde',
                                                       'after' => 'm',
                                                      'class' => 'validate-numeric'));
        echo $form->input('umbral_nivel_amarilla', array('label' => 'Nivel para Alerta Amarilla',
                                                       'after' => 'm',
                                                      'class' => 'validate-numeric'));
        echo $form->input('umbral_nivel_roja', array('label' => 'Nivel para Alerta Roja',
                                                       'after' => 'm',
                                                      'class' => 'validate-numeric'));
        echo $form->input('umbral_lluvia_verde', array('label' => 'Precipitación acumulada en menos de 12 horas para Alerta Verde',
                                                       'after' => 'mm',
                                                       'class' => 'validate-numeric'));
        echo $form->input('umbral_lluvia_amarilla', array('label' => 'Precipitación acumulada en menos de 12 horas para Alerta Verde',
                                                       'after' => 'mm',
                                                       'class' => 'validate-numeric'));
    echo $form->end('Guardar');
    echo $html->tag('/fieldset');
?>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>