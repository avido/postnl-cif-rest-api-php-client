<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Timeframe.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Timeframe
  @Dependencies:
 */
use Avido\PostNLCifClient\Entities\BaseEntity;

use Avido\PostNLCifClient\Entities\TimeframeWindow;
use Avido\PostNLCifClient\Util\Date;

class Timeframe extends BaseEntity
{
    /**
     * Date
     * @var string
     */
    protected $Date = null;
    /**
     * Available timeframes
     * @var array
     */
    protected $timeframes = [];

    // date
    // timeframes : collection of timeframewindow entitiy
//                        from
//                        to
//                        delivery_options

    public function __construct($data = [])
    {
        $this->setDate($data['Date']);

        if (isset($data['Timeframes']) &&
            isset($data['Timeframes']['TimeframeTimeFrame']) &&
            is_array($data['Timeframes']['TimeframeTimeFrame'])
        ) {
            if (isset($data['Timeframes']['TimeframeTimeFrame'][0])) {
                foreach ($data['Timeframes']['TimeframeTimeFrame'] as $item) {
                    $timeframeWindow = new TimeframeWindow($item);
                    $this->addWindow($timeframeWindow);
                }
            } else {
                $timeframeWindow = new TimeframeWindow($data['Timeframes']['TimeframeTimeFrame']);
                $this->addWindow($timeframeWindow);
            }
            unset($data['Timeframes']);
        }
    }

    public function setDate($date): Timeframe
    {
        if (!$date instanceof Date) {
            $date = new Date($date);
        }
        $this->Date = $date;
        return $this;
    }

    public function addWindow(TimeframeWindow $timeframeWindow): void
    {
        $this->timeframes[] = $timeframeWindow;
    }

    public function toArray(): array
    {
        $return = [];
        foreach ($this->timeframes as $window) {
            $return[] = $window->toArray();
        }
        return [
            'date' => $this->Date->format("Y-m-d"),
            'timeframes' => $return
        ];
    }
}
