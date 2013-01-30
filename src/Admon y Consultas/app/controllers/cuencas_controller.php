<?php
    class CuencasController extends AppController {
        var $name = "Cuencas";
        //var $layout = "default";
        var $pageTitle = "Cuencas";
        
        function index() {
            $this->Cuenca->recursive = 0;
            $this->set('cuencas', $this->paginate());
        }
        
        function agregar() {
            $this->pageTitle = 'Nueva Cuenca';
            if (!empty($this->data)) {
                $this->Cuenca->create();
                if ($this->Cuenca->save($this->data)) {
                    $this->Session->setFlash(__('La Cuenca ha sido creada', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo crear la Cuenca.', true));
                }
            }
        }
        
        function editar($id = null) {
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Cuenca no valida.', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                if ($this->Cuenca->save($this->data)) {
                    $this->Session->setFlash(__('La Cuenca ha sido modificada.', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('No se pudo modificar la cuenca.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->Cuenca->read(null, $id);
            }
        }
        
        function nueva() {
            if(!empty($this->data)) {
                //If the form data can be validated and saved...
                if($this->Cuenca->save($this->data)) {
                    //Set a session flash message and redirect.
                    $this->Session->setFlash("Guardado...");
                }
            }
        }

    }
?>