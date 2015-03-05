<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    session_start();
    if (empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app){

        return $app['twig']->render('homepage.twig');
    });

    $app->post("/", function() use ($app){
        if ($_POST['title'] != "" && $_POST['artist'] !="" && $_POST['price'] !="" && $_POST['image'] !="")
        {
            $cd = new CD($_POST['title'], $_POST['artist'], $_POST['image'], $_POST['price']);
            $cd->save();
        }

        echo "We sent from a form!";

        return $app['twig']->render('homepage.twig', array('cds' => CD::getCds()));
    });

    $app->get("/cd_form", function() use ($app){
        return $app['twig']->render('cd_form.twig');
    });



    return $app;

 ?>
