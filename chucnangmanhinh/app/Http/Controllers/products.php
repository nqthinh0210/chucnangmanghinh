<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use session;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
session_start();
class products extends Controller
{
    public function AuthLogin(){
        $user_id = session()->get('user_id');
        if($user_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('/login')->send();
        }
    }
    //Tới trang liệt kê sản phẩm
    public function show_product(){
        $this->AuthLogin();
        $all_product=DB::table('tbl_product')->orderBy('product_id','desc')->paginate(1);
        $maneger_product = view('product.show-product')->with('all_product',$all_product);
        return view('index')->with('product.show-product',$maneger_product);
    }
    //Tới trang thêm sản phẩm
    public function add_product(){
        $this->AuthLogin();
        return view('product.add-product');
    }
    // Thêm sản phẩm
    public function save_product(Request $request){
        $name_sp = $request->name_sp;
        $price_sp = $request->price_sp;
        if(strlen($name_sp) >= 5){
            if($price_sp >= 1){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Kiểm tra xem tệp đã được tải lên mà không có lỗi hay không
                if(isset($_FILES["img_sp"]) && $_FILES["img_sp"]["error"] == 0){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["img_sp"]["name"];
                    $filetype = $_FILES["img_sp"]["type"];
                    $filesize = $_FILES["img_sp"]["size"];
                
                    // Xác minh kích thước tệp - tối đa 2MB
                    $maxsize = 2 * 1024 * 1024;
                    if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
                    // Xác minh loại ĐUÔI của tệp
                    if(in_array($filetype, $allowed)){
                        $img_sp = $request->file('img_sp');
                        // Kiểm tra xem tệp có tồn tại hay không trước khi tải lên
                        if($img_sp){
                            $data_product = array();
                            $data_product['product_name'] = $name_sp;
                            $data_product['product_price'] = $price_sp;
                            $data_product['product_content']=$request->content_sp;
                            $data_product['product_status']=$request->status_sp;
        
                            $get_name_img = $img_sp->getClientOriginalName();
                            $name_img = current(explode('.',$get_name_img));
                            $new_img = $name_img.'.'.$img_sp->getClientOriginalExtension();
                            $img_sp->move('public/upload/',$new_img);
                            $data_product['product_img'] = $new_img;
        
                            DB::table('tbl_product')->insert($data_product);
                            session()->put('message','Thêm Product thành công');
                            return Redirect::to('add-product');
                        }else{
                            //echo $_FILES["photo"]["tmp_name"];
                            session()->put('message','Tải tệp hình thất bại');
                            return view('product.add-product');
                        } 
                    } else{
                        echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
                    }
                } else{
                    echo "Error: " . $_FILES["photo"]["error"];
                }
            }
            }else{
                session()->put('message','Giá phải lớn hơn 0');
                return view('product.add-product');
            }
        }else{
            session()->put('message','Sản phẩm phải có trên 5 ký tự');
            return view('product.add-product');
        }
    }
    //Kích hoạt
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        session()->put('message','Mở trạng thái hoạt động thành công');
        return Redirect::to('show-product');
    }
    //Bỏ kích hoạt
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        session()->put('message','Tắt trạng thái hoạt động thành công');
        return Redirect::to('show-product');
    }
    //Xóa
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        session()->put('message','XÓA sản phẩm thành công');
        return Redirect::to('show-product');
    }
    // Lấy thông tin sản phẩm sửa
    public function take_product($product_id){
        $this->AuthLogin();
        $take = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $maneger_take = view('product.edit-product')->with('take',$take);
        return view('index')->with('product.edit-product',$maneger_take);
    }
    // Cập nhật sản phẩm sữa
    public function update_product(Request $request,$product_id){
        $name_sp = $request->name_sp;
        $price_sp = $request->price_sp;
        if(strlen($name_sp) >= 5){
            if($price_sp >= 1){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Kiểm tra xem tệp đã được tải lên mà không có lỗi hay không
                if(isset($_FILES["img_sp"]) && $_FILES["img_sp"]["error"] == 0){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["img_sp"]["name"];
                    $filetype = $_FILES["img_sp"]["type"];
                    $filesize = $_FILES["img_sp"]["size"];
                
                    // Xác minh kích thước tệp - tối đa 2MB
                    $maxsize = 2 * 1024 * 1024;
                    if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
                    // Xác minh loại ĐUÔI của tệp
                    if(in_array($filetype, $allowed)){
                        $img_sp = $request->file('img_sp');
                        // Kiểm tra xem tệp có tồn tại hay không trước khi tải lên
                        if($img_sp){
                            $data_product = array();
                            $data_product['product_name'] = $name_sp;
                            $data_product['product_price'] = $price_sp;
                            $data_product['product_content']=$request->content_sp;
        
                            $get_name_img = $img_sp->getClientOriginalName();
                            $name_img = current(explode('.',$get_name_img));
                            $new_img = $name_img.'.'.$img_sp->getClientOriginalExtension();
                            $img_sp->move('public/upload/',$new_img);
                            $data_product['product_img'] = $new_img;
        
                            DB::table('tbl_product')->where('product_id',$product_id)->update($data_product);
                            session()->put('message','Cập nhật Product thành công');
                            return Redirect::to('show-product');
                        }else{
                            session()->put('message','Tải tệp hình thất bại');
                            return view('product.show-product');
                        } 
                    } else{
                        echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
                    }
                } else{
                    echo "Error: " . $_FILES["photo"]["error"];
                }
            }
            }else{
                session()->put('message','Giá phải lớn hơn 0');
                return view('product.show-product');
            }
        }else{
            session()->put('message','Sản phẩm phải có trên 5 ký tự');
            return view('product.show-product');
        }
    }
    // Tìm kiếm
    public function search(Request $request){
        $this->AuthLogin();
        $keyword = $request->keyword_product;
        $search = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        return view('product.search-product')->with('search',$search);
    }
}

