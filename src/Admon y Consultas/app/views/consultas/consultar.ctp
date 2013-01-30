<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    $script = "
        $(window).addEvent('domready', function() {
                if ($('sensor').value != 'LLUVIA') {
                    $$('input').each(function(inp, i) {
                        if (inp.get('name') == 'data[estadistica]') {
                            inp.setProperty('disabled', true);
                        }
                    });
                    $('EstadisticaNing').setProperty('checked', true);
                }
                $('estacion').addEvent('change', function(e) {
                        $$('input').each(function(inp, i) {
                            if (inp.get('type') == 'submit') {
                                inp.setProperty('disabled', true);
                            }
                        });
                        document.location.replace('/consultas/consultar/'+this.value);
                        return false;
                    }
                );
                
                $('sensor').addEvent('change', function(e) {
                        if (this.value == 'LLUVIA') {
                            $$('input').each(function(inp, i) {
                                if (inp.get('name') == 'data[estadistica]') {
                                    inp.setProperty('disabled', false);
                                }
                            });
                        } else {
                            $$('input').each(function(inp, i) {
                                if (inp.get('name') == 'data[estadistica]') {
                                    inp.setProperty('disabled', true);
                                }
                                $('EstadisticaNing').setProperty('checked', true);
                            });
                        }
                        return false;
                    }
                );
                
                new Form.Request('ResultadosForm', 'ifrm', {resetForm: false,
                        onSuccess: function(a,b,c) {
                            $('hdSubc').addEvent('click', function(e) {
                                    e.stop();
                                    this.set('class', '');
                                    $('secc').hide();
                                    $('subc').show('block');
                                    $('hdSecc').className = 'dis';
                                }
                            );
                            $('hdSecc').addEvent('click', function(e) {
                                    e.stop();
                                    this.set('class', '');
                                    $('subc').hide();
                                    $('secc').show('block');
                                    $('hdSubc').className = 'dis';
                                }
                            );
                        }
                        });  
               /* $('const').position({position: 'topRight', edge: 'topRight', offset: {x: -50, y: 0}, relativeTo: 'principal'});
                $(window).addEvent('resize', function(e) {
                    $('const').position({position: 'topRight', edge: 'topRight', offset: {x: -50, y: 0}, relativeTo: 'principal'});
                    }
                );*/
                
                
            }
        );
        
        function secc(est, niv) {
                    $('imgSeccTrans').set('src', '/Consultas/seccionTransversal/' + est + '/' + niv);
                }";
        /*JS aqui!!!*/
    // $script = '$(window).addEvent("domready",function(){$("estacion").addEvent("change",function(b){var a=new Request.HTML({url:"/consultas/sensores",method:"post",data:"data[sens]="+this.value,onSuccess:function(d,g,f,c){$("sensor").empty();$("sensor").adopt(d[0].getChildren());$("sensor").set("html",$("sensor").get("html")+"<!-- ugly hack -->");},evalScripts:false});a.send();return false;});});';/*JS aqui!!!*/
        /*"$(window).addEvent('domready', function() {\n" .
        "      $('estacion').addEvent('change', function(e) {\n".
        "                   //e.stop();\n".
        "                   var req = new Request.HTML({\n".
        "                           url: '/consultas/sensores',\n".
        "                           method: 'post',\n".
        "                           data: 'data[sens]='+this.value,\n".
        "                           onSuccess: function(t,e,h,j) {\n".
        "                               $('sensor').empty();\n".
        "                               //$(t[0]).inject($('estacion'), 'after');\n".
        "                               $('sensor').adopt(t[0].getChildren());\n".
        "                               $('sensor').set('html', $('sensor').get('html') + '<!-- ugly hack -->');\n".
        "                               //t[0].getChildren().each(function(opt) {\n".
        "                                   //$('sensor').appendChild(opt);});\n".
        "                               //$('sensor').adopt(t[0].getChildren());\n".
        "                           },\n".
        "                           evalScripts: false});\n".
        "                   req.send();\n".
        "                   return false;".
        "               }\n".
        "            );\n".
        "        });\n"
        ;*/
    echo $javascript->codeBlock($script, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    if ($this->getVar('selected')) {
        $sc = '$(window).addEvent("domready", function() { $("estacion").value = "'.$this->getVar('selected').'";});';
        echo $javascript->codeBlock($sc, array('allowCache'=>true,'safe'=>false,'inline'=>false));
    }
    /*echo $html->tag('div', 
            $html->image('/img/const2.png', array('border' => '0', 'id' => 'const')).
            $html->tag('br').
            $html->tag('span', 'En Construcci&oacute;n', array('style' => 'font-weight: bold; ')).
            $html->tag('br').
            $html->tag('span', 'Dudas, consultas, comentarios, sugerencias a <br> gmahomar@pmdn.gob.hn'),
            array('id' => 'const')
        );*/
 ?>
<div id="navlinks">
<?php echo $html->link('Menu de Consultas', array('controller' => 'Consultas')); ?>
<br>
<?php echo $html->link('Menu Principal', '/'); ?>
<br>
<br>
</div>
<?php
    echo $form->create(false, array("type" => "post", "action" => "resultados"/*, "default" => false*/));
    echo $html->tag('fieldset');
    echo $html->tag('legend', 'Par&aacute;metros');
    echo $html->tag("br");
    $estaciones = array();
    foreach ($this->getVar("ests") as $est) {
        $estaciones[$est] = $est;
    }
    echo $form->input("estacion",array('options' => $estaciones));
    if (!empty($sens)) {
        echo $form->input("sensor",array('options' => $sens));
    } else {
        echo $form->input("sensor",array( 'options' => array("#"=>"Seleccione una estación")));
    }
    echo $form->input("fechaIni", array('type' => 'date', 'dateFormat' => 'YMD', 'monthNames' => false, 'label' => 'Fecha'));
    /*echo $html->tag("br");
    echo $form->label("estacion", "Estaci&oacute;n:");
    echo $form->dateTime("fechaFin", "YMD", "NONE" ,null,null, false);*/
    //echo $html->tag("br");
    echo $form->label("tipo", "Mostrar resultados en: ");
    echo $form->radio("tipo", 
                      array("graf"=>"Gr&aacute;fico",
                        "tbl"=>"Tabla"),
                      array("value"=>"graf"));
    echo $html->tag("br");
    echo $form->label("intervalo", "Intervalo: ");
    echo $form->radio("intervalo", 
                      array("15min"=>"15 minutos",
                        "1hr"=>"1 hora"),
                      array("value"=>"15min"));
    echo $html->tag("br");
    echo $form->label("estadistica", "Estad&iacute;sticas: ");
    echo $form->radio("estadistica", 
                      array("ning"=>"Ninguna",
                        //"prom"=>"Promedio",
                        //"min"=>"Minimo",
                        //"max"=>"Maximo",
                        "delta"=>"Lluvia Acumulada"),
                      array("value"=>"ning"));
    echo $html->tag('/fieldset');
    echo $form->end("Consultar");
    echo $html->tag('div', '', array('id' => 'ifrm', 'style' => 'overflow: visible; width: 100%;'));
?>