<?php

use App\Models\ExamPaper;
use Illuminate\Support\Collection;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;


if (!function_exists('getRunningExamPapers')) {
    function getRunningExamPapers()
    {
       return DB::table('exam_papers')
           ->selectRaw('*, CONCAT(startdate, " ", starttime) AS start_datetime, CONCAT(enddate, " ", endtime) AS end_datetime')
           ->whereRaw('CONCAT(startdate, " ", starttime) <= ?', [now()->toDateTimeString()])
           ->whereRaw('CONCAT(enddate, " ", endtime) >= ?', [now()->toDateTimeString()])
           ->get();
    }
}
if (!function_exists('getUpcomingExamPapers')) {
    function getUpcomingExamPapers(): Collection
    {
        return DB::table('exam_papers')
            ->selectRaw('*, CONCAT(startdate, " ", starttime) AS start_datetime, CONCAT(enddate, " ", endtime) AS end_datetime')
            ->whereRaw('STR_TO_DATE(CONCAT(startdate, " ", starttime), "%Y-%m-%d %H:%i:%s") > NOW()')
            ->get();
    }
}
if (!function_exists('getTodayExamPapers')) {
    function getTodayExamPapers(): Collection
    {
        return ExamPaper::whereDate('startdate', '=', now()->toDateString())->get();
    }
}
if (!function_exists('isExamRunning')) {
    function isExamRunning($exam)
    {
        $startTime = $exam->startdate . ' ' . $exam->starttime;
        $endTime = $exam->enddate . ' ' . $exam->endtime;

        return now() >= $startTime && now() <= $endTime;
    }
}
if (!function_exists('isExamStarted')) {
    function isExamStarted($exam)
    {
        $startTime = $exam->startdate . ' ' . $exam->starttime;

        return now() >= $startTime;
    }
}
if (!function_exists('getPreviousExamPapers')) {
    function getPreviousExamPapers(): Collection
    {
        return DB::table('exam_papers')
            ->selectRaw('*, CONCAT(enddate, " ", endtime) AS end_datetime')
            ->whereRaw('NOW() > STR_TO_DATE(CONCAT(enddate, " ", endtime), "%Y-%m-%d %H:%i:%s")')
            ->get();
    }
}
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

