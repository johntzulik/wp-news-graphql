<?php

/** 
 * Aqui crearemos el html de la primera página
 */

$datos = get_option('setep_news_refresh');
$news = $datos[0]['setepnews'];
$pathImage = "https://server.setep.org.mx/noticia-image/";

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="display-4 text-center">Lista de noticias</h2>
        </div>
    </div>
    <div class="row">
        <?php 
        if($news != ''){

            foreach($news as $key => $new):
                
                $output = "
                <div class='col-md-4 col-sm-6'>
                    <div class='card mb-5 mt-5'>
                        <div class='row g-0'>
                            <div class='col-md-4 mt-4'>
                            <img src='". $pathImage.$new['image']."' class='img-fluid rounded-start' style='margin: 0 auto;width: 100%;'>
                            </div>
                            <div class='col-md-8'>
                                <div class='card-body'>
                                    <p class='card-text'>
                                        <small class='text-muted'>".date('d/m/Y', ($new['fechayhora'])/1000)."</small><br>
                                        <small class='text-muted'>". date('H:i:s', ($new['fechayhora'])/1000) ."</small>
                                    </p>
                                    <p class='card-title'><strong>". str_replace('\"','"', $new['title']) ."</strong></p>
                                    <p class='card-text'>"  . substr(html_entity_decode( $new['body']), 0, 100) ."</p><br>
                                </div>
                            </div>
                            <div class='col-md-12'>
                            <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='' id='flexCheckChecked' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                              Checked checkbox
                            </label>
                          </div>
                                <div class='form-check form-switch'>
                                    <input class='form-check-input' type='checkbox' role='switch' id='flexSwitchCheckDefault'>
                                    <label class='form-check-label' for='flexSwitchCheckDefault'>Incluir</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
                echo $output;
            endforeach;
        }else{
            echo $outpup = '';
        }
        ?>
    </div>
</div>