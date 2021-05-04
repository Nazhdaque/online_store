<?php
    namespace ForTraining\Farm;
    
    abstract class Animals implements 
    \ForTraining\Interfaces\Farm\Run, 
    \ForTraining\Interfaces\Farm\Sleep, 
    \ForTraining\Interfaces\Farm\Eat, 
    \ForTraining\Interfaces\Farm\Jump
    {
        public function eat()
        {
            echo'eat-eat-eat';
            echo'<br>';
        }

        public function sleep()
        {
            echo'sleep-sleep-sleep';
            echo'<br>';
        }

        public function run()
        {
            echo'run-run-run';
            echo'<br>';
        }

        public function jump()
        {
            echo'jump-jump-jump';
            echo'<br>';
        }
    }