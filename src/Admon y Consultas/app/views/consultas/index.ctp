<?php
    echo $javascript->link("mootools-core", false);
    echo $javascript->link("mootools-more", false);
    echo $html->tag('h1', 'Consultas');
    echo $html->tag('span', 
        $html->link('Búsqueda', array('controller' => 'consultas', 'action' => 'consultar'))
        );
    echo $html->tag('h2', 'Mapas');
    echo $html->link('Ulua', array('controller' => 'consultas', 'action' => 'mapas', 'ulua'));
    echo $html->tag('br');
    echo $html->link('Aguan', array('controller' => 'consultas', 'action' => 'mapas', 'aguan'));
    echo $html->tag('br');
    echo $html->link('Choluteca', array('controller' => 'consultas', 'action' => 'mapas', 'choluteca'));
?>
<br>
<br>
<div class="actions">
<?php echo $html->link(__('Regresar al Menú Principal', true), '/'); ?>
<br>
</div>