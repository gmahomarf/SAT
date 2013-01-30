<div class="contactos index">
<h2><?php __('Administraci&oacute;n de Contactos para Alerta ' . $alerta['Alerta']['descripcion']);?></h2>

<br>
<span class="titulo2">Correos Electr&oacute;nicos</span>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Direcci&oacute;n</th>
	<th>Descripci&oacute;n</th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($alerta['CorreoAlerta'] as $correo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $correo['direccion']; ?>
		</td>
        <td>
			<?php echo $correo['descripcion']; ?>
		</td>
        <td class="actions">
			<?php //echo $html->link(__('Ver', true), array('action' => 'ver', $estacion['Estacion']['id'])); ?>
			<?php //echo $html->link(__('Editar', true), array('action' => 'editar', $alerta['Alerta']['id'])); ?>
			<?php echo $html->link(__('Eliminar', true), array('controller'=> 'CorreosAlertas', 'action' => 'eliminar', $correo['alerta_id'], $correo['direccion']), null, sprintf(__('Esta seguro que desea eliminar la direccion %s?', true), $correo['direccion'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
	<ul>
		<li><?php echo $html->link(__('Nuevo Correo', true), array('controller' => 'CorreosAlertas' , 'action' => 'agregar', $alerta['Alerta']['id'])); ?></li>
	</ul>

<br>
<span class="titulo2">Mensajes de Texto</span>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Tel&eacute;fono</th>
	<th>Descripci&oacute;n</th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($alerta['SmsAlerta'] as $sms):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $sms['telefono']; ?>
		</td>
        <td>
			<?php echo $sms['descripcion']; ?>
		</td>
        <td class="actions">
			<?php //echo $html->link(__('Ver', true), array('action' => 'ver', $estacion['Estacion']['id'])); ?>
			<?php //echo $html->link(__('Editar', true), array('action' => 'editar', $alerta['Alerta']['id'])); ?>
			<?php echo $html->link(__('Eliminar', true), array('controller'=> 'SmsAlertas', 'action' => 'eliminar', $sms['alerta_id'], $sms['telefono']), null, sprintf(__('Esta seguro que desea eliminar el número %s?', true), $sms['telefono'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>

	<ul>
		<li><?php echo $html->link(__('Nuevo Sms', true), array('controller' => 'SmsAlertas' , 'action' => 'agregar', $alerta['Alerta']['id'])); ?></li>
	</ul>
    <br>
<span class="titulo2">Llamadas</span>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Tel&eacute;fono</th>
	<th>Descripci&oacute;n</th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($alerta['LlamadaAlerta'] as $llam):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $llam['telefono']; ?>
		</td>
        <td>
			<?php echo $llam['descripcion']; ?>
		</td>
        <td class="actions">
			<?php //echo $html->link(__('Ver', true), array('action' => 'ver', $estacion['Estacion']['id'])); ?>
			<?php //echo $html->link(__('Editar', true), array('action' => 'editar', $alerta['Alerta']['id'])); ?>
			<?php echo $html->link(__('Eliminar', true), array('controller'=> 'LlamadasAlertas', 'action' => 'eliminar', $llam['alerta_id'], $llam['telefono']), null, sprintf(__('Esta seguro que desea eliminar el número %s?', true), $llam['telefono'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>

	<ul>
		<li><?php echo $html->link(__('Nueva Llamada', true), array('controller' => 'LlamadasAlertas' , 'action' => 'agregar', $alerta['Alerta']['id'])); ?></li>
        <li><?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?></li>
	</ul>
</div>
