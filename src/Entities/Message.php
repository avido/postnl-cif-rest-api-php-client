<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Message.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Message Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Util\Date;

class Message extends BaseEntity
{
    /**
     * ID of the message
     * @var string
     */
    private $MessageID = null;
    /**
     * Date/time of sending the message. Format: dd-mm-yyyy hh:mm:ss
     * @var string
     */
    private $MessageTimeStamp = null;
    /**
     * Printer type that will be used to process the label, e.g. Zebra printer or PDF See Guidelines for the available printer types.
     * @var string
     */
    private $Printertype = null;
    
    public function __construct($message_id = null, $timestamp = null)
    {
        parent::__construct();
        $this->setMessageId($message_id)
            ->setMessageTimestamp($timestamp);
    }
    
    /**
     * Set Message ID
     *
     * @access public
     * @param string $message_id
     * @return $this
     */
    public function setMessageId($message_id)
    {
        $this->MessageID = (string)$message_id;
        return $this;
    }
    
    /**
     * Get Message ID
     *
     * @access public
     * @return string
     */
    public function getMessageId()
    {
        return (string)$this->MessageID;
    }
    
    /**
     * Set Message Timestamp
     *
     * @access public
     * @param string $timestamp
     * @return $this
     */
    public function setMessageTimestamp($timestamp)
    {
        $this->MessageTimeStamp = new Date($timestamp);
        return $this;
    }
    
    /**
     * Get Message Timestamp
     *
     * @access public
     * @return Avido\PostNLCifClient\Util\Date;
     */
    public function getMessageTimestamp()
    {
        if (!$this->MessageTimeStamp instanceof Date) {
            $this->MessageTimeStamp = new Date($this->MessageTimeStamp);
        }
        return $this->MessageTimeStamp;
    }
    
    /**
     * Output message entity as array
     *
     * @access public
     * @return array
     */
    public function toArray()
    {
        return [
            'MessageID' => $this->getMessageId(),
            'MessageTimeStamp' => $this->getMessageTimestamp()->format('d-m-Y H:i:s')
        ];
    }
}