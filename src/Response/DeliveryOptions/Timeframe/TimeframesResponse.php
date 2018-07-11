<?php
namespace Avido\PostNLCifClient\Response\DeliveryOptions\Timeframe;

/**
  @File: TimeframesResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Available timeframes response
  @Dependencies:
 */
use Avido\PostNLCifClient\Entities\Timeframe;
use Avido\PostNLCifClient\Entities\NoTimeframe;

class TimeframesResponse
{
    private $timeframes = [];
    private $noTimeframes = [];
    /**
     * Data can contain 2 keys:
     *      - ReasonNoTimeframes
     *      - Timeframes
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (isset($data['ReasonNoTimeframes']) &&
            isset($data['ReasonNoTimeframes']['ReasonNoTimeframe']) &&
            is_array($data['ReasonNoTimeframes']['ReasonNoTimeframe'])
        ) {
            // single value ? or multiple
            if (isset($data['ReasonNoTimeframes']['ReasonNoTimeframe'][0])) {
                // multiple
                foreach ($data['ReasonNoTimeframes']['ReasonNoTimeframe'] as $item) {
                    $this->addNoTimeframe(new NoTimeframe($item));
                }
            } else {
                $this->addNoTimeframe(new NoTimeframe($data['ReasonNoTimeframes']['ReasonNoTimeframe']));
            }
        }
        if (isset($data['Timeframes']) &&
            isset($data['Timeframes']['Timeframe']) &&
            is_array($data['Timeframes']['Timeframe'])
        ) {
            foreach ($data['Timeframes']['Timeframe'] as $item) {
                $timeframe = new Timeframe($item);
                $this->add($timeframe);
            }
        }
    }

    /**
     * Add timeframe object to collection
     *
     * @access public
     * @param Timeframe $timeframe
     * @return $this
     */
    public function add(Timeframe $timeframe)
    {
        $this->timeframes[] = $timeframe;
        return $this;
    }
    
    /**
     * Add no timeframe (reason)
     *
     * @access public
     * @param NoTimeframe $timeframe
     * @return $this
     */
    public function addNoTimeframe(NoTimeframe $timeframe)
    {
        $this->noTimeframes[] = $timeframe;
        return $this;
    }
    
    /**
     * Get timeframes collection
     *
     * @access public
     * @return array
     */
    public function getTimeframes()
    {
        return $this->timeframes;
    }
    
    /**
     * Get No timeframes collection
     *
     * @access public
     * @return array
     */
    public function getNoTimeframes()
    {
        return $this->noTimeframes;
    }
    
    public function asArray()
    {
        $return = [
            'timeframes' => [],
            'no_timeframes' => []
        ];
        foreach ($this->getTimeframes() as $timeframe) {
            $return['timeframes'][] = $timeframe->toArray();
        }
        foreach ($this->getNoTimeframes() as $timeframe) {
            $return['no_timeframes'][] = $timeframe->toArray();
        }
        return $return;
    }
}
