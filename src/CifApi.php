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
use Monolog\Logger;
use Monolog\Handler\NullHandler;

class CifApi
{
    /**
     * Logger channel
     * @var constant
     */
    const LOGGER_CHANNEL = "PostNLApiClient";

    /**
     * PostNL API Key
     * @see https://apimanager.developer.postnl.nl/
     * @var string
     */
    private $apiKey = null;

    /**
     * Customer number as known at PostNL Pakketten
     * @var string
     */
    private $customerNumber = null;

    /**
     * Customer code as known at PostNL Pakketten
     * @var string
     */
    private $customerCode = null;

    /**
     * Code of delivery location at PostNL Pakketten
     * @var string
     */
    private $collectionLocation = null;

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
     * Available API's
     * @var array (format: [clientkey => instance]
     */
    private $apiClients = [];

    /**
     * Construct PostNL CIF Rest API Client
     *
     * @param string $apiKey
     * @param string $customerNumber
     * @param string $customerCode
     * @param string $collectionLocation
     * @param boolean $test/sandbox
     * @param mixed Monolog\Handler|null $logger
     */
    public function __construct(
        string $apiKey,
        string $customerNumber = null,
        string $customerCode = null,
        string $collectionLocation = null,
        bool $sandbox = false,
        ?\Monolog\Handler\AbstractHandler $logger = null
    ) {
        $this->setApiKey($apiKey)
            ->setCustomerNumber($customerNumber)
            ->setCustomerCode($customerCode)
            ->setCollectionLocation($collectionLocation)
            ->setTestMode($sandbox);
        if (!is_null($logger)) {
            $this->setLogger($logger);
        }

        date_default_timezone_set('europe/amsterdam');

        // add default clients.
        $this->addAPI('location', 'Api\\LocationApi')
            ->addAPI('timeframe', 'Api\\TimeframeApi')
            ->addAPI('deliverydate', 'Api\\DeliverydateApi')
            ->addAPI('barcode', 'Api\\BarcodeApi')
            ->addAPI('labelling', 'Api\\LabellingApi')
            ->addAPI('confirming', 'Api\\ConfirmingApi')
            ->addAPI('shippingstatus', 'Api\\ShippingStatusApi');
    }

    /**
     * Add PostNL Webservices API
     *
     * @see https://developer.postnl.nl/browse-apis/
     * @access private
     * @param string $name
     * @param string $instance
     * @return $this
     */
    private function addAPI(string $name, string $instance)
    {
        $client = "Avido\\PostNLCifClient\\{$instance}";
        $this->apiClients[$name] = new $client($this->apiKey,
            $this->customerNumber,
            $this->customerCode,
            $this->collectionLocation,
            $this->testMode,
            $this->getLogger()
        );
        return $this;
    }

    /**
     * Get PostNL Webservices API Instance
     *
     * @access public
     * @param string  $name
     * @return API instance
     * @throws \Exception
     */
    public function getAPI(string $name)
    {
        if (!isset($this->apiClients[$name])) {
            throw new \Exception("No API client found with name '{$name}'");
        }
        return $this->apiClients[$name];
    }

    /**
     * Set API Key
     *
     * @access public
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey(string $apiKey): CifApi
    {
        $this->apiKey = $apiKey;
        return $this;
    }


    /**
     * Set Customer Number
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber(string $customer_number): CifApi
    {
        $this->customerNumber = $customer_number;
        return $this;
    }

    /**
     * Set Customer Code
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode(string $customer_code): CifApi
    {
        $this->customerCode = $customer_code;
        return $this;
    }

    /**
     * Set Collection Location
     *
     * @access public
     * @param string $collection_location
     * @return $this
     */
    public function setCollectionLocation(string $collection_location): CifApi
    {
        $this->collectionLocation = $collection_location;
        return $this;
    }

    /**
     * Enable or disable testmode (default disabled)
     *
     * @access public
     * @param boolean $mode
     * @return $this
     */
    public function setTestMode(bool $mode): CifApi
    {
        $this->testMode = $mode;
        return $this;
    }


    /**
     * Set logger
     *
     * @access public
     * @param Monolog\Handler $handler
     * @return $this
     */
    public function setLogger(\Monolog\Handler\AbstractHandler $handler): CifApi
    {
        $this->logger = new Logger(self::LOGGER_CHANNEL); //initialize the logger
        $this->logger->pushHandler($handler);

        return $this;
    }

    /**
     * Get Logger
     *
     * @access public
     * @return Monolog\Logger
     */
    public function getLogger(): Logger
    {
        if (is_null($this->logger)) {
            // return dummy
            $this->logger = new Logger(self::LOGGER_CHANNEL);
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
    public function hasLogger(): bool
    {
        return (bool)!is_null($this->logger) ? true : false;
    }
}
