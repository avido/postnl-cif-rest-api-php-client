<?php
namespace Avido\PostNLCifClient\Util;
/**
  @File: Date.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Date model
 
  @Dependencies:
        DateTime
        DateInterval
 */
use \DateTime;
use \DateInterval;

class Date extends DateTime
{
    const _DEFAULT_LOCALE = "nl_NL";
    const DEFAULT_FORMAT = "d-m-Y";
    
    /**
     * Current config offset in seconds
     *
     * @var int
     */
    private $_offset = 0;

    /**
     * Current system offset in seconds
     *
     * @var int
     */
    private $_systemOffset = 0;

    /**
     * Init offset
     *
     */
    public function __construct($time=null, $object=null)
    {
        $this->_offset = $this->calculateOffset($this->_getConfigTimezone());
        $this->_systemOffset = $this->calculateOffset();
        parent::__construct($time, $object);
    }

    /**
     * Get timezone
     *
     * @return string
     */
    protected function _getConfigTimezone()
    {
        return 'Europe/Amsterdam';
    }

    /**
     * Calculates timezone offset
     *
     * @param  string $timezone
     * @return int offset between timezone and gmt
     */
    public function calculateOffset($timezone = null)
    {
        $result = true;
        $offset = 0;

        if (!is_null($timezone)){
            $oldzone = @date_default_timezone_get();
            $result = date_default_timezone_set($timezone);
        }

        if ($result === true) {
            $offset = (int)date('Z');
        }

        if (!is_null($timezone)){
            date_default_timezone_set($oldzone);
        }

        return $offset;
    }
    
    /**
     * Subtract day(s)
     * 
     * @param int $days
     * @return Date
     */
    public function subtract($days)
    {
        $int = new DateInterval("P{$days}D");
        return $this->sub($int);
    }
    
    /**
     * Add day(s)
     * 
     * @param int $days
     * @return Date
     */
    public function add($days)
    {
        $days = (int)$days;
        $int = new DateInterval("P{$days}D");
        return parent::add($int);
    }

    /*****************************
     * HELPERS
     *****************************/
    /**
     * Return difference between $this and $now
     *
     * @param Datetime|String $now
     * @return DateInterval
     */
    public function diff($now='',$absolute=null) 
    {
        if(!($now instanceOf DateTime)) {
            $now = new DateTime($now);
        }
        return parent::diff($now);
    }

    /**
     * Check if date is today
     * 
     * @access public
     * @return boolean
     */
    public function isToday()
    {
        return (bool)(!$this->isPast() && !$this->isFuture()) ? true : false;
    }
    
    /**
     * Check if date is tomorrow
     * 
     * @access public
     * @return boolean
     */
    public function isTomorrow()
    {
        $tomorrow = new self();
        $tomorrow->add(new DateInterval('P1D'));
        return (bool)($this->format('dmY') == $tomorrow->format('dmY')) ? true : false;
    }
    
    /**
     * Check if date is in the past
     * 
     * @access public
     * @return boolean
     */
    public function isPast()
    {
        $now = new self();
        return (bool)($now > $this) ? true : false;
    }
    
    /**
     * Check if date is in the future
     * 
     * @access public
     * @return boolean
     */
    public function isFuture()
    {
        $now = new self();
        return (bool)($now < $this) ? true : false;
    }
    
    /**
     * Check if current date(scope) is after $date
     * 
     * @access public
     * @param Date $date
     * @return boolean
     */
    public function isAfter(Date $date) 
    {
        return ($this > $date) ? true : false;
    }
    
    public function __toString()
    {
        return $this->format(self::DEFAULT_FORMAT);
    }  
}
