<div class="usuarios index">
<h2><?php __('Administraci&oacute;n de Cuencas');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% registros de %count%, iniciando con el registro %start%, terminando en el registro %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($cuencas as $cuenca):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $cuenca['Cuenca']['nombre']; ?>
		</td>
        <td class="actions">
			<?php //echo $html->link(__('Ver', true), array('action' => 'ver', $estacion['Estacion']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'editar', $cuenca['Cuenca']['id'])); ?>
			<?php //echo $html->link(__('Eliminar', true), array('action' => 'eliminar', $estacion['Estacion']['id']), null, sprintf(__('Esta seguro que desea eliminar %s?', true), $estacion['Estacion']['nombre'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nueva cuenca', true), array('action' => 'agregar')); ?></li>
        <li><?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?></li>
	</ul>
</div>
