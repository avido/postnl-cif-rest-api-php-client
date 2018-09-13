<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Expectation.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Status Expectation
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Util\Date;

class Expectation extends BaseEntity
{
    /**
     * ETAFrom
     * @var Util\Date
     */
    protected $ETAFrom = null;
    /**
     * ETATo
     * @var Util\Date
     */
    protected $ETATo = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
        // update timestamp if set.
        if (isset($data['ETAFrom'])) {
            $this->setETAFrom($data['ETAFrom']);
        }
        if (isset($data['ETATo'])) {
            $this->setETATo($data['ETATo']);
        }
    }
    
    /**
     * Set ETAFrom
     *
     * @access public
     * @param String $timestamp
     * @return $this
     */
    public function setETAFrom($timestamp)
    {
        if (!$timestamp instanceof Date) {
            $timestamp = new Date($timestamp);
        }
        $this->ETAFrom = $timestamp;
        return $this;
    }
    
    /**
     * Get ETAFrom
     *
     * @access public
     * @return String format: Y-m-d H:i:s
     */
    public function getETAFrom()
    {
        return (string)$this->ETAFrom->format("Y-m-d H:i:s");
    }
    
    /**
     * Set ETATo
     *
     * @access public
     * @param String $timestamp
     * @return $this
     */
    public function setETATo($timestamp)
    {
        if (!$timestamp instanceof Date) {
            $timestamp = new Date($timestamp);
        }
        $this->ETATo = $timestamp;
        return $this;
    }
    
    /**
     * Get ETATo
     *
     * @access public
     * @return String format: Y-m-d H:i:s
     */
    public function getETATo()
    {
        return (string)$this->ETATo->format("Y-m-d H:i:s");
    }
}
