<?PHP
class Person {
    private $_name;
    private $_alive     = true;
    private $_health    = 100;

    function __construct($name)
    {
        $this->_name = $name;
    }

    public function isAlive()
    {
        return $this->_alive;
    }

    private function _setAlive($isAlive)
    {
        $this->_alive = $isAlive;
    }

    public function receiveHit()
    {
        $weapon = $this->_getWeapon();

        $hit = rand(0,$weapon['damage']);
        $this->_health -= $hit;

        $msg = $this->_name . " receives a hit with a {$weapon['weapon']} and looses {$hit}HP having {$this->_health}HP left<br>";
        flush();
        @ob_flush();
        if ($this->_health<=0) {
            flush();
            $this->_setAlive(false);
        }
        return $msg;
    }

    public function getName()
    {
        return $this->_name;
    }
    private function _getWeapon()
    {
        static $weapons = array(
            array(
                'weapon' => 'knife',
                'damage' => '10',
            ),
            array(
                'weapon' => 'axe',
                'damage' => '50',
            ),
            array(
                'weapon' => 'sniper',
                'damage' => '100',
            ),
            array(
                'weapon' => 'kamehameha',
                'damage' => '500',
            ),
        );
        $size = count($weapons)-1;
        return $weapons[rand(0,$size)];
    }
}
