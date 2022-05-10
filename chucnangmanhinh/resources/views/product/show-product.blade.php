@extends('index')
@section('content')
<div class="row">
  <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
          Danh sách sản phẩm
        </div>
        <div class="row w3-res-tb">
          <div class="edit col-sm-4">
            <form action="{{URL::to('/timkiem-product')}}" method="POST">
              {{ csrf_field() }}
            <div class="edit search_box pull-right">
              <input type="text" name="keyword_product" placeholder="Search"/>
              <input type="submit" name="submit_search" value="Tìm kiếm" class="btn btn-default btn-sm"/>
            </div>
            </form>
          </div>
        </div>
        <div class="table-responsive">
          <?php
              $message = session()->get('message');
              if($message){
                  echo $message;
                  session()->put('message', null);
              }
          ?>
          <table class="table table-striped b-t b-light">
            <thead>
              <tr>
                <th style="width:20px;">
                  <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                  </label>
                </th>
                <th>Tên sản phẩm</th>
                <th>Hình sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Mô tả</th>
                <th>Action</th>
                <th style="width:30px;"></th>
              </tr>
            </thead>
            <tbody>
              {{-- bắt đầu lấy dữ liệu --}}
              @foreach($all_product as $key => $data_sp)     
              <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$data_sp->product_name}}</td>
                <td><img src="public/upload/{{$data_sp->product_img}}" height="100px" width="150px" alt="hình sản phẩm"></td>
                <td>{{number_format($data_sp->product_price).'đ'}}</td>
                <td>{!! $data_sp->product_content !!}</td>
                <td><span class="text-ellipsis">
                  <?php
                    if($data_sp->product_status==0){
                  ?>
                    <a href="{{URL::to('/active-sanpham/'.$data_sp->product_id)}}">
                      <span style="color: red" class="edit-symbol fa fa-solid fa-eye-slash"></span></a>
                  <?php  
                    }else {
                  ?>
                    <a href="{{URL::to('/unactive-sanpham/'.$data_sp->product_id)}}">
                      <span class="edit-symbol fa fa-solid fa-eye"></span></a> 
                  <?php
                    }                               
                  ?>
                </span>
                  <a href="{{URL::to('/edit-sanpham/'.$data_sp->product_id)}}" class="active" ui-toggle-class="">
                    <span class="edit-symbol fa fa-edit text-success text-active"></span>
                  </a>
                  <a onclick="return confirm('Bạn có chắc là muốn xóa?')" href="{{URL::to('/delete-sanpham/'.$data_sp->product_id)}}">
                    <span class="edit-symbol delete-symbol fa fa-times text-danger text"></span>
                  </a>
                </td>
              </tr>
              
              @endforeach
              {{-- kết thúc lấy dữ liệu --}}
            </tbody>
          </table>
          <span style="float: right">{{$all_product->render("pagination::bootstrap-4")}}</span>
        </div>
      </div>
  </div>
</div>
@endsection