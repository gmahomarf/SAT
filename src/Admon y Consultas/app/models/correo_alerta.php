<?php
    class CorreoAlerta extends AppModel {
        var $name = "CorreoAlerta";
                
        var $belongsTo = array(
            'Alerta' => array(
                    'classname' => 'Alerta'
                )
            );
    }
?>