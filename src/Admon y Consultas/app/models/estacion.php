<?php
    class Estacion extends AppModel {
        var $name = "Estacion";
        //var $useTable = 'estaciones';
        var $validate = array(
		'nombre' => array(
            'rule' => 'isUnique',
            'message' => 'Ya existe una estación con este nombre.'
        ),
        'id_satelital' => array(
            'rule' => 'isUnique',
            'message' => 'Esta Id satelital está en uso por otra estacion.'
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