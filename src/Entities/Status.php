<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Status.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Status
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Util\Date;

class Status extends BaseEntity
{
    /**
     * Status Timestamp
     * @var Util\Date
     */
    protected $TimeStamp = null;
    /**
     * Status code
     * @var String
     */
    protected $StatusCode = null;
    /**
     * Status description
     * @var String
     */
    protected $StatusDescription = null;
    /**
     * Phase code
     * @var String
     */
    protected $PhaseCode = null;
    /**
     * Phase description
     * @var String
     */
    protected $PhaseDescription = null;
    
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
     * Set Status Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setStatusCode($code)
    {
        $this->StatusCode = (string)$code;
        return $this;
    }
    
    /**
     * Get Status Code
     *
     * @access public
     * @return string
     */
    public function getStatusCode()
    {
        return (string)$this->StatusCode;
    }
    
    /**
     * Set Status Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setStatusDescription($description)
    {
        $this->StatusDescription = (string)$description;
        return $this;
    }
    
    /**
     * Get Status Description
     *
     * @access public
     * @return string
     */
    public function getStatusDescription()
    {
        return (string)$this->StatusDescription;
    }
    
    /**
     * Set Phase Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setPhaseCode($code)
    {
        $this->PhaseCode = (string)$code;
        return $this;
    }
    
    /**
     * Get Phase Code
     *
     * @access public
     * @return string
     */
    public function getPhaseCode()
    {
        return (string)$this->PhaseCode;
    }
    
    /**
     * Set Phase Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setPhaseDescription($description)
    {
        $this->PhaseDescription = (string)$description;
        return $this;
    }
    
    /**
     * Get Phase Description
     *
     * @access public
     * @return string
     */
    public function getPhaseDescription()
    {
        return (string)$this->PhaseDescription;
    }
}
