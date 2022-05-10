<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();
class user extends Controller
{
    // Kiểm tra đã có người đăng nhập chưa
    public function AuthLogin(){
        $user_id = session()->get('user_id');
        if($user_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('/login')->send();
        }
    }
    // Kiểm tra đăng nhập và lưu thông tin người đăng nhập
    public function check_user(Request $request){
        $dkmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
        $check_mail = $request->email_user;
        if(preg_match($dkmail,$check_mail)){
            $mail = $request->email_user;
            $password= $request->password_user;
            $kq = DB::table('tbl_user')->where('user_email',$mail)->where('user_password',$password)->first();
            if($kq){
                session()->put('user_name',$kq->user_name);
                session()->put('user_id',$kq->user_id);
                return Redirect::to('/');
            }else{
                session()->put('mess_login_user','không có dữ liệu người dùng');
                return Redirect::to('/login')->send();
            }           
        }else{
            session()->put('mess_login_user','không đúng định dạng mail');
            return Redirect::to('/login')->send();
        }
    }
    
    // Hiện thị toàn bộ user
    public function show_user(){
        $this->AuthLogin();
        $all_user = DB::table('tbl_user')->orderBy('user_id','desc')->paginate(5);
        $quanly_user = view('user.show')->with('all_user',$all_user);
        return view('index')->with('user.show',$quanly_user);
    }
    // Khóa tài khoản
    public function unactive_user($user_id){
        DB::table('tbl_user')->where('user_id',$user_id)->update(['user_content'=>'Tắt hoạt động','user_status'=>0]);
        session()->put('message','Tắt trạng thái hoạt động thành công');
        return Redirect::to('show-user');
    }
    // Kích hoạt tài khoản
    public function active_user($user_id){
        DB::table('tbl_user')->where('user_id',$user_id)->update(['user_content'=>'hoạt động','user_status'=>1]);
        session()->put('message','Mở trạng thái hoạt động thành công');
        return Redirect::to('show-user');
    }
    // Xóa user
    public function delete_user($user_id){
        DB::table('tbl_user')->where('user_id',$user_id)->delete();
        session()->put('message','XÓA người dùng thành công');
        return Redirect::to('show-user');
    }
    // lấy thông tin user càn sửa và tới trang sửa
    public function take_user($user_id){
        $this->AuthLogin();
        $data = DB::table('tbl_user')->where('user_id',$user_id)->get();
        $manenger = view('user.take-user')->with('data',$data);
        return view('index')->with('user.take-user',$manenger);
    }
    // Lưu thông tin vừa sửa của user
    public function edit_user(Request $request,$user_id){
        $data_vali = $request->validate([
            'user_name' => 'bail|required|min:5|unique:tbl_user|max:255',
            'user_email' => 'bail|required|email|unique:tbl_user',
        ],
        [
            'user_name.required' => 'Vui lòng điền tên',
            'user_name.unique' => 'Tên bị trùng',

            'user_email.required' => 'Vui lòng điền email',
            'user_email.email' => 'Email không đúng',
            'user_email.unique' => 'Email bị trùng',
        ]
    );
        $dkmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
        $email = $request->user_email;
        if(preg_match($dkmail,$email)){
            $data = array();
            $data['user_name'] = $request->user_name;
            $data['user_email']= $request->user_email;

            DB::table('tbl_user')->where('user_id',$user_id)->update($data);
            session()->put('message','Cập nhật thành công');
            return Redirect::to('show-user');
        }else{
            session()->put('message','Cập nhật không thành công, kiểm tra email đúng cú pháp');
            return Redirect::to('show-user');
        }
            
    }
    // Tới trang thêm user
    public function add_user(){
        $this->AuthLogin();
        return view('user.add-user');
    }
    // Đăng ký mới
    public function save_user(Request $request){
        $data_vali = $request->validate([

            'user_name' => 'required|unique:tbl_user|min:5|max:255',
            'user_email' => 'required|unique:tbl_user|email',
            'user_password' => 
                [
                    'required',
                    'string',
                    'min:6',             // ít nhất 6 ký tự
                    'regex:/[a-z]/',      // ít nhất 1 chữ thường
                    'regex:/[A-Z]/',      // ít nhất 1 chữ HOA
                    'regex:/[0-9]/',      // ít nhất 1 số
                ],
            'user_re_password' => 'required|same:user_password',
        ],
        [
            'user_name.required' => 'Vui lòng nhập tên',
            'user_email.required' => 'Vui lòng nhập email',
            'user_password.required' => 'Vui lòng nhập password',
            'user_re_password.required' => 'Vui lòng nhập lại password',

            'user_name.unique' => 'Đã có tên này rồi, vui lòng chọn tên khác',
            'user_email.unique' => 'Đã có Email này rồi, vui lòng chọn tên khác',
            'user_name.min' => 'Tên phải có ít nhất 5 ký tự',

            'user_password.min' => 'Password ít nhất 6 ký tự',
            'user_password.regex' => 'Password ít nhất 1 chữ thường, 1 chữ Hoa, 1 số',

            'user_re_password.same' => 'Mật khẩu nhập lại không giống nhau',
        ]
    );

        $dkmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
        $dkpass = "^^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$";
        $mail = $request->user_email;
        $name = $request->user_name;
        $pass = $request->user_password;
        $repass = $request->user_re_password;

        if(!empty($name)){
            if(preg_match($dkmail,$mail)){
                if($repass == $pass){
                    $data = array();
                    $data['user_email'] = $mail;
                    $data['user_name'] = $name;
                    $data['user_password'] = $pass;
                    $data['user_content'] = $request->user_content;
                    $data['user_status'] = $request->user_status;
                
                    DB::table('tbl_user')->insert($data);
                    session()->put('message','Thêm người dùng thành công');
                    return Redirect::to('show-user');
                }else{
                    session()->put('message','Hai mật khẩu không trùng khớp');
                    return Redirect::to('add-user');
                }
            }else{
                session()->put('message', 'Email ko đúng định dạng');
                return view('user.add-user');
            }
        }else{
            session()->put('message', 'Vui lòng điền tên');
            return view('user.add-user');
        }  
    }
    // Tìm kiếm
    public function search(Request $request){
        $this->AuthLogin();
        $keyword = $request->keyword_search;
        $search = DB::table('tbl_user')->where('user_name','like','%'.$keyword.'%')->paginate(5);
        return view('user.search')->with('search',$search);
    }
}
