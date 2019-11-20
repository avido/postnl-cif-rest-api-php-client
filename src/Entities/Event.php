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
    /**
     * Destination location code
     * @var array
     */
    protected $DestinationLocationCode = null;
    /**
     * Route code
     * @var array
     */
    protected $RouteCode = null;
    /**
     * Route name
     * @var array
     */
    protected $RouteName = null;

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
    public function setTimeStamp($timestamp): Event
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
    public function getTimestamp(): string
    {
        return $this->TimeStamp->format("Y-m-d H:i:s");
    }

    /**
     * Set Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): Event
    {
        $this->Code = $code;
        return $this;
    }

    /**
     * Get Code
     *
     * @access public
     * @return string
     */
    public function getCode(): ?string
    {
        return !is_string($this->Code) ? $this->Code : null;
    }

    /**
     * Set Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): Event
    {
        $this->Description = $description;
        return $this;
    }

    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription(): ?string
    {
        return is_string($this->Description) ? $this->Description : null;
    }

    /**
     * Set Location Code
     *
     * @access public
     * @param string $code
     * @return $this
     */
    public function setLocationCode(string $code): Event
    {
        $this->LocationCode = $code;
        return $this;
    }

    /**
     * Get Location Code
     *
     * @access public
     * @return string
     */
    public function getLocationCode(): ?string
    {
        return is_string($this->LocationCode) ? $this->LocationCode : null;
    }
    /**
     * Set Destination Location Code
     *
     * @access public
     * @param string $code
     * @return \Avido\PostNLCifClient\Entities\Event
     */
    public function setDestinationLocationCode(string $code): Event
    {
        $this->DestinationLocationCode = $code;
        return $this;
    }
    /**
     * Get Destination Location Code
     *
     * @access public
     * @return string|null
     */
    public function getDestinationLocationCode(): ?string
    {
        return is_string($this->DestinationLocationCode) ? $this->DestinationLocationCode : null;
    }
    /**
     * Set Route Code
     *
     * @access public
     * @param string $code
     * @return \Avido\PostNLCifClient\Entities\Event
     */
    public function setRouteCode(string $code): Event
    {
        $this->RouteCode = $code;
        return $this;
    }
    /**
     * Get Route Code
     *
     * @access public
     * @return string|null
     */
    public function getRouteCode(): ?string
    {
        return is_string($this->RouteCode) ? $this->RouteCode : null;
    }
    /**
     * Set Route Name
     *
     * @access public
     * @param string $name
     * @return \Avido\PostNLCifClient\Entities\Event
     */
    public function setRouteName(string $name): Event
    {
        $this->RouteName = $name;
        return $this;
    }
    /**
     * Get Route Name
     *
     * @access public
     * @return string|null
     */
    public function getRouteName(): ?string
    {
        return is_string($this->RouteName) ? $this->RouteName : null;
    }
}
