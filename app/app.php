<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        $first_cd = new CD("Master of Reality", "Black Sabbath", "https://lh4.googleusercontent.com/-gfO4jon7vi8/TrlDXTiz_JI/AAAAAAAAADk/8ZBr3NzcgWI/s329-no/blacksabbath.png");
        $second_cd = new CD("Electric Ladyland", "Jimi Hendrix", "https://lh3.googleusercontent.com/-cjzf5SJBYCI/Tua1GQghZ1I/AAAAAAAAAjw/e_6BihlWFuA/s684-no/285808_10150257559186088_38858586087_7837576_7683008_o.jpg");

        $third_cd = new CD("Nevermind", "Nirvana", "http://www.nirvana.com/files/2013/09/1993photo.jpg");
        $fourth_cd = new CD("I don't get it", "Pork Lion", "http://www.psychohistorian.org/img/humour/signs/201109101707-pork-lion.jpg", 49.99);
        $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd);

        $output = "";
        foreach ($cds as $album) {
            $output.= "<div class='row'>
                <div class='col-md-6'>
                    <img src=" . $album->getCoverArt() . ">
                    </div>
                    <div class='col-md-6'>
                        <p>" . $album->getTitle() . "</p>
                        <p>By " . $album->getArtist() . "</p>
                        <p>$" . $album->getPrice() . "</p>
                    </div>
                </div>
                ";
        }

        return $output;
    });

    return $app;

 ?>
