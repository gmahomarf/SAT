<?php
    class CorreosAlertasController extends AppController {
        var $name = "CorreosAlertas";
        //var $layout = "default";
        var $pageTitle = "CorreosAlertas";
        
        function a() {
        }

        function eliminar($alerta_id = null, $direccion = null) {
            if (!$alerta_id || !$direccion) {
                $this->redirect(array('controller' => 'Alertas', 'action' => 'index'));
            } else {
                $this->CorreoAlerta->deleteAll(
                    array(
                        'alerta_id' => $alerta_id,
                        'direccion' => $direccion
                    ),
                    false,
                    false
                );
                $this->redirect(array('controller' => 'Alertas', 'action' => 'contactos', $alerta_id));
            }
        }
        
        function agregar($alerta_id = null) {
            if (!$alerta_id) {
                $this->redirect(array('controller' => 'Alertas', 'action' => 'index'));
            }
            $this->set(compact('alerta_id'));
            if (!empty($this->data)) {
                $this->CorreoAlerta->save($this->data);
                $this->redirect(array('controller' => 'Alertas', 'action' => 'contactos', $alerta_id));
            }
            
        }
    }
?>