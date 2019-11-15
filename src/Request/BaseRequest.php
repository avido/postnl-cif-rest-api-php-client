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
use Avido\PostNLCifClient\Entities\Message;

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
        'Morning',
        'Evening',
        'Sameday',
        'Daytime'
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

    public function __construct(?string $endpoint = null, ?string $path = null, ?string $version = null)
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
    public function okay(): bool
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
    protected function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * Set Endpoint path
     *
     * @access protected
     * @param string $path
     * @return $this
     */
    protected function setPath(string $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Set Endpoint version
     *
     * @access protected
     * @param string $version
     * @return $this
     */
    protected function setVersion(string $version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get Formatted endpoint (endpoint + version)
     *
     * @access public
     * @return string
     */
    public function getEndpoint(): string
    {
        return "{$this->endpoint}/v{$this->version}/{$this->path}";
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
    public function getCustomer(): Customer
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
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * Get Post Body
     *
     * @access public
     * @return string
     */
    public function getBody(): string
    {
        return !is_null($this->body) ? $this->body : '';
    }
    /**
     * Validate Delivery Option
     *
     * @access protected
     * @param string $option
     * @return boolean
     */
    protected function isValidDeliveryOption(string $option, $type = 'location'): bool
    {
        switch ($type) {
            case 'timeframe':
                $valid = $this->deliveryTimeframeOptions;
                break;
            default:
                $valid = $this->deliveryOptions;
        }
        return (bool)in_array($option, $valid) ? true : false;
    }

    public function getArguments(): array
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
    protected function prepRequestArguments($arguments): array
    {
        $return = [];
        foreach ($arguments as $key => $val) {
            $return[ucfirst($this->camelCase($key))] = $val;
        }
        return $return;
    }

    /**
     * Filter empty key/value from array
     *
     * @accsss protected
     * @param array $array
     * @return array
     */
    protected function filterEmptyArrayValues(array $array): array
    {
        $return = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return[$key] = $this->filterEmptyArrayValues($value);
            } else {
                if ($value != '') {
                    $return[$key] = $value;
                }
            }
        }
        return $return;
//        return array_filter($array);
    }
}
