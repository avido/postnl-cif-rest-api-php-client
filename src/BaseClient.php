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

abstract class BaseClient
{
    const LIBVERSION = "0.1.0"; // Avido PostNL CIF Rest API Lib Version
    /**
     * Namespace for loading entities
     */
    const _NAMESPACE = "Avido\\PostNLCifClient\\Request\\";
    
    /**
     * API Endpoints
     */
    const API_ADDRESS_LIVE = 'https://api.postnl.nl';
    const API_ADDRESS_TEST = 'https://api-sandbox.postnl.nl';

    /**
     * Expected http response code
     * @var int
     */
    private $expectedStatusCode = 200;
    
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
    
    /**
     * Set expected http status code
     *
     * @access public
     * @param int $code
     * @return $this
     */
    public function setExpectedStatusCode($code = 200)
    {
        $this->expectedStatusCode = (int)$code;
        return $this;
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
     * @param boolean $rawReturn (true, skip json decode)
     * @return array
     */
    protected function get($endpoint = '', array $parameters = [], $rawReturn = false)
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        $endpoint = $this->endpoint($endpoint);
        
        if (count($parameters) > 0) {
            $endpoint .= "?" . http_build_query($parameters);
        }
        return $this->makeRequest('GET', $endpoint);
//        return $this->setExpectedStatusCode(200)->makeRequest('GET', $endpoint);
    }

    /**
     * Post request
     * 
     * @access protected
     * @param string $endpoint
     * @param string $xml
     * @return mixed Int($id) | false
     */
    protected function post($endpoint = '', $xml=null)
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        $endpoint = $this->endpoint($endpoint);
        return $this->makeRequest('POST', $endpoint, ['body' => $xml]);
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
    protected function makeRequest($method = 'GET', $endpoint = '', $payload=null)
    {
        if ($endpoint === '') {
            throw new \BadMethodCallException("Missing endpoint");
        }
        try {
            // create stack middleware
            $stack = HandlerStack::create();
            

            /**
             * Middleware currently hijacks response body..
             * mapResponse temp fix to rewind body stream
             * 
             * @see https://github.com/guzzle/guzzle/issues/1582
             */
            
            $mapResponse = Middleware::mapResponse(function(ResponseInterface $response) {
                $response->getBody()->rewind(); 
                return $response; 
            });
            $stack->push($mapResponse);
            
            $stack->push(
                Middleware::log(
                    $this->getLogger(),
                    new MessageFormatter($this->logMessageFormat)
                )
            );
            
            $client = new \GuzzleHttp\Client([
                'handler' => $stack
            ]);
            $payload['headers'] = [
                'User-Agent' => 'Avido/PostNL-Cif-Rest-Api-Client-' . self::LIBVERSION,
                'apikey' => $this->apiKey
            ];
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
            if (!empty($response)) {
                $decode = json_decode($response, true);
                $error = (count($decode) > 0) ? array_shift($decode) : [];
                $errorMessage = isset($error['ErrorMsg']) ? $error['ErrorMsg'] : '';
                $errorNumber = isset($error['ErrorNumber']) ? $error['ErrorNumber'] : 0;
                throw new CifClientException($errorMessage, $errorNumber);
            } else {
                throw $e;
            }
        } catch (ClientException $e) {
            die("E");
            throw $e;
        } catch (\Exception $e) {
            die("C");
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
     * Prepare request object with username, client id & version
     * 
     * @access private
     * @param request object $request
     * @return request object
     */
    private function prepare($request)
    {
        // get data
        $request->setVersion(self::VERSION)
            ->setUsername($this->username)
            ->setClientId($this->client_id);
        return $request;
    }
}
