<?php
    class Responsable extends AppModel {
        var $name = "Responsable";
        
        var $validate = array(
            'nombre' => array(
                'rule' => 'isUnique',
                'message' => 'Ya existe un responsable con este nombre.'
            )
        );     
    }
?>