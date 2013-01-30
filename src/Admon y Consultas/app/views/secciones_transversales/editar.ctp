<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = "$(window).addEvent('domready', function() {
    MooTools.lang.setLanguage('es-ES');
    function elPass(el) {
        el.setStyle('border', '2px solid green');
    }
    
    function elFail(el, fvals) {
        el.setStyle('border', '2px solid red');
        if (el.get('id') == 'SeccionTransversalXls') el.set('value','');
    }
    
    var frmVal = new Form.Validator.Inline('SeccionTransversalEditarForm', {
                            evaluateFieldsOnChange: false,
                            onElementPass: elPass,
                            onElementFail: elFail,
                            serial: false
                        }
                );
        
        
    frmVal.add('ext', {
            errorMsg: 'Escoja un archivo de Excel 2003 o menor (extensi&oacute;n .xls)',
            test: function(field, props) {
                    return field.get('value').match(new RegExp(props.ext+'$', 'i')) || 
                        (field.get('value') == '');
                }
            }
        );
        
    }
    
    );";
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->tag('h1', 'Editar Secci&oacute;n Transversal');
    //echo $html->tag('fieldset');
    //echo $html->tag('legend', 'Nueva Estaci&oacute;n');
    echo $form->create('SeccionTransversal', array('id' => 'SeccionTransversalEditarForm','type' => 'file', 'action' => 'editar', 'url' => '/SeccionesTransversales/editar/'. $this->getVar('est')));
        echo $form->input('cero_escala', array('label' => 'Cero de la Escala',
                                                       'after' => 'm',
                                                      'class' => 'validate-numeric'));
        echo $form->input('xls', array('label' => 'Archivo de Seccion Transversal',
                                                       'class' => 'ext:\'xls\'',
                                                       'type' => 'file'));
        echo $form->input('estacion_id', array('type' => 'hidden'));
        echo $form->input('id', array('type' => 'hidden'));
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