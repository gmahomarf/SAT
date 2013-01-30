<?php
    class LlamadaAlerta extends AppModel {
        var $name = "LlamadaAlerta";
                
        var $belongsTo = array(
            'Alerta' => array(
                    'classname' => 'Alerta'
                )
            );
    }
?>