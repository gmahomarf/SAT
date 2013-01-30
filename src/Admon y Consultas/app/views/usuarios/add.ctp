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
    var frmVal = new Form.Validator.Inline('UsuarioAddForm', {\n
                            evaluateFieldsOnChange: false,\n
                            onElementPass: elPass,\n
                            onElementFail: elFail,\n
                            serial: false\n
                        }\n
                );\n
    frmVal.add('equalPass', {\n
            errorMsg: 'Las contraseñas no coinciden, por favor verif&iacute;calas.',\n
            test: function(field, props) {\n
                    return (field.get('value') == $(props.equalPass).get('value'));\n
                }\n
            }\n
        );\n
        \n
    }\n
);\n";

echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
$grupos = array(
        1 => 'Administradores',
        2 => 'Usuarios'
        );
?>

<div class="usuarios form">
<?php echo $form->create('Usuario');?>
    <h1>Agregar Usuario</h1>
	<fieldset>
 		<legend><?php __('Agregar Usuario');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('nombre_usuario', array('class' => 'required'));
		echo $form->input('contra', array('class' => 'required', 'label' => 'Contrase&ntilde;a', 'type' => 'password'));
        echo $form->input('repcontra', array('class' => 'required equalPass:\'UsuarioContra\'', 'label' => 'Repita Contrase&ntilde;a', 'type' => 'password'));
		echo $form->input('nombre', array('class' => 'required'));
		echo $form->input('apellido', array('class' => 'required'));
		echo $form->input('grupo', array('default' => 2, 'options' => $grupos));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>