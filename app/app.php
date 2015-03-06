<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/guess.php";

    session_start();
    if (empty($_SESSION['guesses'])) {
        $_SESSION['guesses'] = array();
    }


    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        //create an array with test words
        $words = array("bubble", "hunter", "tester");
        $answer = $words[rand(0,count($words) - 1)];

        if(empty($_SESSION['answer'])) {
            $_SESSION['answer'] = $answer;
        }


        return $app['twig']->render('guess.twig');
    });

    $app->post("/", function() use ($app){
        if($_POST["guess"] != "")
        {
            $guess = new Guess($_POST['guess']);
            $guess->save();
        }

        echo $_SESSION['answer'];

        var_dump($_POST);

        foreach($_SESSION['hangman'] as $g)
        {
            echo $g->getGuess();
        }

        $answer_split = preg_split('//', $_SESSION["answer"]);
        var_dump($answer_split);

        return $app['twig']->render('guess.twig', array('answer' => $answer_split));
    });

    // $app->get("/cd_form", function() use ($app){
    //     return $app['twig']->render('cd_form.twig');
    // });
    //
    // $app->post("/search", function() use($app){
    //     $search_cd = array();
    //
    //     foreach($_SESSION['list_of_cds'] as $cd)
    //     {
    //         $artist_array = preg_split('/ /', strtolower($cd->getArtist()));
    //
    //         foreach($artist_array as $item)
    //         {
    //             if($item == strtolower($_POST['search']))
    //             {
    //                 array_push($search_cd, $cd);
    //                 break;
    //             }
    //         }
    //     }
    //
    //     return $app['twig']->render('search.twig', array('searched_cds' => $search_cd));
    // });
    //
    // $app->get("/delete", function() use($app){
    //     $_SESSION['list_of_cds']= array();
    //     return $app['twig']->render('delete.twig');
    // });


    return $app;

 ?>
