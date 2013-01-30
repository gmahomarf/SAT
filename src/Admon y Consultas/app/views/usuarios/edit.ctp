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
    var frmVal = new Form.Validator.Inline('UsuarioEditForm', {\n
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
        1 => 'Administrador',
        2 => 'Usuario'
        );
?>

<div class="usuarios form">
<?php echo $form->create('Usuario');?>
    <h1>Editar Usuario</h1>
	<fieldset>
 		<legend><?php __('Editar Usuario');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('nombre_usuario', array('class' => 'required'));
		echo $form->input('contra2', array('type' => 'hidden', 'value' => $this->data['Usuario']['contra']));
		echo $form->input('contra', array('label' => 'Contrase&ntilde;a', 'type' => 'password', 'value' => ''));
        echo $form->input('repcontra', array('class' => 'equalPass:\'UsuarioContra\'', 'label' => 'Repita Contrase&ntilde;a', 'type' => 'password'));
		echo $form->input('nombre', array('class' => 'required'));
		echo $form->input('apellido', array('class' => 'required'));
		echo $form->input('grupo', array('default' => 2, 'options' => $grupos));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div> 