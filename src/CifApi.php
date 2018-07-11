<?php
namespace Avido\PostNLCifClient;

/**
    @File:  CifApi.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido

    CIF Api for interacting with the PostNL Webservices
    
    https://developer.postnl.nl/
*/

use Avido\PostNLCifClient\Exceptions\CifClientException;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\MessageFormatter;
use Psr\Http\Message\ResponseInterface;

use Monolog\Logger;
use Monolog\Handler\NullHandler;

class CifApi
{
    const LIBVERSION = "0.1.0"; // Avido PostNL CIF Rest API Lib Version
    
    /**
     * PostNL API Key
     * @see https://apimanager.developer.postnl.nl/
     * @var string
     */
    private $apiKey = null;

    /**
     * Indicates test mode (sandbox)
     * @var bool
     */
    private $testMode = null;
    
    /**
     * Log 
     * @var Monolog\Logger
     */
    private $logger = null;

    /**
     *Log message format
     * @var string
     */
    private $logMessageFormat = "[{method}] - {uri} *|* {\n} <<REQUEST>> {req_body} *|* <<RESPONSE>> {res_body}";
    
    /**
     * Available API's
     * @var array (format: [clientkey => instance]
     */
    private $apiClients = [];
    
    /**
     * Construct PostNL CIF Rest API Client
     * 
     * @param string $apiKey
     * @param boolean $test/sandbox
     * @param mixed Monolog\Handler|null $logger
     */
    public function __construct($apiKey, $sanbox=false, $logger=null)
    {
        $this->setApiKey($apiKey)
            ->setTestMode($sanbox);
        $this->setLogger($logger);
        
        date_default_timezone_set('europe/amsterdam');
        // add default clients.
        $this->addAPI('location', 'Api\\LocationApi')
            ->addAPI('timeframe', 'Api\\TimeframeApi')
            ->addAPI('deliverydate', 'Api\\DeliverydateApi');
    }
    
    private function addAPI($name, $instance)
    {
        $client = "Avido\\PostNLCifClient\\{$instance}";
        $this->apiClients[$name] = new $client($this->apiKey, $this->testMode);
        return $this;
    }
    
    public function getAPI($name)
    {
        if (!isset($this->apiClients[$name])) {
            throw new \Exception("No client found with name '{$name}'");
        }
        return $this->apiClients[$name];
    }
    /**
     * Set API Key
     * 
     * @access public
     * @param string $username
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = (string)$apiKey;
        return $this;
    }

    /**
     * Enable or disable testmode (default disabled)
     * 
     * @access public
     * @param boolean $mode
     * @return $this
     */
    public function setTestMode($mode)
    {
        $this->testMode = (bool)$mode;
        return $this;
    }

    
    /**
     * Set logger
     * 
     * @access public
     * @param Monolog\Handler $handler
     * @return $this
     */
    public function setLogger($handler)
    {
        if (!is_null($handler)) {
            $this->logger = new Logger('BillinkApiClient'); //initialize the logger
            $this->logger->pushHandler($handler);
        }
        
        return $this;
    }
    
    /**
     * Get Logger
     * 
     * @access public
     * @return Monolog\Logger
     */
    public function getLogger()
    {
        if (is_null($this->logger)) {
            // return dummy
            $this->logger = new Logger('BillinkApiClient');
            $this->logger->pushHandler(new NullHandler);
        }
        return $this->logger;
    }
    
    /**
     * Check for defined logger
     * 
     * @access public
     * @return boolean
     */
    public function hasLogger()
    {
        return (bool)!is_null($this->logger) ? true : false;
    }
}
