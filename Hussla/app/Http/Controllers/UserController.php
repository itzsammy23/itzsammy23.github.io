<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Comments;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show() {
        return view('user.success');
    }

    public function home() {
        session(["user_agent" => null]);
        return view('welcome');
    }

    public function view(User $user) {
        return view('user.profile', compact('user'));
    }
    public function index() {
        return view('user.search');
    }

    public function search() {
            $specialize = request('service');
            $state = request('state');
            $area = request('area');

            $users = User::where([
                ['specialize', $specialize],
                ['state', $state],
                ['area', $area],
            ])->paginate(3);

            return view('user.result', compact('users'));
    }

    public function find() {
        $search_param = request('parameter');
        $users = User::where('firstname', 'like', "{$search_param}%")
        ->orWhere('businessname', 'like', "{$search_param}%")->paginate(3);

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
        $comments = Comments::whereIn('user_id', [$user->id])->paginate(10);
        $user_name = "$user->firstname {$user->lastname}";
        session(['user' => $user_name]);
        return view('user.comment', compact('comments'));
    }
}
