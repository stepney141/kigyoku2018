<?php

include_once 'dbmap.php';

class TicketMapper extends DataMapper
{
    public function __construct($dbconn)
    {
        parent::__construct($dbconn);
    }

    public function acquireTicketsAll()
    {
        $sth = $this->dbconn->query("SELECT * FROM tickets;");

        while (($row = $sth->fetch()) !== false)
        {
            yield $row;
        }
    }
}


$ticket = new TicketMapper(GyokuwebDB::Instance());

$g = $ticket->acquireTicketsAll();

$tickets = [
    "tickets" => iterator_to_array($g)
];

$jsonstr = json_encode($tickets, JSON_UNESCAPED_UNICODE);

echo($jsonstr);