<?php
    class ConsultasController extends AppController {
        var $name = "Consultas";
        var $layout = "default";
        var $pageTitle = "Consultas";
        
        /*define("INT_15MIN", 1);
        define("INT_1HR", 2);
        define("EST_PROM", 11);
        define("EST_MAX", 12);
        define("EST_MIN", 13);
        define("EST_SUM", 14);
        define("EST_DELTA", 15);*/
        
        function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow('*');
        }

        function index() {  
            //$this->redirect(array('controller' => 'consultas', 'action' => 'consultar'));
        }
        
        function mapas($cuenca = null) {
            if (!$cuenca) {
                $this->redirect('/consultas');
            } else {
                $this->set(compact('cuenca'));
            }
        }
        
        function consultar($esta = null) {
            $this->pageTitle = "Consultas";
            $estaciones = array();
            $datos = $this->Consulta->query("SELECT STATION_ID FROM xc_sites; ");
            foreach ($datos as $registro) {
                foreach($registro as $contenido) {
                    $estaciones[] = $contenido["STATION_ID"];
                }
            }
            $this->set("ests", $estaciones);
            if (!empty($esta)) {
                $this->set('selected', $esta);
                $sens = array();
                $datos = $this->Consulta->query("SELECT SENSORNAME FROM xc_sitesensors " .
                                            "WHERE STE_STATION_ID ='$esta'; ");
                foreach ($datos as $registro) {
                    foreach($registro as $contenido) {
                        $sens[$contenido["SENSORNAME"]] = $contenido["SENSORNAME"];
                    }
                }
                $this->set(compact('sens'));
            }
        }
        
        function resultados() {
            $this->pageTitle = "Resultados";
            $fecha = "{$this->data["fechaIni"]["year"]}/{$this->data["fechaIni"]["month"]}/{$this->data["fechaIni"]["day"]}";
            $ft = date_create($fecha);
            $ft = date_sub($ft, date_interval_create_from_date_string('1 day'));
            $fi = date_format($ft, 'Y/m/d');
            $dat = $this->Consulta->query("SELECT TIME_TAG, ED_VALUE FROM xc_data1 ".
                                       "WHERE STATION_ID = '{$this->data["estacion"]}' ".
                                       "AND SENSORNAME = '{$this->data["sensor"]}' ".
                                       "AND TIME_TAG >= '$fi 00:00:00' ".
                                       "AND TIME_TAG <= '$fecha  23:59:59'".
                                       "ORDER BY TIME_TAG ASC;");
            $niv = null;
            $param = array(
                    "estacion" => "{$this->data["estacion"]}",
                    "sensor" => "{$this->data["sensor"]}",
                    "fechai" => $fi,
                    "fechaf" => $fecha,
                    'nivel' => $niv
            );
            if (!empty($dat)) {
                $datos = array();
                foreach ($dat as $registro) {
                    foreach ($registro as $contenido) {
                        $datos[] = $contenido;
                        if ($param['sensor'] == 'NIVEL')
                            $niv = $contenido['ED_VALUE'];
                    }
                }
                if ($this->data["intervalo"] !== "15min" || $this->data["estadistica"] !== "ning") {
                    $datos = $this->_filtrar($datos, $this->data["intervalo"], $this->data["estadistica"]);
                    
                }
                if ($this->data["tipo"] == "graf") {
                    $this->set("tipo","graf");
                    $this->set("imgGraf", $this->_graficar($datos, $this->data["estacion"], $this->data["sensor"], $fi, $fecha));
                } else {
                    $this->set("tipo","tbl");
                    $this->set("datos", $datos);
                }
            } else $this->set('empty', true);
            $param['nivel'] = $niv;
            $this->set(compact('param'));
        }
        
        function _filtrar($dat, $inter, $estad) {
            $result = array();
            $datos = array();
            //print_r($dat);
            foreach ($dat as $reg) {
                $datos[$reg["TIME_TAG"]] = $reg["ED_VALUE"];
            }
            if ($inter === "1hr") {
                $temp = date_parse($dat[0]["TIME_TAG"]);
                //$temp = date_parse($datos[0]);
                //echo $dat[0]["TIME_TAG"];
                //echo "{$temp["year"]}-{$temp["month"]}-{$temp["day"]} 00:00:00";
                $fecha = new DateTime();
                // $fecha = date_create("{$temp["year"]}-{$temp["month"]}-{$temp["day"]} 00:00:00");
                for ($i = 0; $i < 24; $i++/*, $fecha = date_add($fecha, new DateInterval("P1H"))*/) {
                    $fecha = date_create("{$temp["year"]}-{$temp["month"]}-{$temp["day"]} $i:00:00");
                    $dt = date_format($fecha,"Y-m-d H:i:s");
                    if (isset($datos[$dt])) {
                        $result[] = array("TIME_TAG" => $dt, "ED_VALUE" => $datos[$dt]);
                    }
                }
            } else {
                $result = $dat;
            }
            
            switch ($estad) {
                case "delta":
                    $vi = $result[0]["ED_VALUE"];
                    foreach($result as &$r) {
                        $r["ED_VALUE"] -= $vi;
                        $r["ED_VALUE"] = round($r["ED_VALUE"],2);
                    }
                    
                    break;
                case "ning":
                    break;
            }
            return $result;
        }
        
        function _graficar(array $dat, $est, $sens, $feci, $fecf) {
            App::import("Vendor", "jpgraph/jpgraph");
            App::import("Vendor", "jpgraph/jpgraph_line");
            App::import("Vendor", "jpgraph/jpgraph_regstat");
            App::import("Vendor", "jpgraph/jpgraph_errhandler.inc");
            JpGraphError::SetImageFlag(false);
            $fname = sprintf("%d",time()) . ".png";
            $datos = array();
            $labels = array();
            $otro = array();
            $urls = array();
            $tips = array();
            $dataX = array();
            foreach ($dat /*as $registro) {
                foreach($registro */as $contenido) {
                    $dataY[] = $contenido["ED_VALUE"];
                    $labels[] = $contenido["TIME_TAG"];
                    $dataX[] = strtotime($contenido["TIME_TAG"]);
                    $urls[] = $sens == 'NIVEL' ? "javascript:secc('$est',{$contenido["ED_VALUE"]})" : "javascript:void(0)";
                    $tips[] = $contenido["TIME_TAG"]." - ".$contenido["ED_VALUE"];
                }
                /*echo "X: " . count($dataX) . " <br>";
                echo "Y: " . count($dataY) . " <br>";
                echo "LBL: " . count($labels) . " <br>";
                echo "URL: " . count($urls) . " <br>";
                echo "TIP: " . count($tips) . " <br>";*/
            //}
            // if ($sens === 'NIVEL' || $sens === 'CAUDAL') {
                // $wt = 2;
                // foreach($labels as $lbl) {
                    // $dataX[] = strtotime($lbl);
                // }
                $wt = 3;
                //$dataY = $datos;
                //$dataX = $dts;
                // $spline = new Spline($dts, $datos);
                // list ($dataX, $dataY) = $spline->Get(count($datos)*4);
                // $c = 0;
                // foreach($dataY as $n => &$y) {
                    // $dataX[$n] = date("Y-m-d H:i:s", round($dataX[$n],0));
                    // $y = round($y,2);
                    // $tips[] = date("Y-m-d H:i:s", $dataX[$n]) . " - " . $y;
                    // $urls[] = $sens == 'NIVEL' ? "javascript:secc('$est',$y)" :
                        // "javascript:void(0)";
                // }
            // } else {
                // foreach($dataY as $n => &$y) {
                    // $tips[] = $dataX[$n] . " - " . $y;
                    // $urls[] = "javascript:void(0)";
                // }
            // }
            $grafico = new Graph(max(count($dataY)*15+91,800),600, $fname, 0, false);
            $lineplot = new LinePlot($dataY);
            $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
            $lineplot->mark->SetColor("#716590");
            $lineplot->mark->SetFillColor("#47415A");
            $lineplot->mark->SetWidth($wt);
            $lineplot->SetFillColor("white", true);
            $lineplot->SetColor('#716590');
            $lineplot->SetWeight(1);
            $lineplot->SetCSIMTargets($urls,$tips,"");
            // $lineplot->SetFillFromYMin(true);
            $grafico->title->Set($sens . " de " . $est . "\n" . $feci . " a " . $fecf);
            $grafico->setScale("textlin");//, 1,1,$dataX[0], $dataX[count($dataX)-1]);
            $grafico->xaxis->title->Set("");
            $grafico->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
            $grafico->xaxis->SetTickLabels($labels);
            $grafico->xaxis->SetTextLabelInterval(4);
            $grafico->xaxis->SetLabelAngle(90.0);
            $grafico->yaxis->title->Set("");
            $grafico->Add($lineplot);
            $grafico->SetMargin(81,25,10,128);
            $grafico->SetGridDepth(DEPTH_FRONT); 
            $grafico->Stroke(/*$_SERVER["DOCUMENT_ROOT"] . DS*/WWW_ROOT. "img" . DS . "tmp". DS. $fname);
            $imgmap = $grafico->GetHTMLImageMap("imgmap1");
            $this->set("imgmap", $imgmap);
            return "/img/tmp/".$fname;
        }
        
        function seccionTransversal($est = null, $nivel = null) {
            if ($est) {
                $secciones = $this->Consulta->query("SELECT x,y
                                        FROM sat.puntos_secciones_transversales
                                        WHERE seccion_transversal_id = (
                                            SELECT id
                                            FROM sat.secciones_transversales
                                            WHERE estacion_id = (
                                              SELECT id
                                              FROM sat.estaciones
                                              WHERE nombre = '$est'
                                            )
                                        ) ORDER BY x;");
            }
            //print_r($secciones);
            if(empty($secciones)) {
                return;
            }
            $estacion = $this->Consulta->Estacion->find('first', array('conditions' => array('Estacion.nombre' => $est)));
            foreach ($secciones as $seccion) {
                $dataX[] = $seccion['puntos_secciones_transversales']['x'];
                $dataY[] = $seccion['puntos_secciones_transversales']['y'];
            }
            App::import("Vendor", "jpgraph/jpgraph");
            App::import("Vendor", "jpgraph/jpgraph_line");
            App::import("Vendor", "jpgraph/jpgraph_regstat");
            App::import("Vendor", "jpgraph/jpgraph_plotline");
            App::import("Vendor", "jpgraph/jpgraph_errhandler.inc");
            JpGraphError::SetImageFlag(false);
            $grafico = new Graph(800,600);
            $spline = new Spline($dataX, $dataY);
            list ($dataX, $dataY) = $spline->Get(100);
            if ($nivel != null) {
                
                for ($i = 0; $i < count($dataY); $i++) {
                    $niveles[] = $nivel;
                }
                //pr($dataY);
                //return;
                $nivelPlot = new lineplot($niveles, $dataX);
                $nivelPlot->SetFillGradient("lightblue","navy");
                $nivelPlot->SetColor("lightblue");
                $nivelPlot->SetFillFromYMin(true);
                $grafico->Add($nivelPlot);
            }
            for ($i = 0; $i < count($dataY); $i++) {
                    $dataY[$i] -= $estacion['SeccionTransversal']['cero_escala'];
            }
            $lineplot=new LinePlot($dataY, $dataX);
            /*$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
            $lineplot->mark->SetColor("#716590");
            $lineplot->mark->SetWidth(4);
            $lineplot->mark->SetFillColor("#47415A");*/
            $lineplot->SetColor("#704325");
            $lineplot->SetWeight(3);
            $lineplot->SetFillColor("#704325", true);
            $lineplot->SetFillFromYMin(true);
            //$lineplot->SetCSIMTargets($urls,$tips,"");
            //$grafico->title->Set($sens . " de " . $est . "\n" . $fec);
            $grafico->setScale("intint",0,0,0,$dataX[count($dataX)-1]);
            $grafico->SetBackgroundGradient('#EEEEEE', '#EEEEEE', GRAD_HOR, BGRAD_PLOT);
            $grafico->xaxis->title->Set("Ancho (m)");
            $grafico->xaxis->SetTitleMargin(10);
            $grafico->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
            //$grafico->xaxis->SetTextLabelInterval(3);
            $grafico->xaxis->SetLabelAngle(45.0);
            $grafico->yaxis->title->Set("Profundidad (m)");
            $grafico->SetAxisStyle(AXSTYLE_BOXOUT);
            if ($estacion['Alerta']['umbral_nivel_verde'] != null)
                $grafico->AddLine(new PlotLine(HORIZONTAL, $estacion['Alerta']['umbral_nivel_verde'], 'green', 2));
            if ($estacion['Alerta']['umbral_nivel_amarilla'] != null)
                $grafico->AddLine(new PlotLine(HORIZONTAL, $estacion['Alerta']['umbral_nivel_amarilla'], 'yellow', 2));
            if ($estacion['Alerta']['umbral_nivel_roja'] != null)
                $grafico->AddLine(new PlotLine(HORIZONTAL, $estacion['Alerta']['umbral_nivel_roja'], 'red', 2));
            $grafico->Add($lineplot);
            //$grafico->SetMargin(81,25,10,128);
            $grafico->SetGridDepth(DEPTH_FRONT); 
            $grafico->SetClipping(true);
            $grafico->Stroke(/*WWW_ROOT. "img" . DS . "tmp". DS. $fname*/);
            //print_r($dataX); print_r($dataY);
            //$imgmap = $grafico->GetHTMLImageMap("imgmap1");
            //$this->set("imgmap", $imgmap);
            //return "/img/tmp/".$fname;
        }
        
        function graficar2($est, $sens) {
            App::import("Vendor", "jpgraph/jpgraph");
            App::import("Vendor", "jpgraph/jpgraph_line");
            App::import("Vendor", "jpgraph/jpgraph_date");
            App::import("Vendor", "jpgraph/jpgraph_regstat");
            App::import("Vendor", "jpgraph/jpgraph_errhandler.inc");
            JpGraphError::SetImageFlag(false);
            $fecha = date_format(date_create("now"), "Y/m/d");
            $ft = date_create($fecha);
            $ft = date_sub($ft, date_interval_create_from_date_string('1 day'));
            $fi = date_format($ft, 'Y/m/d');
            $dat = $this->Consulta->query("SELECT TIME_TAG, ED_VALUE FROM xc_data1 
                                       WHERE STATION_ID = '$est'
                                       AND SENSORNAME = '$sens' 
                                       AND TIME_TAG >= '$fi 00:00:00' 
                                       AND TIME_TAG <= '$fecha 23:59:59'
                                       ORDER BY TIME_TAG ASC;");
            $datos = array();
            $labels = array();
            $otro = array();
            $urls = array();
            $tips = array();
            $dts = array();
            //pr($dat);
            //return;
            $c = 0;
            foreach ($dat as $dato) {
                    $datos[] = $dato['xc_data1']["ED_VALUE"];
                    $datosX[] = $c;
                    $c++;
                    $labels[] = $dato['xc_data1']["TIME_TAG"];
                    $urls[] = "javascript:void(0)";
                    $tips[] = $dato['xc_data1']["TIME_TAG"]." - ".$dato['xc_data1']["ED_VALUE"];
                }
            //}
            foreach($labels as $lbl) {
                $dts[] = strtotime($lbl);
            }
            // $spline = new Spline($dts, $datos);
            // list ($dataX, $dataY) = $spline->Get(count($datos)*4);
            $dataX = $dts;
            $dataY = $datos;
            // foreach($dataY as $n => $y) {
                
                // $dataX[$n] = date("Y-m-d H:i:s", round($dataX[$n],0));
                // $tips[] = $dataX[$n] . " - " . round($y,3);
                // $urls[] = "javascript:void(0)";
            // }
            
            // pr($dts);
            // pr($dataX);
            // pr($dataY);
            // pr($tips);
            //return;
            $fn = time();
            $grafico = new Graph(max(count($datos)*15 + 91,800),600);//, IMAGES."tmp\\$fn.png", 0, false);
            $lineplot = new LinePlot($dataY, $dataX);
            $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
            $lineplot->mark->SetColor("#716590");
            $lineplot->mark->SetFillColor("#47415A");
            $lineplot->mark->SetWidth(3);
            $lineplot->SetFillColor("white", true);
            $lineplot->SetColor('#716590');
            $lineplot->SetWeight(1);
            $lineplot->SetCSIMTargets($urls,$tips,"");
            // $lineplot->SetFillFromYMin(true);
            $grafico->title->Set($sens . " de " . $est . "\n" . $fi . " a " . $fecha);
            $grafico->setScale("datlin"/*,0,0,0,$dataX[count($dataX)- 1]*/);
            $grafico->xaxis->scale->SetDateFormat( 'Y-m-d H:i:s' );
            // $grafico->xaxis->scale->ticks->Set(15*60);
            // $grafico->xaxis->scale->SetTimeAlign( MINADJ_15 );
            $grafico->xaxis->title->Set("");
            $grafico->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
            //$grafico->xaxis->SetTickLabels($labels);
            //$grafico->xaxis->SetTextLabelInterval(15);
            $grafico->xaxis->SetLabelAngle(90.0);
            $grafico->yaxis->title->Set("");
            $grafico->Add($lineplot);
            $grafico->SetMargin(81,25,10,128);
            $grafico->SetGridDepth(DEPTH_FRONT); 
            $grafico->Stroke(IMAGES."tmp\\$fn.png");
            $imgmap = $grafico->GetHTMLImageMap("imgmap1");
            //echo $imgmap;
            $this->set(compact("fn", "imgmap"));
            //pr(h($imgmap));
            //pr($dataX);
            //pr($dataY);
        }
    }
?>