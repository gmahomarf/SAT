<div class="usuarios index">
<h2><?php __('Usuarios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% registros de %count%, iniciando con el registro %start%, terminando en el registro %end%', true)
));
?></p>
<table cellpadding="2" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('nombre_usuario');?></th>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th><?php echo $paginator->sort('apellido');?></th>
	<th><?php echo $paginator->sort('grupo');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$grupos = array(
        1 => 'Administrador',
        2 => 'Usuario'
        );
$i = 0;
foreach ($usuarios as $usuario):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $usuario['Usuario']['nombre_usuario']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['nombre']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['apellido']; ?>
		</td>
		<td>
			<?php echo $grupos[$usuario['Usuario']['grupo']]; ?>
		</td>
		<td class="actions">
			<?php //echo $html->link(__('View', true), array('action' => 'view', $usuario['Usuario']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
			<?php //echo $html->link(__('Delete', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['Usuario']['id'])); ?>
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
		<li><?php echo $html->link(__('Nuevo Usuario', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?></li>
	</ul>
</div>
