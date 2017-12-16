<?php

use PHPUnit\Framework\TestCase;
use Phil404\RiotAPI\Models\LoLStatus\Incident;
use Phil404\RiotAPI\Models\LoLStatus\Message;

class IncidentTest extends TestCase
{
    public function testIncident()
    {
        $incident = new Incident();
        $this->assertTrue(is_object($incident));
    }

    public function testConstructor()
    {
        $message = new Message();

        $incident = new Incident(
            ["active" => true,
            "created_at" => "DateA",
            "id" => 123,
            "updates" => [$message]]
        );

        $this->assertTrue($incident->getActive());
        $this->assertEquals("DateA", $incident->getCreatedAt());
        $this->assertEquals(123, $incident->getId());
        $this->assertEquals([$message], $incident->getUpdates());
    }

    public function testConstructorWithMessageAsArray()
    {
        $incident = new Incident(
            ["active" => true,
            "updates" => [["author" => "Hans"]]]
        );

        $this->assertEquals(1, sizeof($incident->getUpdates()));
        $this->assertTrue($incident->getUpdates()[0] instanceof Message);

        $update = (object) $incident->getUpdates()[0];

        $this->assertEquals("Hans", $update->getAuthor());
    }

    public function testConstructorWithoutMessage()
    {
        $incident = new Incident(["updates" => []]);

        $this->assertEquals(0, sizeof($incident->getUpdates()));
    }

    public function testSetAndGetActive()
    {
        $incident = new Incident();
        $incident->setActive(true);

        $this->assertTrue($incident->getActive());

        $incident->setActive(false);

        $this->assertFalse($incident->getActive());
    }

    public function testSetAndGetCreatedAt()
    {
        $incident = new Incident();
        $incident->setCreatedAt("DateA");

        $this->assertEquals("DateA", $incident->getCreatedAt());

        $incident->setCreatedAt("DateB");

        $this->assertEquals("DateB", $incident->getCreatedAt());
    }

    public function testSetAndGetId()
    {
        $incident = new Incident();
        $incident->setId(123);

        $this->assertEquals(123, $incident->getId());

        $incident->setId(789);

        $this->assertEquals(789, $incident->getId());
    }

    public function testSetAndGetUpdates()
    {
        $messageA = new Message();
        $messageB = new Message();

        $incident = new Incident();
        $incident->setUpdates([$messageA]);

        $this->assertEquals([$messageA], $incident->getUpdates());

        $incident->setUpdates([$messageA, $messageB]);

        $this->assertEquals([$messageA, $messageB], $incident->getUpdates());
    }
}