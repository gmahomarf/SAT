<?php
    //echo $html->tag("",null,array(""=>""));
    $html->loadConfig('tags');
    echo $html->docType("html4-trans");
    echo $html->tag("html",null,array("lang"=>"es"));
    echo $html->tag("head",null,array());
    echo $html->tag("meta",null,array("http-equiv"=>"Content-Script-Type", "content" => "text/javascript"));
    echo $html->charset();
    echo $html->css("pmdn");
    echo $html->tag("title",null,array());
        echo $title_for_layout;
    echo $html->tag("/title",null,array());
        echo $scripts_for_layout;
  echo $html->tag("/head",null,array());
echo $html->tag("body",null,array());?>
<div id="principal">
<?php
    echo $content_for_layout;
    ?>
</div>
    <?php
echo $html->tag("/body",null,array());
echo $html->tag("/html",null,array());
?>