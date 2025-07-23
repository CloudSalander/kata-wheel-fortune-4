<?php
class Contestant {

    private string $name;
    public int $points;

    const SINGLE_LETTER_PATTERN = "/^[a-zA-Z]$/";
    const ONLY_LETTERS_PATTERN = "/^[a-zA-Z\s]+$/";

    public function __construct(string $name){
        $this->name = $name;
        $this->points = 0;
    }
    public function sayLetter(): string { 
        $letter = readline();
        while(!$this->isValidChar($letter)) {
            $letter = readline();
        }
        return strtoupper($letter);
    }

    public function saySolution(): string {
        $text = readline();
        while(!$this->isValidText($text)) {
            $text = readline();
        }
        return $text;
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

    private function isValidText(string $text): bool {
        return preg_match(self::ONLY_LETTERS_PATTERN, $text) === 1;
    }
}

?>