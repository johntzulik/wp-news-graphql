<?php 
function setep_enqueue_style_public(){

    //Encolando la libreria de bootstrap 5
    wp_enqueue_style(
        'bootstrap-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap.min.css',
        [],
        '5.2.0',
        'all'
    );

        
    wp_enqueue_style(
        'bootstrap-grid-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.2/css/bootstrap-grid.min.css',
        [],
        '5.2.0',
        'all'
    );
    //Encolando css
    wp_enqueue_style(
        'admin-style',
        plugin_dir_url( __DIR__ ) . 'public/css/setep-news.css',
        [],
        '1.0.0',
        'all'
    );

}
add_action( 'wp_enqueue_scripts', 'setep_enqueue_style_public' );

function setep_enqueue_scripts_public(){

    //Encolando js
    wp_enqueue_script(
        'admin-script',
        plugin_dir_url( __DIR__ ) . 'public/js/setep-news.js',
        ['jquery', 'bootstrap-min'],
        '1.0.0',
        true
    );

}
add_action( 'wp_enqueue_scripts', 'setep_enqueue_scripts_public' );

//función para el shortcode
function setep_news_public( $atts, $content = '' ){
    $args = shortcode_atts(
        array(
            'show' => '',
        ),
        $atts
    );

    extract( $args, EXTR_OVERWRITE);
    $pathImage = "https://server.setep.org.mx/noticia-image/";
    $datos = get_option('setep_news_refresh');
    $new = $datos[0]['setepnews'];
    if($new != null){
        if($show == 'all' || $show == '' ){
            $length = count($new);
            $output = '<div class="container setepnews"><div class="row">';
            for ($i = 0; $i < $length; $i++) { 
                $output.= "
                <div class='col-md-6 col-sm-12'>
                <div class='card my-md-5 my-sm-1'>
                    <div class='row g-0'>
                        <div class='col-md-4 mt-4'>
                        <img src='". $pathImage.$new[$i]['image']."' class='img-fluid rounded-start' style='margin: 0 auto;width: 100%;'>
                        </div>
                        <div class='col-md-8'>
                        <div class='card-body'>
                            <p class='card-text'>
                                <small class='text-muted'><strong>".date('d/m/Y', ($new[$i]['fechayhora'])/1000)."</strong></small><br>
                                <small class='text-muted'>". date('H:i:s', ($new[$i]['fechayhora'])/1000) ."</small>
                            </p>
                            <p class='card-title'><strong>". str_replace('\"','"', $new[$i]['title']) ."</strong></p>
                            <p class='card-text'>"  . substr(html_entity_decode( $new[$i]['body']), 0, 100) ."</p><br>
                            <a href='/noticia/?id=". $new[$i]['id'] ."'>Ver noticia > </a>
                        </div>
                        </div>
                    </div>
                </div></div>
                    ";
            }
            $output.= '</div></div>';
        }else if($show == 'some' ){
            $output = '<div class="container setepnews"><div class="row">';
            for ($i = 0; $i < 6; $i++) { 
                $output.= "
                <div class='col-md-6 col-sm-12'>
                <div class='card my-md-5 my-sm-1'>
                    <div class='row g-0'>
                        <div class='col-md-4 mt-4'>
                        <img src='". $pathImage.$new[$i]['image']."' class='img-fluid rounded-start' style='margin: 0 auto;width: 100%;'>
                        </div>
                        <div class='col-md-8'>
                        <div class='card-body'>
                            <p class='card-text'>
                                <small class='text-muted'><strong>".date('d/m/Y', ($new[$i]['fechayhora'])/1000)."</strong></small><br>
                                <small class='text-muted'>". date('H:i:s', ($new[$i]['fechayhora'])/1000) ."</small>
                            </p>
                            <p class='card-title'><strong>". str_replace('\"','"', $new[$i]['title']) ."</strong></p>
                            <p class='card-text'>"  . substr(html_entity_decode( $new[$i]['body']), 0, 100) ."</p><br>
                            <a href='/noticia/?id=". $new[$i]['id'] ."'>Ver noticia > </a>
                        </div>
                        </div>
                    </div>
                </div></div>
                    ";
            }
            $output.= '</div></div>';
        }
    }else{
        $output = "<h5>No hay noticias aun</h5>";
    }
    return $output;
}
add_shortcode( 'setepnews', 'setep_news_public' );


function setep_new_public( $atts, $content = '' ){

    $pathImage = "https://server.setep.org.mx/noticia-image/";
    $datos = get_option('setep_news_refresh');
    
    $new = $datos[0]['setepnews'];

    if($new != null){
        $length = count($new);

        $_id = $_GET['id'];
        $output = "";
        if($_GET['id'] != null){
            for ($i = 0; $i < $length; $i++) { 
                if($new[$i]['id'] == $_id){
                    $output= "
                        <div class='card mb-3' style='width:100%;'>
                            <div class='row g-0'>
                                <div class='col-md-4'>
                                <img src='". $pathImage.$new[$i]['image']."' class='img-fluid rounded-start'>
                                </div>
                                <div class='col-md-8'>
                                <div class='card-body'>
                                    <h2 class='card-title'>". str_replace('\"','"', $new[$i]['title']) ."</h2>
                                    <p class='card-text'>
                                    <small class='text-muted'><strong>".date('d/m/Y', ($new[$i]['fechayhora'])/1000)."</strong></small><br>
                                        <small class='text-muted'>". date('H:i:s', ($new[$i]['fechayhora'])/1000) ."</small>
                                    </p>    
                                    <p class='card-text'>"  . str_replace('\"','"',html_entity_decode( $new[$i]['body']))    ."</p>
                                </div>
                                </div>
                            </div>
                        </div>";
                }
            }
            if($output == ""){
                $output= "<h5>No se encontro la noticia</h5>";
            }
        }
    }
    return $output;
}

add_shortcode( 'setepnew', 'setep_new_public' );