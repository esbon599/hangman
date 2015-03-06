<?php
    class Guess
    {
        private $guess;

        function __construct($g)
        {
            $this->guess = $g;
        }

        function getGuess() {
            return $this->guess;
        }

        function save()
        {
            array_push($_SESSION['hangman'], $this);
        }
    }
    ?>
