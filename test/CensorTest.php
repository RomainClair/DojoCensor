<?php

namespace wcs;

use PHPUnit\Framework\TestCase;
use wcs\Censor;

class CensorTest extends TestCase
{
    public function testEmptySentence()
    {
        $this->assertSame("", Censor::censor("", ""));
        $this->assertSame("", Censor::censor("", "Something"));
    }

    public function testEmptyForbidden()
    {
        $this->assertSame("Some phrase", Censor::censor("Some phrase", ""));
        $this->assertSame("Une phrase accentuée", Censor::censor("Une phrase accentuée", ""));
    }

    public function testModifiedOnce()
    {
        $this->assertSame("S*******", Censor::censor("Sentence", "Sentence"));
        $this->assertSame("V******** is back", Censor::censor("Voldemort is back", "voldemort"));
    }

    public function testMultipleModification()
    {
        $this->assertSame("W*** and W***", Censor::censor("Word and Word", "Word"));
        $this->assertSame(
            "En variant le ton, – par exemple, ten** : Agressif : « Moi, monsieur, si j’avais un tel n**, il faudrait sur-le-champ que je me l’amputasse ! »",
            Censor::censor(
                "En variant le ton, – par exemple, tenez : Agressif : « Moi, monsieur, si j’avais un tel nez, il faudrait sur-le-champ que je me l’amputasse ! »",
                "nez"
            )
        );
    }

    public function testMultipleModificationCaseInsensitive()
    {
        $this->assertSame("W*** and w***", Censor::censor("Word and word", "Word"));
        $this->assertSame("W*** and w***", Censor::censor("Word and word", "word"));
    }
    
}
