<?php
namespace Avido\PostNLCifClient\Request;
/**
    @File: BaseRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido
*/

use Avido\PostNLCifClient\BaseModel;

class BaseRequest extends BaseModel
{
    /**
     * Endpoint
     * @var string
     */
    private $endpoint = null;
    
    /**
     *Endpoint path
     * @var string 
     */
    private $path = null;
    
    /**
     * Version
     * @var string
     */
    private $version = null;
  
    /**
     * Valid Delivery Options
     * @var array
     */
    private $deliveryOptions = [
        'PG',           // Pick up at PostNL location (in Dutch: Ophalen bij  PostNL Locatie) 
        'PGE',          // Pick up at PostNL location Express (in Dutch: Extra Vroeg Ophalen)
        'KEL'           // Customer own location (in Dutch: Klant Eigen Locatie)
    ];
    
    public function __construct($endpoint=null, $path = null, $version=null)
    {
        if (!is_null($endpoint)) {
            $this->setEndpoint($endpoint);
        }
        if (!is_null($path)) {
            $this->setPath($path);
        }
        if (!is_null($version)) {
            $this->setVersion($version);
        }
    }
    
    /**
     * Set endpoint
     * 
     * @access protected
     * @param string $endpoint
     * @return $this
     */
    protected function setEndpoint($endpoint)
    {
        $this->endpoint = (string)$endpoint;
        return $this;
    }
    
    /**
     * Set Endpoint path
     * 
     * @access protected
     * @param string $path
     * @return $this
     */
    protected function setPath($path)
    {
        $this->path = (string)$path;
        return $this;
    }
    
    /**
     * Set Endpoint version
     * 
     * @access protected
     * @param string $version
     * @return $this
     */
    protected function setVersion($version)
    {
        $this->version = (string)$version;
        return $this;
    }
    
    /**
     * Get Formatted endpoint (endpoint + version)
     * 
     * @access public
     * @return string
     */
    public function getEndpoint()
    {
        return (string)"{$this->endpoint}/v{$this->version}/{$this->path}";
    }
    
    /**
     * Validate Delivery Option
     * 
     * @access protected
     * @param string $option
     * @return boolean
     */
    protected function isValidDeliveryOption($option)
    {
        return (bool)in_array(strtoupper($option, $this->deliveryOptions)) ? true : false;
    }
}