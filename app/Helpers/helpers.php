
<?php



if (!function_exists('getDateOnly')) {

    function getDateOnly($date) {
        if ($date) {
            $dateOnly = \Carbon\Carbon::parse($date)->format('m-d-Y');
            return $dateOnly;
        }
        return "";
    }

}

?>