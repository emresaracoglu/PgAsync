<?php

namespace PgAsync\Command;

use PgAsync\Message\Message;
use Rx\Subject\Subject;

class Describe implements CommandInterface
{
    use CommandTrait;

    private $portalOrStatement;
    private $name;

    public function __construct($name = "")
    {
        $this->name              = $name;
        $this->portalOrStatement = 'P';
        $this->subject           = new Subject();
    }

    public function encodedMessage()
    {
        return 'D' . Message::prependLengthInt32("{$this->portalOrStatement}$this->name\0");
    }

    public function shouldWaitForComplete()
    {
        return false;
    }
}
