<?php

//TODO: Singleton?
class FortuneWheel {
    const VALUES = [25,50,100,250,500,'Lose','Bankruptcy'];

    public function throw(): int | string {
        return self::VALUES[array_rand(self::VALUES)];
    }

}

?>