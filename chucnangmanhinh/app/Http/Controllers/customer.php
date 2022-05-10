<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use session;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
session_start();

class customer extends Controller
{
    public function AuthLogin(){
        $user_id = session()->get('user_id');
        if($user_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('/login')->send();
        }
    }
    public function add_customer(){
        $this->AuthLogin();
        return view('customer.add-customer');
    }
    public function save_customer(Request $request){
        $data_vali = $request->validate([

            'customer_name' => 'bail|required|unique:tbl_customer|min:5|max:255',
            'customer_email' => 'bail|required|unique:tbl_customer|email',
            'customer_phone' => 'bail|required|unique:tbl_customer|max:10|min:10',
            'customer_address' => 'required',
        ],
        [
            'customer_name.required' => 'Vui lòng nhập tên',
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_address.required' => 'Vui lòng nhập địa chỉ',

            'customer_name.unique' => 'Tên khách hàng bị trùng',
            'customer_email.unique' => 'Email khách hàng bị trùng',
            'customer_phone.unique' => 'Số điện thoại khách hàng bị trùng',

            'custoemr_phone.min' => 'Số điện thoại không đủ 10 số',
            'custoemr_phone.max' => 'Số điện thoại thừa quá 10 số',
        ]
    );

        $dkmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
        $mail = $request->customer_email;

        if(preg_match($dkmail,$mail)){
            $data = array();
            $data['customer_email'] = $mail;
            $data['customer_name'] = $request->customer_name;
            $data['customer_phone'] = $request->customer_phone;
            $data['customer_address'] = $request->customer_address;
            $data['customer_status'] = $request->customer_status;
        
            DB::table('tbl_customer')->insert($data);
            session()->put('message','Thêm người dùng thành công');
            return Redirect::to('show-customer');
        }else{
            session()->put('message','Thêm Thất bại');
            return view('customer.add-customer');
        }
    }
    public function show_customer(){
        $this->AuthLogin();
        $all = DB::table('tbl_customer')->orderBy('customer_id','desc')->paginate(2);
        $maneger_customer = view('customer.show-customer')->with('all_customer',$all);
        return view('index')->with('customer.show-customer',$maneger_customer);
    }
    public function delete_customer($customer_id){
        DB::table('tbl_customer')->where('customer_id',$customer_id)->delete();
        session()->put('message','XÓA khách hàng thành công');
        return Redirect::to('show-customer');
    }
    public function take_customer($customer_id){
        $this->AuthLogin();
        $take = DB::table('tbl_customer')->where('customer_id', $customer_id)->get();
        $manenger = view('customer.edit-customer')->with('take',$take);
        return view('index')->with('customer.edit-customer',$manenger);
    }
    public function edit_customer(Request $request, $customer_id){
        $data_vali = $request->validate([

            'customer_name' => 'bail|required|unique:tbl_customer|min:5|max:255',
            'customer_email' => 'bail|required|unique:tbl_customer|email',
            'customer_phone' => 'bail|required|unique:tbl_customer|max:10|min:10',
            'customer_address' => 'required',
        ],
        [
            'customer_name.required' => 'Vui lòng nhập tên',
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_address.required' => 'Vui lòng nhập địa chỉ',

            'customer_name.unique' => 'Tên khách hàng bị trùng',
            'customer_email.unique' => 'Email khách hàng bị trùng',
            'customer_phone.unique' => 'Số điện thoại khách hàng bị trùng',

            'custoemr_phone.min' => 'Số điện thoại không đủ 10 số',
            'custoemr_phone.max' => 'Số điện thoại thừa quá 10 số',
        ]
    );
        $dkmail = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
        $mail = $request->customer_email;
        if(preg_match($dkmail,$mail)){$data_edit = array();
            $data_edit['customer_name'] = $request->customer_name;
            $data_edit['customer_email']= $request->customer_email;
            $data_edit['customer_phone'] = $request->customer_phone;
            $data_edit['customer_address'] = $request->customer_address;

            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data_edit);
            session()->put('message','Cập nhật thành công');
            return Redirect::to('show-customer');
        }else{
            session()->put('message','Cập nhật không thành công');
            return view('customer.show-customer');
        }
            
    }
    public function active_customer($customer_id){
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>1]);
        session()->put('message','Mở trạng thái hoạt động thành công');
        return Redirect::to('show-customer');
    }
    public function unactive_customer($customer_id){
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>0]);
        session()->put('message','Tắt trạng thái hoạt động thành công');
        return Redirect::to('show-customer');
    }
    public function search(Request $request){
        $this->AuthLogin();
        $keyword = $request->keyword_customer;
        $search = DB::table('tbl_customer')->where('customer_name','like','%'.$keyword.'%')->get();
        return view('customer.search-customer')->with('search',$search);
    }
}
