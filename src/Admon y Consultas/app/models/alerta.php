<?php
    class Alerta extends AppModel {
        var $name = "Alerta";
        
        var $hasMany = array(
            'LlamadaAlerta' => array(
                    'classname' => 'LlamadaAlerta'
                ),
            'CorreoAlerta' => array(
                    'classname' => 'CorreoAlerta'
                ),
            'SmsAlerta' => array(
                    'classname' => 'SmsAlerta'
                )                
            );
    }
?>