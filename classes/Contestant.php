<?php
class Contestant {

    private string $name;
    public int $points;

    const SINGLE_LETTER_PATTERN = "/^[a-zA-Z]$/";

    public function __construct(string $name){
        $this->name = $name;
        $this->points = 0;
    }
    public function sayLetter(): string { 
        $letter = readline();
        while(! $this->isValidChar($letter)) {
            $letter = readline();
        }
        return strtoupper($letter);
    }

    public function saySolution(): string {
        //TODO: Actually, to be different to say letter, I should control this is atext, not only a char.
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

    private function isValidChar(string $char): bool {
        return preg_match(self::SINGLE_LETTER_PATTERN, $char) === 1;
    }
}

?>