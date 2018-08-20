<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	$users = User::where('status',1)->where('is_deleted',0)->get();
    	return view('backend/users/index',compact('users'));
    } 

    public function add(){
    	return view('backend/users/add');
    }

    public function edit($id){
    	$id = base64_decode($id);
    	$user = User::where('id',$id)->first();
    	return view('backend.users.edit',compact('user'));
    }

    public function store(Request $request){
    	$user = new User;
    	$user->name = $request->name;
    	// $user->user_type = 'user';
    	// $user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->status = $request->is_active;
        $user->role ='2';
    	$user->save();

    	return redirect('private/user/index')->with('success','User Registered Successfully!!' );
    }


    public function delete($id){
    	$id = base64_decode($id);

    	$data = User::find($id);
    	$data->is_deleted = 1;
        $data->save();

    	return redirect('private/user/index')->with('success','User Deleted Successfully!!' );
    }

    public function finaldelete($id){
        $id = base64_decode($id);

        $data = User::find($id);
        $data->delete();

        return redirect('private/user/deleted')->with('success','User Deleted Successfully!!' );
    }

    public function restore($id){
        $id = base64_decode($id);

        $data = User::find($id);
        $data->is_deleted = 0;
        $data->save();

        return redirect('private/user/deleted')->with('success','User Restored Successfully!!' );
    }

    public function deleted(){
        $users = User::where('is_deleted',1)->get();
        return view('backend.users.deleted',compact('users'));
    }

    public function update(Request $request,$id){
        $id = base64_decode($id);

        $user = User::find($id);
        $user->name = $request->name;
        // $user->last_name = $request->lname;
        // $user->user_type = 'user';
        // $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->is_active;
        $user->save();

        return redirect('private/user/index')->with('success','User Updated Successfully!!' );
    }

    

}
