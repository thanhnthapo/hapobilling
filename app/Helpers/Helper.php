<?php
namespace App\Helpers;
class Helper
{
    function createArrayDate($fromDate, $toDate)
    {
        $arrDate = [];
        $fromDate = new DateTime($fromDate);
        $toDate = new DateTime($toDate);
        for ($i = $fromDate; $i <= $toDate; $i->modify('+1 day')) {
            $arrDate[] = $i->format("Y-m-d");
        }
        return $arrDate;
    }
}
?>
