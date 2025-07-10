<?php
class Contestant {

    private string $name;
    public int $points;

    public function __construct(string $name){
        $this->name = $name;
        $this->points = 0;
    }
    public function sayLetter(): string { 
        //TODO: Check right input here. Just one char. Char must be an allowed letter.
        return strtoupper(readline());
    }

    public function getName(): string {
        return $this->name;
    }

    public function declareBankruptcy(): void {
        $this->points = 0;
    }
    
    public function updatePoints(int $score): void {
        $this->points += $score;
    }

    public function getScore(): int {
        return $this->points;
    }
}

?>