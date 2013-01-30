<?php
    class SmsAlerta extends AppModel {
        var $name = "SmsAlerta";
        
        var $belongsTo = array(
            'Alerta' => array(
                    'classname' => 'Alerta'
                )
            );
    }
?>