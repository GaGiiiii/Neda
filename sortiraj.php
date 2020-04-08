<?php

    require_once 'classes/Knjiga.php';

    if(isset($_POST['vrstaSorta'])){
        $html = '';

        if($_POST['vrstaSorta'] == 'cena'){
            $knjige = Knjiga::sortirajPoCeni();

            foreach($knjige as $knjiga){
                $html .= "";
            }


            echo $html;
        }else if($_POST['vrstaSorta'] == 'naziv'){
            $knjige = Knjiga::sortirajPoNazivu();



            echo $html;
        }
    }
    