<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function store(User $user) {
        request()->validate([
            'profilepic' => ['image', 'required'],
        ]);

        $image = request('profilepic')->store('profile', 'public');

        $data = ['image' => $image];

        auth()->user()->profile->update($data);
        return redirect("/profile/{$user->id}/edit");
    }

    public function update(User $user) {
        request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'businessname' => ['required', 'string', 'max:500'],
            'businessinfo' => ['required', 'string', 'max:1000'],
            'businessphone' => ['required', 'string', 'max:255'],
            'businessaddress' => ['required', 'string', 'max:1000'],
            'specialize' => 'required',
            'businessmotto' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
        ]);

        
        auth()->user()->fill([
            "firstname" => ucfirst(request('firstname')),
            "lastname" => ucfirst(request('lastname')),
            "email" => request('email'),
            "phone" => request('phone'),
            "businessname" => ucfirst(request('businessname')),
            "businessinfo" => ucfirst(request('businessinfo')),
            "businessphone" =>request('businessphone'),
            "businessaddress" => request('businessaddress'),
            "specialize" => ucfirst(request('specialize')),
            "businessmotto" => ucfirst(request('businessmotto')),
            "state" => ucfirst(request('state')),
            "area" => ucfirst(request('area')),
        ]);
        auth()->user()->save();

        return redirect("/profile/{$user->id}");
    }

    public function view(User $user) {
        $views = $user->profile->views;
        $new_views = $views + 1;

        $data = ['views' => $new_views];
        $user->profile->update($data);

     return view('profile.view', compact('user'));
    }

    public function save(User $user) {
        $rating = request('ratedIndex');
        $rated_index = $user->profile->ratedIndex;
        $votecount = $user->profile->voteCount;
        $rated = $user->profile->rating;

        $new_rated_index = $rated_index + $rating  + 1;
        $new_vote_count = $votecount + 1;
        $new_rating = $new_rated_index / $new_vote_count;
        $data = [
            'ratedIndex' => $new_rated_index,
            'voteCount' => $new_vote_count,
            'rating' => $new_rating,
        ];
        $user->profile->update($data);
      
    }
}
