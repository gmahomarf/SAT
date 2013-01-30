<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = "
    $(window).addEvent('domready', function() {
        function tipear() {
            var ests = $$('area');
            ests.each(function(e,i) {
                new Tips(e, {
                    offset: {x: 15, y: -15},
                    text: 'alt',
                    title: null,
                    className: 'tip',
                    showDelay: 0,
                    hideDelay: 0
                }
                );
                e.set('href', '/consultas/consultar/' + e.get('href'));
            }
            );
        }
        $(window).addEvent('resize', function(e) {
            $('mapa').position({position:'center'});
        });
        tipear();
        $(document.body).addEvent('load', function(e) {
            $('mapa').position({position:'center'});
        });
    });";
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    echo $html->image('/img/'.$this->getVar('cuenca').'.gif', array('usemap' => '#stamap', 'border' => '0', 'id' => 'mapa'));
    /*echo $html->tag('map', 
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '297,229,313,244', 'alt' => 'Chinda', 'href' => 'CHINDA')).
        $html->tag('area','' ,array('shape' => 'rect', 'coords' => '184,285,196,295', 'alt' => 'Santiago de Posta', 'href' => 'SANTIAGO DE POSTA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '121,305,134,317', 'alt' => 'Dulce Nombre', 'href' => 'DULCE NOMBRE')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '188,325,204,338', 'alt' => 'Lepaera', 'href' => 'LEPAERA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '303,330,317,342', 'alt' => 'San Fco. de Ojuera', 'href' => 'SAN FCO DE OJUERA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '388,331,403,344', 'alt' => 'Monte de Dios', 'href' => 'MONTE DE DIOS')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '373,180,387,191', 'alt' => 'Santiago', 'href' => 'SANTIAGO')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '469,135,483,148', 'alt' => 'Guaymas', 'href' => 'GUAYMAS')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '452,452,465,464', 'alt' => 'Yarumela', 'href' => 'YARUMELA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '438,395,451,408', 'alt' => 'La Encantada', 'href' => 'LA ENCANTADA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '187,415,200,428', 'alt' => 'La Campa', 'href' => 'LA CAMPA')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '225,413,235,424', 'alt' => 'Belen Gualcho', 'href' => 'BELEN GUALCHO')).
        $html->tag('area', '',array('shape' => 'rect', 'coords' => '332,282,346,295', 'alt' => 'El Cielito (Las Quebradas)', 'href' => 'LAS QUEBRADAS')),
        array('name' => 'stamap')
    );*/
    include($this->getVar('cuenca').'.ctp');
?>