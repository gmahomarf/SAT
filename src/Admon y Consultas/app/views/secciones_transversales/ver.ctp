<h2><?php __('Secci&oacute;n Transversal de '.$secciones['Estacion']['nombre']);?></h2>
<span class="seccion_transversal link_editar">
<?php echo $html->link('Editar', array('action' => 'editar', $secciones['SeccionTransversal']['estacion_id'])) ?>
</span>
<br>
<div class="seccion_transversal tabla">
<span class="seccion_transversal cero_escala" style="text-align: left; display: block;">
Cero de la escala: <?php echo $secciones['SeccionTransversal']['cero_escala'] == null ? '--' : $secciones['SeccionTransversal']['cero_escala'] ?>
</span>
<table cellpadding="2" cellspacing="0">
<tr>
	<th>X</th>
	<th>Y</th>
</tr>
<?php
$i = 0;
foreach ($secciones['PuntoSeccionTransversal'] as $punto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $punto['x']; ?>
		</td>
		<td>
			<?php echo $punto['y']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="seccion_transversal graf">
    <?php 
        echo $html->image(array('controller' => 'Consultas', 'action' => 'seccionTransversal', $secciones['Estacion']['nombre']));
    ?>
</div>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al menú anterior', true), array('action' => 'index')); ?>
<br>
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>