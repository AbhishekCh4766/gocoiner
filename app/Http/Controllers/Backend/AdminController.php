<?php

namespace App\Http\Controllers\Backend;

use App\Coin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateUserRequest;
use App\Library\CoinRepository;
use App\MenuItem;
use App\News;
use App\Page;
use Artisan;
use Auth;
use Hash;
use Illuminate\Support\Facades\Input;

/**
 * Class AdminController
 * @package App\Http\Controllers\Backend
 */
class AdminController extends Controller
{
    public function index()
    {

        // echo (Auth::user()->role);
        // die;
              if(Auth::User()->role == '1')
            {
        $coins_count = Coin::count();
        $news_count = News::count();
        $posts_count = Page::count();
        $menus_count = MenuItem::count();

        return view('backend.index', compact('coins_count', 'posts_count', 'news_count', 'menus_count')); 
            }

            else
            {
                return redirect()->back()->with('error', 'You are Unautherised to view Admin Page.');
               // return ('You are Unautherised to view this page.');
            }
    }

    public function search()
    {
        $q = Input::get('search_term');
        $coins = CoinRepository::searchCoinsWithCount($q, 15);

        return view('backend.search_results', compact('coins', 'q'));
    }

    public function profile()
    {
        return view('backend.profile');
    }

    public function updateprofile(UpdateUserRequest $request)
    {
        if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
            // The passwords matches
            return redirect()->back()->with('error', 'Your current password does not match with the password you provided. Please try again.');
        }

        if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
            // Current password and new password are same
            return redirect()->back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        // Change Password
        $user = Auth::user();
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function execute($cmd)
    {
        $artisan = null;
        switch (strtolower($cmd)) {
            case 'cache':
                $artisan = 'cache:clear';
                break;
            case 'view':
                $artisan = 'view:clear';
                break;
            case 'cron':
                $artisan = 'schedule:run';
                break;
        }

        if ($artisan !== null) {
            $code = Artisan::call($artisan);
            flash()->success(sprintf('"%s" command executed. Return code: %d', $cmd, $code))->important();
        } else {
            flash()->warning(sprintf('Unknown command: "%s"', $cmd))->important();
        }
        return redirect()->route('private.index');
    }
}