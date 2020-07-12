<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Comments;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserController extends Controller
{

    public function show() {
        return view('user.success');
    }

    public function home() {
        session(["user_agent" => null, "logged_in" => false]);
        return view('welcome');
    }

    public function view() {
        $hussla_id = request()->route('user');
        $user = User::where('hussla_id', $hussla_id)->get()->first();


        $currentDate = date('Y-m-d');
        $currentDateTime = new DateTime($currentDate);
        $dateCreated = $user->created_at->format('Y-m-d');
        $dateCreatedTime = new DateTime($dateCreated);
        $interval = $currentDateTime->diff($dateCreatedTime);
        $daysUsed = $interval->days;
        $dateUpdated = $user->updated_at->format('Y-m-d');
        $dateUpdatedTime = new DateTime($dateUpdated);
        $newInterval = $currentDateTime->diff($dateUpdatedTime);
        $newDate = $newInterval->days;
        $daysLeft = 90 - $daysUsed;
        
        if($user->usingFreeSubscription == "true") {
            if($daysLeft == 0) {
                $user->update([
                    "usingFreeSubscription" => "false",
                    "isEligible" => "false",
                    ]);
            }
          
            session(['days_left' => $daysLeft]);

        } else if ($user->usingPaidSubscription == "true") {
                
                $daysTillNewSub = 365 - $newDate;
               

                if($daysTillNewSub === 0) {
                    $user->update([
                        "usingPaidSubscription" => "false",
                        "isEligible" => "false",
                        ]);
                }
                
              
                session(['days_left' => $daysTillNewSub]);
        } else {
            $user->update([
                "isEligible" => "false",
                "usingFreeSubscription" => "false",
                "usingPaidSubscription" => "false",
                ]);
            session(['days_left' => 0]);
        }
        
    
        return view('user.profile', compact('user'));
    }
    public function index() {
        return view('user.search');
    }

    public function search() {
            $specialize = ucfirst(request('service'));
            $state = ucfirst(request('state'));
            $area = ucfirst(request('area'));

            $users = User::where([
                ['specialize', $specialize],
                ['state', $state],
                ['area', $area],
                ['isEligible', 'true'],
            ])->paginate(10);

           return view('user.result', compact('users'));
    }

    public function find() {
        $search_param = request('parameter');
        $users = User::where('firstname', 'like', "{$search_param}%")
        ->orWhere('businessname', 'like', "{$search_param}%")->paginate(10);

        return view('user.find', compact('users'));
    }

    public function post(User $user) {
            request()->validate([
                'comment' => 'required',
            ]);
            $details = request('customerdetails');
            $comment = request('comment');

            $comment = Comments::create([
                'user_id' => $user->id,
                'customer' => $details,
                'comment' => $comment,
            ]);
                session(['posted' => 'true']);
            return redirect("/view/profile/{$user->id}");
            
    }

    public function comments(User $user) {

        $currentDate = date('d');
        $dateCreated = $user->created_at->format('d');

        $comments = Comments::whereIn('user_id', [$user->id])->paginate(20);
        $user_name = "$user->firstname {$user->lastname}";
        session(['user' => $user_name]);
        return view('user.comment', compact('comments'));
    }
}
