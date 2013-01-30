<?php
    class ResponsablesController extends AppController {
        var $name = "Responsables";
        //var $layout = "default";
        var $pageTitle = "Responsables";
        
        function index() {
            $this->Responsable->recursive = 0;
            $this->set('responsables', $this->paginate());
        }
        
        function agregar() {
            $this->pageTitle = 'Nuevo Responsable';
            if (!empty($this->data)) {
                $this->Responsable->create();
                if ($this->Responsable->save($this->data)) {
                    $this->Session->setFlash(__('El responsable ha sido creado', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo crear el Responsable.', true));
                }
            }
        }
        
        function editar($id = null) {
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Responsable no valido.', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                if ($this->Responsable->save($this->data)) {
                    $this->Session->setFlash(__('El responsable ha sido modificado.', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo modificar el Responsable.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->Responsable->read(null, $id);
            }
        }
        
        function nueva() {
            if(!empty($this->data)) {
                //If the form data can be validated and saved...
                if($this->Responsable->save($this->data)) {
                    //Set a session flash message and redirect.
                    $this->Session->setFlash("Guardado...");
                }
            }
        }
    }
?>