
<?php

use DB;

if (!function_exists('getDateOnly')) {

    function getDateOnly($date) {
        if ($date) {
            $dateOnly = \Carbon\Carbon::parse($date)->format('m-d-Y');
            return $dateOnly;
        }
        return "";
    }

}
if (!function_exists('state_name')) {

    function state_name($id) {
        $state = DB::table('states')->where('id', $id)->first();
        return $state->name;
    }

}
?>