<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = "
        $(window).addEvent('domready', function() { 
                /*$('graf').position({position: centerTop});
                $('secc').position({position: left, relativeTo: 'subc'});*/
                $('hdSubc').addEvent('click', function(e) {
                        e.stop();
                        $('secc').hide();
                        $('subc').show('block');
                    }
                );
                $('hdSecc').addEvent('click', function(e) {
                        e.stop();
                        $('subc').hide();
                        $('secc').show('block');
                    }
                );
            }
        );";
    #echo $this->getVar("imgGraf");
    if (!($this->getVar('empty'))) { 
        $param = $this->getVar("param");
        echo $html->tag("span", "{$param["sensor"]} para {$param["estacion"]}", array("class" => "titulo"));
        //echo $html->tag("br");
        echo $html->tag("span", "{$param["fechai"]} a {$param["fechaf"]}", array("class" => "titulo"));
        if ($this->getVar("tipo") == "graf") {
            echo $html->image($this->getVar("imgGraf"), array("usemap" => "#imgmap1", "border" => "0", 'id' => 'graf'));
            
            echo $this->getVar("imgmap");
        } elseif ($this->getVar("tipo") == "tbl") {
            $cells = array();
            $datos = $this->getVar("datos");
            //print_r($datos);
            echo $html->tag("table");
            echo $html->tableHeaders(array("Fecha / Hora","Valor")/*, array("class" => "head")*/);
            foreach($datos /*as $registro) {
                foreach($registro */as $reg) {
                    $cells[] = array($reg["TIME_TAG"],
                        $html->link($reg["ED_VALUE"], "javascript:secc('{$param["estacion"]}',{$reg["ED_VALUE"]})"));
                }
            //}
            echo $html->tableCells($cells/*, array("class" => "body"), array("class" => "body")*/);
            echo $html->tag("/table");
        } else {
            echo "???";
            print_r($datos);
        }
    } else {
        echo $html->tag('h2', 'No se encontraron datos con los par&aacute;metros especificados');
    }
    echo $html->tag('div', null, array('style' => 'display:block; text-align: center; width: 100%; overflow: hidden;'));
        echo $html->tag('h2', 'Secci&oacute;n Transversal', array('id' => 'hdSecc'));
        echo ' ';
        echo $html->tag('h2', 'Subcuenca', array('id' => 'hdSubc', 'class' => 'dis'));
        /////////////////
        echo $html->tag('div', null, array('style' => 'display: none; text-align: center; overflow: auto; width: auto;', 'id' => 'subc'));
            echo $html->image(strtolower($param["estacion"]).'.gif', array("border" => "0", 'style' => 'width: 500px;'));
        echo $html->tag('/div');
        echo $html->tag('div', null, array('style' => 'display: block; text-align: center; overflow: auto; width: auto;', 'id' => 'secc'));
            echo $html->image(array('controller' => 'Consultas', 'action' => 'seccionTransversal', $param["estacion"], $param["nivel"]), array('border' => '0', 'style' => '', 'id' => 'imgSeccTrans'));
        echo $html->tag('/div');
    echo $html->tag('/div');
?>