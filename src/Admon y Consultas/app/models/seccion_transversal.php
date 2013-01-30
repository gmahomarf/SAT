<?php
    class SeccionTransversal extends AppModel {
        var $name = "SeccionTransversal";
        
        var $belongsTo = array(
            'Estacion' => array(
                    'classname' => 'Estacion'
                )
            );
            
        var $hasMany = array(
            'PuntoSeccionTransversal' => array(
                    'classname' => 'PuntoSeccionTransversal'
                )
            );
    }
?>