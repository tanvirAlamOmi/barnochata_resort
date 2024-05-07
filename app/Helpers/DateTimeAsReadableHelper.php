<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateTimeAsReadableHelper
{
    public function dateTimeAsReadable($timestamp, $format = null)
    {
        if (empty($timestamp)) {
            return '';
        }
        
        if($format){
            return Carbon::parse($timestamp)->format($format);
        }

        return Carbon::parse($timestamp)->format('d M Y h:i A');
    }
}