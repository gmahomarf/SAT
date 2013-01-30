<?php
    class SeccionesTransversalesController extends AppController {
        var $name = "SeccionesTransversales";
        //var $layout = "default";
        var $pageTitle = "Secciones Transversales";

        
        function index() {
            $this->redirect(array('controller' => 'Estaciones', 'action' => 'index'));
        }

        function ver($est = null) {
            if (!$est) {
                $this->redirect(array('controller' => 'Estaciones', 'action' => 'index'));
            }
            
            //print_r($this);
            $secciones = $this->SeccionTransversal->find('first', array('conditions' => array('estacion_id' => $est)));
            if(empty($secciones)) {
                $this->SeccionTransversal->create();
                $this->SeccionTransversal->set('estacion_id', $est);
                $this->SeccionTransversal->save();
                $secciones = $this->SeccionTransversal->find('first', array('conditions' => array('estacion_id' => $est)));
            }
            
            $this->set(compact('secciones'));
        }
        
        function _isUploadedFile($params){
            $val = array_shift($params);
            if ((isset($val['error']) && $val['error'] == 0) ||
              (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')) {
                return true;
            }
            return false;
        }
        
        function editar($est = null) {
            if (!$est && empty($this->data)) {
                $this->redirect(array('controller' => 'Estaciones', 'action' => 'index'));
            }
            if (!empty($this->data)) {
                if ($this->SeccionTransversal->save($this->data)) {
                    if ($this->_isUploadedFile($this->data['SeccionTransversal']['xls'])) {
                        $tName = sprintf("%d",time());
                        move_uploaded_file($this->data['SeccionTransversal']['xls']['tmp_name'], APP_PATH.TMP.$tName);
                        //rename($this->data['SeccionTransversalXls']['tmp_name'], $tName);
                        $this->redirect(array('action' => 'revisar', $this->data['SeccionTransversal']['estacion_id'], $this->data['SeccionTransversal']['id'], $tName));/***********************************************/
                    } else {
                        $this->redirect(array('action' => 'ver', $this->data['SeccionTransversal']['estacion_id']));
                    }
                } else {
                    pr($this->data); return;
                        
                    $this->Session->setFlash(__('No se pudo modificar la Secci&oacute;n Transversal.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->SeccionTransversal->find('first', array('conditions' => array('estacion_id' => $est)));
                /*if (empty($this->data)) {
                    $this->SeccionTransversal->create();
                    $this->SeccionTransversal->set('estacion_id', $est);
                    $this->SeccionTransversal->save();
                    $this->data = $this->SeccionTransversal->find('first', array('conditions' => array('estacion_id' => $est)));
                }*/
            }
            $this->set(compact('est'));
        }
        
        function revisar($est, $secc, $file) {
            App::Import('vendor', 'excel/excel_reader2');
            if(!$file) {
                $this->Redirect($this->referer());
            }
            $data = new Spreadsheet_Excel_Reader(APP_PATH.TMP.$file);
            if (strtolower($data->val(1,'A',0)) != 'x' || strtolower($data->val(1,'B',0)) != 'y') {
                $this->set('errorEncab', TRUE);
            }
            $i = 0;
            $fila = 2;
            $puntos = array();
            while (TRUE) {
                if ($data->val($fila,'A',0) == '' && $data->val($fila,'B',0) == '') {
                    
                    break;
                }
                $puntos[$i] = array(
                    'PuntoSeccionTransversal' => array(
                        'seccion_transversal_id' => $secc, 
                        'x' => $data->val($fila,'A',0), 
                        'y' => $data->val($fila,'B',0)
                    )
                );
                $i++;
                $fila++;
            }
            $this->SeccionTransversal->PuntoSeccionTransversal->deleteAll("seccion_transversal_id = $secc", false);
            foreach ($puntos as $punto) {
                $this->SeccionTransversal->PuntoSeccionTransversal->save($punto);
            }
            $this->set(compact('data', 'puntos', 'i', 'fila', 'est'));
            //echo $data->dump(true,true);
        }
    }
?>