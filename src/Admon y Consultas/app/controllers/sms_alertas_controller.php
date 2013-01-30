<?php
    class SmsAlertasController extends AppController {
        var $name = "SmsAlertas";
        //var $layout = "default";
        var $pageTitle = "SmsAlertas";
        
        function a() {
        }
        
        function eliminar($alerta_id = null, $tel = null) {
            if (!$alerta_id || !$tel) {
                $this->redirect(array('controller' => 'Alertas', 'action' => 'index'));
            } else {
                $this->SmsAlerta->deleteAll(
                    array(
                        'alerta_id' => $alerta_id,
                        'telefono' => $tel
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
                $this->SmsAlerta->save($this->data);
                $this->redirect(array('controller' => 'Alertas', 'action' => 'contactos', $alerta_id));
            }
            
        }

    }
?>