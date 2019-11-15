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
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Contact extends BaseEntity
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

    public function __construct($type = null, $email = null, $sms = null, $tel = null)
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
    public function setContactType(string $type = '01'): Contact
    {
        $this->ContactType = $type;
        return $this;
    }

    /**
     * Get Contact Type
     *
     * @access public
     * @return string
     */
    public function getContactType(): string
    {
        return $this->ContactType ?? '';
    }

    /**
     * Set Email
     *
     * @access public
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): Contact
    {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get Email
     *
     * @access public
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email ?? '';
    }


    /**
     * Set Sms number
     *
     * @access public
     * @param string $number
     * @return $this
     */
    public function setSmsNumber(string $number): Contact
    {
        $this->SMSNr = $number;
        return $this;
    }

    /**
     * Get Sms number
     *
     * @access public
     * @return string
     */
    public function getSmsNumber(): string
    {
        return $this->SMSNr ?? '';
    }

    /**
     * Set Phonenumber
     *
     * @access public
     * @param string $number
     * @return $this
     */
    public function setPhonenumber(string $number): Contact
    {
        $this->TelNr = $number;
        return $this;
    }

    /**
     * Get Phonenumber
     *
     * @access public
     * @return string
     */
    public function getPhonenumber(): string
    {
        return $this->TelNr ?? '';
    }

    /**
     * Output contact entity as array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ContactType' => $this->getContactType(),
            'Email' => $this->getEmail(),
            'SMSNr' => $this->getSmsNumber(),
            'TelNr' => $this->getPhonenumber()
        ];
    }
}
