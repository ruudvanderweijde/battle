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

        $msg = $this->_name . " receives a hit with a {$weapon['weapon']} and looses {$hit}HP having {$this->_health}HP left\r\n";
       
        flush();
        @ob_flush();
        if ($this->_health<=0) {
            flush();
            $this->_setAlive(false);
        } else {
    	if (!rand(0,20)) {
			if (rand(0,1)) {
				$this->_health *= 2;
				$msg = $this->_name . " finds a senzu bean, doubling his/her health to {$this->_health}HP.\r\n";
			} else {
				$this->_health = 100;
				$msg = $this->_name . " finds a senzu bean, and has now {$this->_health}HP again.\r\n";
			}
		}
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
                'weapon' => 'bitchslap in the face',
                'damage' => '5',
            ),
		array(
                'weapon' => 'Gaetan everywhere',
                'damage' => '5',
            ),
            array(
                'weapon' => 'knife in the back',
                'damage' => '10',
            ),
            array(
                'weapon' => 'bullet in the knee',
                'damage' => '10',
            ),
            array(
                'weapon' => 'axe in the arm',
                'damage' => '50',
            ),
            array(
                'weapon' => 'sniper in the head',
                'damage' => '100',
            ),
            array(
                'weapon' => 'kamehameha',
                'damage' => '150',
            ),
        );
        $size = count($weapons)-1;
        return $weapons[rand(0,$size)];
    }
}
