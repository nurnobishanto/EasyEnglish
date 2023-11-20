<?php
// app/helpers.php

use App\Models\Menu;
use App\Models\Setting;
if (!function_exists('menu')) {
    function menu($slug, $type = null, array $options = [])
    {
        return (new App\Models\Menu)->display($slug, $type, $options);
    }
}

if (!function_exists('getPostOffices')) {
    function getPostOffices($upazila)
    {
        $jsonFile = public_path('json/bd-postcodes.json');
        $data = [];
        $data['other'] = 'Other';
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $postOffices = json_decode($jsonContents, true);
            foreach ($postOffices as $postOffice) {
                if ($postOffice['upazila'] == $upazila) {
                    $data[$postOffice['postOffice']] = $postOffice['postOffice'] ;
                }
            }
        }
        return $data;
    }
}
if (!function_exists('getPostCodes')) {
    function getPostCodes($upazila)
    {
        $jsonFile = public_path('json/bd-postcodes.json');
        $data = [];
        $data['xxxx'] = 'XXXX';
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $postOffices = json_decode($jsonContents, true);
            foreach ($postOffices as $postOffice) {
                if ($postOffice['upazila'] == $upazila) {
                    $data[$postOffice['postCode']] = $postOffice['postCode'] ;
                }
            }
        }
        return $data;
    }
}
if (!function_exists('getUpazila')) {
    function getUpazila($districtId)
    {
        $jsonFile = public_path('json/bd-upazilas.json');
        $data = [];
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $upazilas = json_decode($jsonContents, true);
            foreach ($upazilas as $upazila) {
                if ($upazila['district_id'] == $districtId) {
                    $data[$upazila['name']] = $upazila['name'] . ' - ' . $upazila['bn_name'];
                }
            }
        }

        return $data;
    }
}
if (!function_exists('getDistrictOptions')) {
    function getDistrictOptions($divisionId)
    {
        $jsonFile = public_path('json/bd-districts.json');
        $data = [];
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $districts = json_decode($jsonContents, true);
            foreach ($districts as $district) {
                if ($district['division_id'] == $divisionId) {
                    $data[$district['id']] = $district['name'] . ' - ' . $district['bn_name'];
                }
            }
        }

        return $data;
    }
}
if (!function_exists('getDivisionNameById')) {
    function getDivisionNameById($divisionId)
    {
        $jsonFile = public_path('json/bd-divisions.json');
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $divisions = json_decode($jsonContents, true);
            foreach ($divisions as $division) {
                if ($division['id'] == $divisionId) {
                    return $division['name'];
                }
            }
        }

        return null; // Return null if division ID is not found
    }
}
if (!function_exists('getDivisionOptions')) {
    function getDivisionOptions()
    {
        $jsonFile = public_path('json/bd-divisions.json');
        $data = [];
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $divisions = json_decode($jsonContents, true);
            foreach ($divisions as $division){
                $data[$division['id']] = $division['name'].' - '.$division['bn_name'];
            }

        }

        return $data;
    }
}
if (!function_exists('setSetting')) {
    function setSetting($key, $value)
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        return $setting->value;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}

