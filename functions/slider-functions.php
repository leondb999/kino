<?php include('./variables/connection_secrets.php') ?>
<?php
    // Referenz: https://www.codegrepper.com/code-examples/php/frameworks/symfony/dynamic+image+slider+using+twitter+bootstrap+php+with+mysql
    //oder Referenz: https://www.webslesson.info/2017/08/dynamic-product-slider-using-bootstrap-carousel-with-php.html

    $connect = mysqli_connect($servername, $username, $password);
    // DB-Abfrage für die ersten 5 Filme  
    function make_query($connect){
        return mysqli_query($connect, "Select * From kinoticketing.film Limit 5");
    }

    function make_slide_indicators($connect){
        // erzeugt die Indikatoren der Slides von 0-4 (da ja nur 5 Filme im Slider sein sollen)
        // $count wieviele Elemente aus der DB abgefragt wurden und wird am ende jeweils um 1 erhöht
        // $output die erzeugten Listenelemente mit der jeweiligen data-slide-to-Nummer 
        $output = ''; 
        $count = 0;
        
        $result = make_query($connect);// DB-Abfrage: ersten 5 Filme  
        while($row = mysqli_fetch_array($result)){
            if($count == 0){
                $output .= '
                <li data-target="#top-film-carousel" data-slide-to="'.$count.'" class="active"> </li>
                ';
            }
            else{
                $output .= '
                <li data-target="#top-film-carousel" data-slide-to="'.$count.'"></li>
                ';
            }
            $count = $count + 1;
        }
        return $output;
    }

    function make_slides($connect){
    /*  $output enthält die dynamisch erzeugten Slides mit dem jeweiligen Hintergrundbild, was aus der DB abgefragt wurde
        $count nach jedem abgefragten Element erhöht
    */

        $output = '';
        $count = 0;
        $result = make_query($connect);
        while($row = mysqli_fetch_array($result)){
            if($count == 0){
            //style="background-image: url('.$row["Image_Slider_Path"].' )"
                $output .= '<div class="carousel-item active" style ="background-image: url('.$row["Image_Slider_Path"].')">';
            }else{
            //style="background-image: url('.$row["Image_Slider_Path"].' )"
                $output .= '<div class="carousel-item" style ="background-image: url('.$row["Image_Slider_Path"].')">';
            }
            $output .= '        
                <div class="carousel-caption">
                    <h3>'.$row["Name"].'</h3>
                </div>
                </div>
                ';
            $count = $count + 1;
        }
        return $output;
    }

?>