<?php
class Usuario extends AppModel {

	var $name = 'Usuario';
	var $validate = array(
		'nombre_usuario' => array(
            'rule' => 'isUnique',
            'message' => 'Este nombre de usuario ya existe.'
        ),
		'contra' => array('alphanumeric'),
		'nombre' => array('alphanumeric'),
		'apellido' => array('alphanumeric')
	);

}
?>