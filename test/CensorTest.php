<?php

namespace wcs;

use PHPUnit\Framework\TestCase;
use wcs\Censor;

class CensorTest extends TestCase
{
    public function testCensorExists()
    {
        $this->assertTrue(method_exists(Censor::class, "censor"), "The Censor::censor static method does not exists");
    }

    /**
     * @depends testCensorExists
     * @dataProvider sentenceProvider
     */
    public function testCensor(string $expected, string $toCensor, string $forbiddenWord, string $message)
    {
        $this->assertSame($expected, Censor::censor($toCensor, $forbiddenWord), $message);
    }

    public function sentenceProvider(): array
    {
        return [
            ["", "", "", "Censoring empty sentences must return empty results"],
            ["", "", "Something", "Censoring empty sentences must return empty results"],
            ["Some phrase", "Some phrase", "", "Censoring using a blank word must let sentences unchanged"],
            [
                "Une phrase accentuée",
                "Une phrase accentuée",
                "",
                "Censoring using a blank word must let sentences unchanged"
            ],
            ["S*******", "Sentence", "Sentence", "Censoring Sentence in Sentence must return S*******"],
            [
                "V******** is back",
                "Voldemort is back",
                "voldemort",
                "Censoring voldemort in 'Voldemort is back' must return V******** is back"
            ],
            ["W*** and W***", "Word and Word", "Word", "Censoring Word in 'Word and Word' must return W*** and W***"],
            [
                "En variant le ton, – par exemple, ten** : Agressif : « Moi, monsieur, si j’avais un tel n**, il faudrait sur-le-champ que je me l’amputasse ! »",
                "En variant le ton, – par exemple, tenez : Agressif : « Moi, monsieur, si j’avais un tel nez, il faudrait sur-le-champ que je me l’amputasse ! »",
                "nez",
                "Censoring nez in 'En variant le ton, – par exemple, tenez : Agressif : « Moi, monsieur, si j’avais un tel nez, il faudrait sur-le-champ que je me l’amputasse ! »' must return 'En variant le ton, – par exemple, ten** : Agressif : « Moi, monsieur, si j’avais un tel n**, il faudrait sur-le-champ que je me l’amputasse ! »'"
            ],
            ["W*** and w***", "Word and word", "Word", "Censoring Word in 'Word and word' must return 'W*** and w***'"],
            ["W*** and w***", "Word and word", "word", "Censoring word in 'Word and word' must return 'W*** and w***'"],
            ["Back in b****", "Back in black", "Black", "Censoring Black in Back in black must return Back in b****"],
            ["B*** in black", "Back in black", "Back", "Censoring Back in Back in black must return B*** in black"],
            ["Back in b****", "Back in black", "black", "Censoring black in Back in black must return Back in b****"],
            ["B*** in black", "Back in black", "back", "Censoring back in Back in black must return B*** in black"],
        ];
    }
}
