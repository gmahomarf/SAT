<?php
    class PuntoSeccionTransversal extends AppModel {
        var $name = 'PuntoSeccionTransversal';
        var $useTable = 'puntos_secciones_transversales';
        
        var $belongsTo = array('SeccionTransversal');
        
    }
?>