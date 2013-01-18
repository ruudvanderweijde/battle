<?PHP
header("Content-type: text/html; charset=utf-8");
ob_start();
require('Person.php');

if (!isset($argv[1])||!isset($argv[2])) die("Error: Enter 2 names.");

$p1 = new Person($argv[1]);
$p2 = new Person($argv[2]);

do {
    usleep(500000);
    if (rand(0,1))
        echo $p1->receiveHit();
    else
        echo $p2->receiveHit();
} while($p1->isAlive() && $p2->isAlive());
if ($p1->isAlive())
    echo "{$p1->getName()} won. {$p2->getName()} died. ";
else
    echo "{$p2->getName()} won. {$p1->getName()} died. ";
