<?php


namespace App\Entity\RV;

/**
 * @author Damian Wróblewski
 */
trait TimelogBreakdownTrait
{
    /**
     * @return array
     */
    public function getTimelogsBreakDown()
    {
        $data = [];
        $allCodes = Timelog::getAvailableCodes();
        foreach ($allCodes as $code => $info) {
            $data[$code] = [
                'label' => $code . '. ' . $info['label'],
                'value' => 0
            ];
        }
        foreach ($this->getTimelogs() as $timelog) {
            $timeCode = $timelog->getBaseTimeCodeNo();
            if (!isset($data[$timeCode])) {
                continue;
            }
            $data[$timeCode]['value'] += $timelog->getElapsedTime();
        }
        return $data;
    }

    /**
     * @return array|float[]
     */
    public function getBinTimeSummary()
    {
        $summary = [];
        foreach ($this->getTimelogs() as $timelog) {
            if (!isset($summary[$timelog->getBinTime()])) {
                $summary[$timelog->getBinTime()] = 0;
            }
            $summary[$timelog->getBinTime()] += $timelog->getElapsedTime();
        }
        uksort($summary, function ($a, $b) {
            if ($a == 'FFT' && $b != 'FFT') {
                return 1;
            } elseif ($a != 'FFT' && $b == 'FFT') {
                return -1;
            }
            $aType = substr($a, 0, 2);
            $bType = substr($b, 0, 2);

            $aNum = substr($a, 2, 1);
            $bNum = substr($b, 2, 1);
            if ($aNum == $bNum) {
                if ($aType == 'FT' && $bType == 'PT') {
                    return -1;
                } elseif ($aType == 'PT' && $bType == 'FT') {
                    return 1;
                }
            }

            return $aNum - $bNum;
        });
        return $summary;
    }

    /**
     * @return Timelog[]
     */
    abstract public function getTimelogs();
}
