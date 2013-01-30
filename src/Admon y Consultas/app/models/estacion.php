<?php
    class Estacion extends AppModel {
        var $name = "Estacion";
        //var $useTable = 'estaciones';
        var $validate = array(
		'nombre' => array(
            'rule' => 'isUnique',
            'message' => 'Ya existe una estaci�n con este nombre.'
        ),
        'id_satelital' => array(
            'rule' => 'isUnique',
            'message' => 'Esta Id satelital est� en uso por otra estacion.'
        )
        );

        var $belongsTo = array(
            'Responsable' => array(
                    'classname' => 'Responsable'
                ),
            'Cuenca' => array(
                    'classname' => 'Cuenca'
                ),
            'Alerta' => array(
                    'classname' => 'Alerta'
                )
            );

        var $hasOne = array(
            'SeccionTransversal' => array(
                    'classname' => 'SeccionTransversal'
                )
            );
    }
?>