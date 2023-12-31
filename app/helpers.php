<?php

use App\Models\ExamPaper;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
if (!function_exists('getResultAttemptDetails')) {
    function getResultAttemptDetails($result)
    {
        $resultId = $result->id;
        $attempts = \App\Models\Result::where('user_id', $result->user_id)
                ->where('exam_paper_id', $result->exam_paper_id)
                ->orderBy('created_at', 'asc')
                ->get();

            $attemptDetails = $attempts->map(function ($item) {
                return [
                    'result_id' => $item->id,
                    'mark' => $item->mark,
                    'created_at' => $item->created_at,
                ];
            });

            $totalAttempts = count($attempts);
            $currentAttempt = $attempts->search(function ($item) use ($resultId) {
                    return $item->id == $resultId;
                }) + 1;

            return "Total Exam Attempts: $totalAttempts and this result from attempt number $currentAttempt";

    }
}
if (!function_exists('formatDateTime')) {
    function formatDateTime($dateTime): string
    {
        $dateTime = Carbon::parse($dateTime);
        $formattedDate = $dateTime->format('jS M y, g:i a');
        $timeDifference = $dateTime->diffForHumans();
        return "$timeDifference <br>($formattedDate)";
    }
}
if (!function_exists('getRunningExamPapers')) {
    function getRunningExamPapers($id)
    {
       return DB::table('exam_papers')
           ->selectRaw('*, CONCAT(startdate, " ", starttime) AS start_datetime, CONCAT(enddate, " ", endtime) AS end_datetime')
           ->whereRaw('CONCAT(startdate, " ", starttime) <= ?', [now()->toDateTimeString()])
           ->whereRaw('CONCAT(enddate, " ", endtime) >= ?', [now()->toDateTimeString()])
           ->whereRaw('exam_category_id = '.$id)
           ->get();
    }
}
if (!function_exists('getUpcomingExamPapers')) {
    function getUpcomingExamPapers($id): Collection
    {
        return DB::table('exam_papers')
            ->selectRaw('*, CONCAT(startdate, " ", starttime) AS start_datetime, CONCAT(enddate, " ", endtime) AS end_datetime')
            ->whereRaw('CONCAT(startdate, " ", starttime) >= ?', [now()->toDateTimeString()])
            ->whereRaw('exam_category_id = '.$id)
            ->get();
    }
}
if (!function_exists('getTodayExamPapers')) {
    function getTodayExamPapers($id): Collection
    {
        return ExamPaper::where('exam_category_id',$id)->whereDate('startdate', '=', now()->toDateString())->get();
    }
}
if (!function_exists('isTodayExam')) {
    function isTodayExam($exam)
    {
        $examStartDate = Carbon::parse($exam->startdate)->toDateString();
        $today = now()->toDateString();

        return $examStartDate === $today;
    }
}
if (!function_exists('isUpcomingExam')) {
    function isUpcomingExam($exam)
    {
        $startDateTime = Carbon::parse($exam->startdate . ' ' . $exam->starttime);
        $now = now();

        return $now->lessThan($startDateTime);
    }
}
if (!function_exists('isPreviousExam')) {
    function isPreviousExam($exam)
    {
        $endDateTime = Carbon::parse($exam->enddate . ' ' . $exam->endtime);
        $now = now();

        return $now->greaterThan($endDateTime);
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
    function getPreviousExamPapers($id): Collection
    {
        return DB::table('exam_papers')
            ->selectRaw('*, CONCAT(enddate, " ", endtime) AS end_datetime')
            ->whereRaw('NOW() > STR_TO_DATE(CONCAT(enddate, " ", endtime), "%Y-%m-%d %H:%i:%s")')
            ->whereRaw('exam_category_id = '.$id)
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

