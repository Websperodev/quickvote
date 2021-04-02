
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
if (!function_exists('subcategory_name)')) {

    function subcategory_name($subId) {
        $subCat = DB::table('categories')->where('id', $subId)->first();
        return $subCat->name;
    }

}
if (!function_exists('state_name)')) {

    function state_name($id) {
        $subCat = DB::table('states')->where('id', $id)->first();
        return $subCat->name;
    }

}
if (!function_exists('getcountries)')) {

    function getcountries() {
        $countries = DB::table('countries')->get();
        return $countries;
    }

}
if (!function_exists('contestant_name)')) {

    function contestant_name($id) {
        $contestants = DB::table('contestants')->first();
        return $contestants->name;
    }

}
if (!function_exists('votingTitle)')) {

    function votingTitle($id) {
        $voting = DB::table('voting_contests')->first();
        return $voting->title;
    }

}
if (!function_exists('eventsName)')) {

    function eventsName($id) {
        $event = DB::table('events')->first();
        return $event->name;
    }

}

if (!function_exists('ticketName)')) {

    function ticketName($id) {
        $ticket = DB::table('tickets')->first();
        return $ticket->name;
    }

}
if (!function_exists('ticketNumber)')) {

    function ticketNumber($id) {
        $ticket = DB::table('tickets')->first();
        return $ticket->ticket_number;
    }

}
if (!function_exists('votingName)')) {

    function votingName($id) {
        $voting = DB::table('voting_contests')->first();
        return $voting->title;
    }

}
?>