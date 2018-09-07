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
use Avido\PostNLCifClient\Entities\Customer;
use Avido\PostNLCifClient\Entities\message;

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
     * Request arguments
     * @var array
     */
    protected $arguments = [];
    
    /**
     * Post Body
     * @var string
     */
    protected $body = null;
    
    /**
     *Message Entity
     * @var Avido\PostNLCifClient\Entities\Message
     */
    protected $message = null;
    /**
     *Customer Entity
     * @var Avido\PostNLCifClient\Entities\Customer
     */
    protected $customer = null;
    
    /**
     * Valid Delivery Options
     * @var array
     */
    private $deliveryOptions = [
        'PG',           // Pick up at PostNL location (in Dutch: Ophalen bij  PostNL Locatie)
        'PGE',          // Pick up at PostNL location Express (in Dutch: Extra Vroeg Ophalen)
        'KEL'           // Customer own location (in Dutch: Klant Eigen Locatie)
    ];
    
    private $deliveryTimeframeOptions = [
        'morning',
        'evening',
        'sameday',
        'daytime'
    ];
    
    private $deliveryDeliveryDateOptions = [
        'daytime',
        'evening',
        'morning',
        'noon',
        'sunday',
        'sameday',
        'afternoon',
        'mytime',
        'pickup'
    ];
    
    public function __construct($endpoint = null, $path = null, $version = null)
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
     * Indicates request is filled completely.
     *
     * @access public
     * @return boolean (default true)
     */
    public function okay()
    {
        return true;
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
     * Set Customer Entity
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Customer $customer
     * @return $this
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }
    
    /**
     * Get Customer Entity
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    
    /**
     * Set Message Entity
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Message $message
     * @return $this
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
        return $this;
    }
    
    /**
     * Get Message Entity
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Get Post Body
     *
     * @access public
     * @return string
     */
    public function getBody()
    {
        return (string)$this->body;
    }
    /**
     * Validate Delivery Option
     *
     * @access protected
     * @param string $option
     * @return boolean
     */
    protected function isValidDeliveryOption($option, $type = 'location')
    {
        switch ($type) {
            case 'timeframe':
                $valid = $this->deliveryTimeframeOptions;
                break;
            default:
                $valid = $this->deliveryOptions;
        }
        return (bool)in_array(strtoupper($option), $valid) ? true : false;
    }
    
    public function getArguments()
    {
        // reformat delivery options
        $arguments = $this->arguments;
        $arguments['delivery_options'] = $this->getDeliveryOptions();
        $arguments = $this->prepRequestArguments($arguments);
        return (array)$arguments;
    }
    
    /**
     * Camelcase and ucfirst argument keys
     *
     * @access protected
     * @param array $arguments
     * @return array
     */
    protected function prepRequestArguments($arguments)
    {
        $return = [];
        foreach ($arguments as $key => $val) {
            $return[ucfirst($this->camelCase($key))] = $val;
        }
        return $return;
    }
}
