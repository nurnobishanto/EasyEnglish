<?php

namespace App\Http\Controllers;

use App\Models\ExamPaper;
use App\Models\Result;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profile = User::where('id', Auth::user()->id)->first();
        $activity = Result::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        SEOTools::setTitle('My Profile');
        SEOTools::setDescription(getSetting('site_description'));
        return view('website.profile', compact(['profile', 'activity']));
    }
    protected function update(Request $data)
    {

        $data->validate([

            'name' => 'required',
            'email' => 'required|email',
        ]);
        $profile = User::where('id', Auth::user()->id)->first();
        if ($profile) {
            $profile->name = $data['name'];
            $profile->email = $data['email'];
            $profile->college = $data['college'];
            $profile->batch = $data['batch'];
            $profile->district = $data['district'];
            $msg = "Profile Information updated Submit Successfully";
            if ($data['password'] == $data['password_confirmation'] && strlen($data['password']) > 7) {
                $profile->password = Hash::make($data['password']);
                $msg = "Profile Information and password updated Submit Successfully";
            }
            $profile->update();
        }


        return redirect()->back()->with(['success' => $msg]);
    }
    public function test($id)
    {

        $papaer = ExamPaper::where('id', $id)->first();
        if ($papaer) {
            //   $quistions =  $papaer->quistions;
            // $ecats = Examcategory::where('id',$sub->id)->paginate(6);
            return view('website.test', compact(['papaer']));
        } else {
            return view('website.404');
        }
    }
}
