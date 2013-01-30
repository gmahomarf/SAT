<?php
    class Consulta extends AppModel {
        var $name = "Consulta";
        var $useTable = false;
        var $useDbConfig = 'datos';
        
        var $hasOne = array('Estacion');
        
    }
?>