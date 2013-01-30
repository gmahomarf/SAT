<?php
     if ($this->getVar('errorEncab')) {
        echo 'Error en el encabezado';
     } else {
         /*pr('I -> ' . $this->getVar('i'));
         pr('Fila -> ' . $this->getVar('fila'));
         pr('Valor (x,y)' . $data->val($fila,'A',0) . ', ' . $data->val($fila,'B',0));
         pr($puntos);*/
         echo "Se almacenaron los siguientes datos exitosamente: <br>";
         echo $data->dump(true,true);
     }
?>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar a la sección transversal', true), array('action' => 'ver', $this->getVar('est'))); ?>
<br>
<?php echo $html->link(__('Regresar a la Administración de Estaciones', true), array('controller' => 'Estaciones', 'action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>