<?php

namespace wcs;

class Censor
{
    public static function censor(string $sentence, string $forbidden): string
    {
        $sentenceLength = \mb_strlen($sentence);
        $forbiddenLength = \mb_strlen($forbidden);
        if ($sentenceLength < 2 || $forbiddenLength < 2) {
            return $sentence;
        }
        $stars = "";
        for ($i = 0; $i < $forbiddenLength - 1; $i++) {
            $stars .= "*";
        }
        $position = stripos($sentence, $forbidden);
        while ($position !== false) {
            $sentence = \substr($sentence, 0, $position + 1)
            . $stars
            . \substr($sentence, $position + $forbiddenLength);
            $position = stripos($sentence, $forbidden);
        }
        return $sentence;
    }
}
