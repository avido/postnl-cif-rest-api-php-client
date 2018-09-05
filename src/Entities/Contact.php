<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Contact.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Shipment Contact Entity
  @Dependencies:
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;

class Contact extends BaseModel
{
    /**
     * Type of the contact. This is a code. You can find the possible values at Guidelines
     * Possible values: 01 (receiver) 
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var String
     */
    private $ContactType = null;
    /**
     * Email address of the contact. Mandatory in some cases. Please see Guidelines
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var String
     */
    private $Email = null;
    /**
     * Mobile phone number of the contact. Mandatory in some cases
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var String
     */
    private $SMSNr = null;
    /**
     * Phone number of the contact
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var String
     */
    private $TelNr = null;
    
    public function __construct($type=null, $email=null, $sms=null, $tel=null)
    {
        parent::__construct();
        $this->setContactType($type)
            ->setEmail($email)
            ->setSmsNumber($sms)
            ->setPhonenumber($tel);
    }
    
    /**
     * Set Contact Type
     *
     * @access public
     * @param string $type
     * @return $this
     */
    public function setContactType($type='01')
    {
        $this->ContactType = (string)$type;
        return $this;
    }
    
    /**
     * Set Email
     *
     * @access public
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->Email = (string)$email;
        return $this;
    }
    
    /**
     * Set Sms number
     *
     * @access public
     * @param string $number
     * @return $this
     */
    public function setSmsNumber($number)
    {
        $this->SMSNr = (string)$number;
        return $this;
    }
    
    /**
     * Set Phonenumber
     *
     * @access public
     * @param string $number
     * @return $this
     */
    public function setPhonenumber($number)
    {
        $this->TelNr = (string)$number;
        return $this;
    }
    
    /**
     * Get Contact Type
     *
     * @access public
     * @return string
     */
    public function getContactType()
    {
        return (string)$this->ContactType;
    }
    
    /**
     * Get Email
     *
     * @access public
     * @return string
     */
    public function getEmail()
    {
        return (string)$this->Email;
    }
    
    /**
     * Get Sms number
     *
     * @access public
     * @return string
     */
    public function getSmsNumber()
    {
        return (string)$this->SMSNr;
    }
    
    /**
     * Get Phonenumber
     *
     * @access public
     * @return string
     */
    public function getPhonenumber()
    {
        return (string)$this->TelNr;
    }
}
