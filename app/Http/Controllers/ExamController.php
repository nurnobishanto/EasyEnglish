<?php

namespace App\Http\Controllers;

use App\Models\Exampaper;
use App\Models\Result;
use App\Models\FreeNote;
use App\Models\Ebook;
use Artesaos\SEOTools\Facades\SEOTools;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Carbon\Carbon;
class ExamController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pass(Request $request){
        $url = "testpass/".$request->id."/".$request->pass;
        return redirect($url);

    }
    public function indexpass($id,$pass)
    {

        $paper = Exampaper::where('id', $id)->where('password', $pass)->first();

        if ($paper) {
            $limit = 9999;
            $date = Carbon::now();
            $date = date('Y-m-d', time());
            $time = date('H:i:s', time());
            $currentTime = $date . " " . $time;
            $paperid = "paperid" . $paper->id;

            $result = Result::where('user_id', Auth::user()->id)->where('exam_paper_id', $paper->id)->get();

            $atmpCount = $result->count();
            $attmDuration = 0;
            if(date('Y-m-d H:i:s') >= $paper->startdate . ' ' . $paper->starttime && date('Y-m-d H:i:s') <= $paper->enddate . ' ' . $paper->endtime){
                $limit = 1;
            }else{
                $limit = 999999;
            }
            if ($atmpCount < $limit) {
                if (Session::has($paperid)) {
                    $attempt = Session::get($paperid);
                    $start_date = new DateTime($attempt);
                    $since_start = $start_date->diff(new DateTime($currentTime));
                    $seconds = $since_start->days * 24 * 60;
                    $seconds += $since_start->h * 60;
                    $seconds += $since_start->i * 60;
                    $seconds += $since_start->s;

                    $attmDuration = $seconds;

                } else {
                    Session::put($paperid, $currentTime);
                }
                SEOTools::setTitle($paper->name);
                SEOTools::setDescription(getSetting('site.description'));
                if(date('Y-m-d H:i:s') >= $paper->startdate . ' ' . $paper->starttime){
                    return view('website.test', compact(['paper', 'attmDuration']));
                }else{
                    return view('website.start', compact(['paper']));
                }


            } else {

                return "Limit Cross";

            }

        } else {
            return "Password Wrong!";
        }
    }
    public function index($id)
    {

        $paper = Exampaper::where('id', $id)->first();

        if ($paper) {
            $limit = 9999;
            $date = Carbon::now();
            $date = date('Y-m-d', time());
            $time = date('H:i:s', time());
            $currentTime = $date . " " . $time;
            $paperid = "paperid" . $paper->id;

            $result = Result::where('user_id', Auth::user()->id)->where('exam_paper_id', $paper->id)->get();

            $atmpCount = $result->count();
            $attmDuration = 0;
            if(date('Y-m-d H:i:s') >= $paper->startdate . ' ' . $paper->starttime && date('Y-m-d H:i:s') <= $paper->enddate . ' ' . $paper->endtime){
                $limit = 1;
            }else{
                $limit = 999999;
            }
            if ($atmpCount < $limit) {
                if (Session::has($paperid)) {
                    $attempt = Session::get($paperid);
                    $start_date = new DateTime($attempt);
                    $since_start = $start_date->diff(new DateTime($currentTime));
                    $seconds = $since_start->days * 24 * 60;
                    $seconds += $since_start->h * 60;
                    $seconds += $since_start->i * 60;
                    $seconds += $since_start->s;

                    $attmDuration = $seconds;

                } else {
                    Session::put($paperid, $currentTime);
                }
                SEOTools::setTitle($paper->name);
                SEOTools::setDescription(getSetting('site.description'));
                if(date('Y-m-d H:i:s') >= $paper->startdate . ' ' . $paper->starttime){
                    return view('website.test', compact(['paper', 'attmDuration']));
                }else{
                    return view('website.start', compact(['paper']));
                }


            } else {

                return "Limit Cross";

            }

        } else {
            return view('website.404');
        }
    }
    public function checking(Request $request)
    {

        $paperid = "paperid" . $request->paperid;
        $id = $request->paperid;

        if (Session::has($paperid)) {
            $attempt = Session::get($paperid);
            Session::forget($paperid);
        } else {

            $result = Result::where('user_id', Auth::user()->id)->where('exam_paper_id', $request->paperid)->orderBy('total_mark', 'DESC')->orderBy('duration', 'ASC')->orderBy('created_at', 'ASC')->get();

            // return $result;
            SEOTools::setTitle('My Result');
            SEOTools::setDescription(getSetting('site.description'));
            return view('website.singleresult', compact(['result', 'id']));
        }
        $paper = Exampaper::where('id', $id)->first();
        $date = Carbon::now();
        $date = date('Y-m-d', time());
        $time = date('H:i:s', time());
        $currentTime = $date . " " . $time;

        $start_date = new DateTime($attempt);
        $since_start = $start_date->diff(new DateTime($currentTime));

        $seconds = $since_start->days * 24 * 60;
        $seconds += $since_start->h * 60;
        $seconds += $since_start->i * 60;
        $seconds += $since_start->s;



        $mark = 0.0;
        $pm = $request->pmark;
        $nm = $request->nmark;
        $notans = 0;
        $wrongans = 0;
        $correctans = 0;

        for ($c = 1; $c <= $request->total; $c++) {
            $ca = "ca" . $c;
            $sop = "op" . $c;
            if ($request->$sop == $request->$ca) {
                $mark = $mark + $pm;
                $correctans = $correctans + 1;
            } elseif ($request->$sop == "none") {
                $notans = $notans + 1;
            } else {
                $mark = $mark - $nm;
                $wrongans = $wrongans + 1;
            }

        }

        $result = new Result;

        $result->exam_paper_id = $request->paperid;
        $result->user_id = Auth::user()->id;
        $result->total_mark = $mark;
        $result->ca = $correctans;
        $result->na = $notans;
        $result->wa = $wrongans;
        $result->duration = $seconds;
        $result->created_at;
        $result->save();
        $result = Result::where('user_id', Auth::user()->id)->where('exam_paper_id', $request->paperid)->orderBy('created_at', 'DESC')->take(1)->get();
        SEOTools::setTitle('My Result');
        SEOTools::setDescription(getSetting('site.description'));
        return view('website.result', compact(['result', 'id','request','paper']));
    }

    public function download(Request $request)
    {
        //return $request->id;

        $download = ENV('APP_URL') ."". $request->url;
        if($request->type == "note"){
            $note = FreeNote::where('id', $request->id)->first();
            if($note){
                $note->increment('count');
                return redirect($download);
            }else{
              return  "Note not Found!";
            }

        }elseif($request->type == "ebook"){
             $ebook = Ebook::where('id', $request->id)->first();
            if($ebook){
                $ebook->increment('count');
                return redirect($download);
            }else{
              return  "E-Book not Found!";
            }
        }else{
         // return redirect($download);
         return "Something Error!";
        }



    }

}
