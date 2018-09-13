<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Event.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Event
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Util\Date;

class Event extends BaseEntity
{
    /**
     * Status Timestamp
     * @var Util\Date
     */
    protected $TimeStamp = null;
    /**
     * Code
     * @var String
     */
    protected $Code = null;
    /**
     * Description
     * @var String
     */
    protected $Description = null;
    /**
     * Location code
     * @var String
     */
    protected $LocationCode = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
        // update timestamp if set.
        if (isset($data['TimeStamp'])) {
            $this->setTimeStamp($data['TimeStamp']);
        }
    }
    
    /**
     * Set Timestamp
     *
     * @access public
     * @param String
     * @return $this
     */
    public function setTimeStamp($timestamp)
    {
        if (!$timestamp instanceof Date) {
            $timestamp = new Date($timestamp);
        }
        $this->TimeStamp = $timestamp;
        return $this;
    }
    
    /**
     * Get Timestamp
     *
     * @access public
     * @return String format: Y-m-d H:i:s
     */
    public function getTimestamp()
    {
        return (string)$this->TimeStamp->format("Y-m-d H:i:s");
    }
    
    /**
     * Set Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->Code = (string)$code;
        return $this;
    }
    
    /**
     * Get Code
     *
     * @access public
     * @return string
     */
    public function getCode()
    {
        return (string)$this->Code;
    }
    
    /**
     * Set Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = (string)$description;
        return $this;
    }
    
    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return (string)$this->Description;
    }
    
    /**
     * Set Location Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setLocationCode($code)
    {
        $this->LocationCode = (string)$code;
        return $this;
    }
    
    /**
     * Get Location Code
     *
     * @access public
     * @return string
     */
    public function getLocationCode()
    {
        return (string)$this->LocationCode;
    }
}
