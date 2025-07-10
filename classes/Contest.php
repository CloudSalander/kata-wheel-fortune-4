<?php

include('classes/FortuneWheel.php');

class Contest {
    
    const CONTESTANTS_NUMBER = 3;
    const THROW_WHEEL_MSG = " throw the wheel!";
    const WHEEL_RESULT_MSG = "Result throw result was ";
    const BANKRUPTCY_MSG = "OOOOOOOOOOOOOOOOOOOOOHHHHHH!!!";
    const LOSE_TURN_MSG = "Oh...";
    const OPTIONS = "What do you want to do?".PHP_EOL."1- Say letter".PHP_EOL."2- Say solution";


    
    public function __construct(private Panel $panel, private array $contestants) {
        $this->turnNumber = 0;
        $this->wheel = new FortuneWheel();
        $this->currentContestantIndex = 1;
    }
    
    public function play(): void {
        while(!$this->panel->isSolved()) {
            $passTurn = true;

            $this->panel->show();

            $this->currentContestantIndex = $this->turnNumber % self::CONTESTANTS_NUMBER;
            $currentContestant = $this->contestants[$this->currentContestantIndex];

            echo $currentContestant->getName().self::THROW_WHEEL_MSG.PHP_EOL;
            $wheelValue = $this->wheel->throw();
            echo self::WHEEL_RESULT_MSG.$wheelValue.PHP_EOL;

            if($wheelValue == 'Bankruptcy') $this->makeBankruptcy($currentContestant);
            else if($wheelValue == 'Lose') echo self::LOSE_TURN_MSG.PHP_EOL;
            else {
                $option = intval(readline(self::OPTIONS));
                $turnResolution = match ($option) {
                    1 => $this->playLetter($currentContestant,$wheelValue),
                    2 => $this->solvePanel($currentContestant)
                };
                if($option == 2 && $turnResolution) return;
               
            } 
            if($passTurn) ++$this->turnNumber;
            $this->showScores();
        }
    }

    private function makeBankruptcy(Contestant $contestant): void {
        $contestant->declareBankruptcy();
        echo self::BANKRUPTCY_MSG.PHP_EOL;
    }
    
    private function playLetter(Contestant $contestant, int $wheelValue): bool {
        $currentLetter = $contestant->sayLetter();
        echo PHP_EOL;
        $solvedLetters = $this->panel->solveLetter($currentLetter);
        if($solvedLetters > 0) {
            $contestant->updatePoints($solvedLetters*$wheelValue);
            return false;
        }     
        return true;
    }

    private function solvePanel(Contestant $contestant): bool {
        $possibleSolution = $contestant->saySolution();
        return $this->panel->solvePanel($possibleSolution);
    }

    private function showScores(): void {
        foreach($this->contestants as $contestant) {
            echo $contestant->getName()." : ".$contestant->getScore().PHP_EOL;
        }
    }
}

?>