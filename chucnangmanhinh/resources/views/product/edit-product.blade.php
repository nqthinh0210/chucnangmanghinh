@extends('index')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Sửa Sản Phẩm
        </header>

        <?php
            $message = session()->get('message');
            if($message){
                echo $message;
                session()->put('message', null);
            }
        ?>

        <div class="panel-body">
            <div class="position-center">
                @foreach($take as $key => $edit_product)
                <form role="form" action="{{URL::to('/update-sanpham/'.$edit_product->product_id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                    <input type="text" name="name_sp" class="form-control"
                     id="exampleInputEmail1" value="{{$edit_product->product_name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                    <input type="number" name="price_sp" class="form-control"
                        id="exampleInputEmail1" value="{{$edit_product->product_price}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh Sản Phẩm</label>
                    <input type="file" name="img_sp" id="img_sp" onchange="reviewIMG(this);" required class="form-control img_review"  id="exampleInputEmail1">
                    <img id="showIMG" width="30%" src="{{URL::to('public/upload/'.$edit_product->product_img)}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                    <textarea style="resize: none" rows="10" name="content_sp" 
                    class="form-control" id="text-editor" value="{{$edit_product->product_content}}"></textarea>
                </div>
                <button type="submit" name="update_sp" class="btn btn-info">Cập nhật</button>
                <input type="reset" class="btn btn-defaul" value="Cancel">
            </form>
            </div>
        </div>
        @endforeach
    </section>
</div>

@endsection
