<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: LabelMessage.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Label Message Entity
  @Dependencies:
        Message
 */

use Avido\PostNLCifClient\Entities\Message;

class LabelMessage extends Message
{
    /**
     * Printer type that will be used to process the label, e.g. Zebra printer or PDF See
     * Guidelines for the available printer types.
     * @var string
     */
    private $Printertype;

    public function __construct($message_id = null, $timestamp = null, $printertype = null)
    {
        parent::__construct();
        $this->setMessageId($message_id)
            ->setMessageTimestamp($timestamp)
            ->setPrinterType($printertype);
    }

    /**
     * Set Printer Type
     *
     * @access public
     * @param string $printertype
     * @return $this
     */
    public function setPrinterType(string $printertype): LabelMessage
    {
        $this->Printertype = $printertype;
        return $this;
    }

    /**
     * Get Printer type
     *
     * @access public
     * @return string
     */
    public function getPrinterType(): string
    {
        return $this->Printertype ?? '';
    }

    /**
     * Output LabelMessage Entity as array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
    {
        $arr = parent::toArray();
        $arr['Printertype'] = $this->getPrinterType();
        return $arr;
    }
}
