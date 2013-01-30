<?php
    class EstacionesController extends AppController {
        var $name = "Estaciones";
        //var $layout = "default";
        var $pageTitle = "Estaciones";
        
        function index() {
            $this->Estacion->recursive = 0;
            $this->set('estaciones', $this->paginate());
        }
        
        function agregar() {
            $this->_getResponsables();
            $this->_getCuencas();
            $this->_getAlertas();
            $this->pageTitle = 'Nueva Estaci&oacute;n';
            if (!empty($this->data)) {
                $this->data["Estacion"]["id_satelital"] = strtoupper($this->data["Estacion"]["id_satelital"]);
                $this->data["Estacion"]["nombre"] = strtoupper($this->data["Estacion"]["nombre"]);
                if ($this->data['Estacion']['alerta_id'] == 'null')
                    $this->data['Estacion']['alerta_id'] == null;
                $this->Estacion->create();
                if ($this->Estacion->save($this->data)) {
                    $this->Session->setFlash(__('La Estacion ha sido creada', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo crear la Estacion.', true));
                }
            }
        }
        
        function editar($id = null) {
            $this->_getResponsables();
            $this->_getCuencas();
            $this->_getAlertas();
            $this->pageTitle = 'Editar Estaci&oacute;n';
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Estacion no valida.', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                $this->data["Estacion"]["id_satelital"] = strtoupper($this->data["Estacion"]["id_satelital"]);
                $this->data["Estacion"]["nombre"] = strtoupper($this->data["Estacion"]["nombre"]);
                if ($this->data['Estacion']['alerta_id'] == 'null')
                    $this->data['Estacion']['alerta_id'] == NULL;
                if ($this->Estacion->save($this->data)) {
                    $this->Session->setFlash(__('La Estacion ha sido modificada.', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo modificar la estacion.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->Estacion->read(null, $id);
            }
        }
        
        function nueva() {
            if(!empty($this->data)) {
                //If the form data can be validated and saved...
                $this->data["Estacion"]["id_satelital"] = strtoupper($this->data["Estacion"]["id_satelital"]);
                if($this->Estacion->save($this->data)) {
                    //Set a session flash message and redirect.
                    $this->Session->setFlash("Guardado...");
                }
            }
        }
        
        function _getResponsables() {
            $responsable = array('' => '-- Ninguno --');
             $responsable += $this->Estacion->Responsable->find  
             (  
                 'list',  
                 array  
                 (  
                     'fields' => array('id', 'nombre'),  
                     'order' => 'Responsable.nombre ASC',  
                    'recursive' => -1  
                 )  
             );  
   
         $this->set(compact('responsable'));  
        }
        
        function _getCuencas() {
            $cuencas = array('' => '-- Ninguna --');
            $cuencas += $this->Estacion->Cuenca->find  
            (  
                'list',  
                array  
                (  
                    'fields' => array('id', 'nombre'),  
                    'order' => 'Cuenca.nombre ASC',  
                   'recursive' => -1  
                )  
            );  
   
        $this->set(compact('cuencas'));  
        }
        
        function _getAlertas() {
            $alertas = array('' => '-- Ninguna --');
            $alertas += $this->Estacion->Alerta->find  
            (  
                'list',  
                array  
                (  
                    'fields' => array('id', 'descripcion'),  
                    'order' => 'Alerta.descripcion ASC',  
                    'recursive' => -1  
                )  
            );  
   
         $this->set(compact('alertas'));  
        }
        
        function a() {
            $alertas = array(0 => '-- Ninguna --');
            $alertas += $this->Estacion->Alerta->find  
             (  
                 'list',  
                 array  
                 (  
                     'fields' => array('id', 'descripcion'),  
                     'order' => 'Alerta.descripcion ASC',  
                    'recursive' => -1  
                 )  
             );
            print_r($alertas);
            print_r($this->Estacion->Alerta->find  
             (  
                 'list',  
                 array  
                 (  
                     'fields' => array('id', 'descripcion'),  
                     'order' => 'Alerta.descripcion ASC',  
                    'recursive' => -1  
                 )  
             ));
        }
    }
?>