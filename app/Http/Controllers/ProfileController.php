<?php

namespace App\Http\Controllers;

use App\Contracts\ProfileImageManagerContract;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $profile=Auth::user()->profile;


        return view('profile.index',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $profile=new Profile();

        return view('profile.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProfileImageManagerContract $imageManager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, ProfileImageManagerContract $imageManager)
    {
        $data = request()->validate([
            'name' => 'required',
            'image' =>  'image|required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath= $imageManager->storeProfileImage();

       $profile= auth()->user()->profile()->create([
            'name' => $data['name'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' .$profile->id)->with('store','Your profile has been successfully store');
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Profile $profile)
    {

        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Profile $profile)
    {
        $this->authorize('edit',$profile);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Profile $profile
     * @param ProfileImageManagerContract $imageManager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Profile $profile, ProfileImageManagerContract $imageManager)
    {

        $this->authorize('update',$profile);
        $data = request()->validate([
            'name' => 'required',
            'image' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        ]);
            $imagePath=  $imageManager->updateProfileImage($profile);

            auth()->user()->profile()->update(array_merge(
                $data,
                $imagePath ?? []
            ));
        return redirect("/profile/".$profile->id)->with('update', 'Your images has been successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @param ProfileImageManagerContract $imageManager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Profile $profile, ProfileImageManagerContract $imageManager)

    {
        $this->authorize('destroy',$profile);
        $imageManager->deleteProfileImage($profile);
        $profile->delete();
        return redirect("/profile")->with('delete', 'Your images has been successfully delete');
    }
}
