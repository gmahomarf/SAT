<?php
            App::import("Helper","Form");
            App::import("Helper","Javascript");
            $form = new FormHelper();
            $js = new JavascriptHelper();
            echo $js->link("mootools");
            echo $form->create();
                echo $form->input('username');   //text
                echo $form->input('password');   //password
                echo $form->input('approved');   //day, month, year, hour, minute, meridian
                echo $form->input('quote');      //textarea
            echo $form->end('Add');
?>