<?php

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testSettingName()
    {
        $trick = new Video();
        $this->assertSame(null, $trick->getEmbed());

        $trick->setEmbed('https://www.youtube.com/embed/XGSy3_Czz8k');
        $this->assertSame('https://www.youtube.com/embed/XGSy3_Czz8k', $trick->getEmbed());
    }

    public function testSettingNEmbed()
    {
        $trick = new Video();
        $this->assertSame(null, $trick->getEmbed());

        $trick->setEmbed('https://www.youtube.com/embed/XGSy3_Czz8k');
        $this->assertSame('https://www.youtube.com/embed/XGSy3_Czz8k', $trick->getEmbed());
    }

    public function testSettingNCaption()
    {
        $trick = new Video();
        $this->assertSame(null, $trick->getCaption());

        $trick->setCaption('A girl singing');
        $this->assertSame('A girl singing', $trick->getCaption());
    }

    public function testSettingTrick()
    {
        $trick = new Trick();
        $video = new Video();

        $video->setTrick($trick);
        $this->assertSame($trick, $video->getTrick());
    }


}