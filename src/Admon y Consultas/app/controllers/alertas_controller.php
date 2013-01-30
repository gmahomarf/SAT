<?php
    class AlertasController extends AppController {
        var $name = "Alertas";
        //var $layout = "default";
        var $pageTitle = "Alertas";
        
        function index() {
            $this->Alerta->recursive = 0;
            $this->set('alertas', $this->paginate());
        }
        
        function contactos($id = null) {
            if (!$id) {
                $this->redirect(array('action' => 'index'));
            }
            $alerta = $this->Alerta->read(null, $id);
            $this->set(compact('alerta'));
        }
        
        function agregar() {
            $this->pageTitle = 'Nueva Alerta';
            if (!empty($this->data)) {
                $this->Alerta->create();
                if ($this->Alerta->save($this->data)) {
                    $this->Session->setFlash(__('La Alerta ha sido creada', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo crear la Alerta.', true));
                }
            }
        }
        
        function editar($id = null) {
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Alerta no valida.', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                if ($this->Alerta->save($this->data)) {
                    $this->Session->setFlash(__('La Alerta ha sido modificada.', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo modificar la alerta.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->Alerta->read(null, $id);
            }
        }
        
        function nueva() {
            if(!empty($this->data)) {
                //If the form data can be validated and saved...
                if($this->Alerta->save($this->data)) {
                    //Set a session flash message and redirect.
                    $this->Session->setFlash("Guardado...");
                }
            }
        }

    }
?>