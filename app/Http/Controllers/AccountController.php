<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AccountController extends Controller
{
   

    public function do_login(Request $request)
    {
        $username = $request->txtusername;
        $password = $request->txtpassword;
        
        $data = \App\Models\User::where('username', $username)->first();
        
         // php7.2 echo count( (array) $myObject);
        if(count((array) $data) > 0) { //apakah email tersebut ada atau tidak
            //if(Hash::check($password,$data->password)){
                
            if($password == $data->password){
                Session::put('username', $data->username);
                Session::put('userlevel', $data->userlevel);
                Session::put('usergroup', $data->usergroup);
                Session::put('emp_id', $data->emp_id);  
                Session::put('dist_code', $data->dist_code);
                Session::put('use_upload', $data->use_upload);  
                if ($data->distributors) {
                    Session::put('dist_name',$data->distributors->dist_name);
                } else {
                    Session::put('dist_name',"");
                }
                
                                            
                Session::put('islogin',TRUE);

                // $emp = \App\Models\Employee::where('empid', $data->empid)->first();
                // Session::put('superiorid',$emp->superiorid);

                // my subordinate
                // $sub = \App\Models\Employee::where('SuperiorId', $data->EmpId)->get();
                // $sub_str = '';
                // foreach($sub as $item) {
                //     $sub_str .= "".$item->EmpId.",";
                // }
                // $sub_str = substr($sub_str,0-1);
                // Session::put('subordinate',$sub_str);

                return redirect('/');
                
            }
            else{
                return redirect('login')->with('msg-alert','Password Salah !'.Hash::check($password,$data->password));
            }
         
        }
        else{
            return redirect('login')->with('msg-alert','User salah atau tidak terdaftar !');
        }
        

    }

    public function index()
    {
        if(!Session::get('islogin')){
            return view('auth.login')->with('alert','Kamu harus login dulu');
        }
        else{
            return redirect('home');
        }
    }

    
    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    // register new user
    public function register(Request $request){
        return view('account.register');
    }

    // // register post
    // public function register_post(Request $request){
    //     $this->validate($request, [
    //         'username' => 'required|min:4',
    //         // 'email' => 'required|min:4|email|unique:users',
    //         'password' => 'required',
    //         'confirmation' => 'required|same:password',
    //         'userlevel' => 'required',
    //     ]);
    //     $data =  new \App\Models\User();
    //     $data->username = $request->username;
    //     // $data->email = $request->email;
    //     $data->password = bcrypt($request->password);
    //     $data->userlevel = $request->userlevel;
    //     $data->usergroup = $request->usergroup;    
    //     $data->save();

    //     Session::flash('success', 'Sukses di register!');
    //     return back();
    // }

    // update profile
    function profile(Request $request)
    {
        $rec = \App\Models\User::where('username', Session::get('username'))->first();
        return view("account.profile");
    }

    function changepassword(Request $request)
    {
        $rec = \App\Models\User::where('username', Session::get('username'))->first();
        return view("account.changepassword");
    }

    public function changepassword_post(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',                
            
        ]);
        $data =  DB::table('users')->where('email', $request->email)->first();
        $data->password = bcrypt($request->password);           
        $data->save();

        // send email di sini

        // send messages
        Session::flash('success', 'Password baru telah di kirim ke email!');
        return back();
        
    }

    

    public function user_edit($id=null)
    {
        $rec_dist = DB::table('acp_distributor')->select('dist_code', 'dist_name')           
            ->orderBy('dist_name', 'ASC')->get();
        $rec_user = DB::table('users')->where('id', $id)->first();
        
        $data = array(
            'rec_user' => $rec_user,
            'rec_dist' => $rec_dist,
        );
        return view('account.useredit')->with($data);
    }

    public function forgotpassword(Request $request)
    {
        $data = array (
            'page_title' => 'Forgot Password',

        );
        return view('account.forgotpassword')->with($data);
    }

    public function user_list(Request $request)
    {
        // $rec_user = \App\Models\User::orderBy('created_at', 'DESC')->paginate(10);
        $rec_user = DB::connection()->table('users')
            ->select(DB::raw('users.id, users.username, users.userlevel, users.usergroup, users.dist_code, acp_distributor.dist_name'))
            ->join('acp_distributor', 'users.dist_code', '=', 'acp_distributor.dist_code', 'left outer')
            ->paginate(10);
        $data = array(
            'page_title' => 'User List',
            'rec_user'=> $rec_user,
        );


        return view('account.userlist')->with($data);
    }

    public function user_entry(Request $request)
    {
        $rec_dist = DB::table('acp_distributor')->select('dist_code', 'dist_name')           
            ->orderBy('dist_name', 'ASC')->get();
        $data = array(
            'page_title' => 'User Entry',
            'rec_dist' => $rec_dist,
        );
        return view('account.usernew')->with($data);
    }

    public function user_post(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:4',
            'password' => 'min:6|required_with:password2|same:password2',
            'password2' => 'min:6'
        ]);
        
        // check if username exists
        $data =  new \App\Models\User();
        if ($request->id !== null)
        {   
            $data->exists = true; // for updating existing record
            $data->id = $request->id;
            $data->updated_by = Session::get('username');
        }
       
        $data->username = $request->username;
        $data->fullname = $request->username;
        $data->password = $request->password;
        // $data->password = bcrypt($request->password);
        $data->userlevel = $request->userlevel;
        $data->usergroup = $request->userlevel;
        $data->dist_code = $request->dist_code;        
        $data->created_by = Session::get('username');        
        $data->save();

       return redirect('/admin/user');
    }

    public function help()
    {
        return view("account.help");
        
    }


    // selected session period
    function reload_period(Request $request)
    {
        $backto = $request->query('backto');
        $period = $request->query('period');
        Session::put('selected_period', $period); 

        return redirect($backto);
        
    }

    // set session period by post
    public function set_period_session(Request $request)
    {
        $period = $request->period;
        Session::put('selected_period', $period); 

        return $period;
        
    }

}
