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

use Avido\PostNLCifClient\Entities\Customer;

abstract class BaseClient
{
    /**
     * Avido PostNL CIF Rest API Lib Version
     * @var constant 
     */
    const LIBVERSION = "0.1.0"; 
    
    
    /**
     * Logger channel
     * @var constant 
     */
    const LOGGER_CHANNEL = "PostNLApiClient";
    
    
    /**
     * API Endpoints
     */
    const API_ADDRESS_LIVE = 'https://api.postnl.nl';
    const API_ADDRESS_TEST = 'https://api-sandbox.postnl.nl';

    
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
     *Log message format
     * @var string
     */
    private $logMessageFormat = "[{method}] - {uri} *|* {\n} <<REQUEST>> {req_body} *|* <<RESPONSE>> {res_body}";
    
    /**
     * Construct PostNL CIF Rest API Client
     *
     * @param string $apiKey
     * @param string $customerNumber
     * @param string $customerCode 
     * @param string $collectionLocation
     * @param boolean $sandbox
     * @param mixed Monolog\Handler|null $logger
     */
    public function __construct(
        $apiKey, 
        $customerNumber = null, 
        $customerCode = null, 
        $collectionLocation = null, 
        $sandbox = false, 
        $logger = null)
    {
        $this->setApiKey($apiKey)
            ->setCustomerNumber($customerNumber)
            ->setCustomerCode($customerCode)
            ->setCollectionLocation($collectionLocation)
            ->setTestMode($sandbox);
        $this->setLogger($logger);
        
        date_default_timezone_set('europe/amsterdam');
    }
    
    /**
     * Set API Key
     *
     * @access public
     * @param string $apiKey
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
     * Set Customer Number
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->customerNumber = (string)$customer_number;
        return $this;
    }
    
    /**
     * Get Customer Number
     *
     * @access public
     * @return string
     */
    public function getCustomerNumber()
    {
        return (string)$this->customerNumber;
    }
    
    /**
     * Set Customer Code
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode($customer_code)
    {
        $this->customerCode = (string)$customer_code;
        return $this;
    }
    
    /**
     * Get Customer Code
     *
     * @access public
     * @return string
     */
    public function getCustomerCode()
    {
        return (string)$this->customerCode;
    }
    
    /**
     * Set Collection Location
     *
     * @access public
     * @param string $collection_location
     * @return $this
     */
    public function setCollectionLocation($collection_location)
    {
        $this->collectionLocation = (string)$collection_location;
        return $this;
    }
    
    /**
     * Get Collection Location
     *
     * @access public
     * @return string
     */
    public function getCollectionLocation()
    {
        return (string)$this->collectionLocation;
    }
    
   /**
     * Set logger
     *
     * @access public
     * @param Monolog\Handler $handler
     * @return $this
     */
    public function setLogger($logger = null)
    {
        if (!is_null($logger)) {
            $this->logger = $logger;
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
    public function hasLogger()
    {
        return (bool)!is_null($this->logger) ? true : false;
    }
    

    /**
     * Internal API Calls
     */
    
    /**
     * Get request
     *
     * @access protected
     * @param string $endpoint
     * @param array $parameters
     * @return array
     */
    protected function get($endpoint = '', array $parameters = [])
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        $requestEndpoint = $this->endpoint($endpoint);
        
        if (count($parameters) > 0) {
            $requestEndpoint .= "?" . http_build_query($parameters);
        }
        return $this->makeRequest('GET', $requestEndpoint);
    }

    /**
     * Post request
     *
     * @access protected
     * @param string $endpoint
     * @param string $body
     * @return mixed Int($id) | false
     */
    protected function post($endpoint = '', $body = null)
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        return $this->makeRequest('POST', $this->endpoint($endpoint), ['body' => $body, 'headers' => ['Content-type' => 'application/json']]);
    }

    /**
     * Make http request
     *
     * @access protected
     * @param string $method - GET,POST,PUT,DELETE
     * @param string $endpoint
     * @param string $payload
     * @return mixed
     * @throws BadMethodCallException
     * @throws ClientException
     * @throws RequestException
     * @throws Exception
     */
    protected function makeRequest($method = 'GET', $endpoint = '', $payload = null)
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        try {
            // create stack middleware
            $stack = HandlerStack::create();
            
            $tapMiddleware = Middleware::tap(function ($request) {
                echo "content type: " . $request->getHeaderLine('Content-Type') . PHP_EOL;
                echo "Request Body: " . PHP_EOL;
                // application/json
                echo $request->getBody();
                // {"foo":"bar"}
            });            
//        $stack->push($tapMiddleware);
            /**
             * Middleware currently hijacks response body..
             * mapResponse temp fix to rewind body stream
             *
             * @see https://github.com/guzzle/guzzle/issues/1582
             */
            
            $mapResponse = Middleware::mapResponse(function (ResponseInterface $response) {
                $response->getBody()->rewind();
                return $response;
            });
            $stack->push($mapResponse);
            
//            $stack->push(
//                Middleware::log(
//                    $this->getLogger(),
//                    new MessageFormatter($this->logMessageFormat)
//                )
//            );
            
            $client = new \GuzzleHttp\Client([
                'handler' => $stack
            ]);
            $payload['headers'] = array_merge($this->getHttpHeaders(), (isset($payload['headers']) ? $payload['headers'] : []));
            $headers = [
                'User-Agent' => 'Avido/PostNL-Cif-Rest-Api-Client-' . self::LIBVERSION,
                'apikey' => $this->apiKey
            ];
//            $payload['debug'] = true;
            $res = $client->request($method, $endpoint, $payload);
               
            $json = $res->getBody()->getContents();
            if ($json) {
                $response = json_decode($json, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // throw new json decode error
                }
                // check for errors.
                return $response;
            } else {
                // throw no response error
            }
        } catch (RequestException $e) {
            // get response body
            $response = $e->getResponse()->getBody()->getContents();
            // PostNL doesn't seem to make up their mind about the error format.
            // therefore set the json as exception response. So each API can handle the error format
            throw new CifClientException($response);
        } catch (ClientException $e) {
            // log the request ?
//            // get the body
//            $body = $e->getRequest()->getBody();
//            // rewind pointer
//            $body->rewind();
//            print_r($body->getContents());
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Format endpoint
     *
     * @access private
     * @param string $endpoint
     * @return string
     */
    private function endpoint($endpoint)
    {
        if (substr($endpoint, 0, 1) !== '/') {
            $endpoint = "/{$endpoint}";
        }
        return (($this->testMode) ? self::API_ADDRESS_TEST : self::API_ADDRESS_LIVE) . $endpoint;
    }
    
    /**
     * Get Customer Entity
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Customer
     */
    public function getCustomer()
    {
        return Customer::create()
            ->setCustomerCode($this->customerCode)
            ->setCustomerNumber($this->customerNumber)
            ->setCollectionLocation($this->collectionLocation);
    }
    
    /**
     * Get Default http headers for http connection to PostNL
     *
     * @access private
     * @return array
     */
    private function getHttpHeaders()
    {
        return [
            'User-Agent' => 'Avido/PostNL-Cif-Rest-Api-Client-' . self::LIBVERSION,
            'apikey' => $this->apiKey
        ];
    }
}
