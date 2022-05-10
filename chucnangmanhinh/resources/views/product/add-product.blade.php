@extends('index')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm Sản Phẩm
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
                <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                    <input type="text" name="name_sp" class="form-control" 
                     id="exampleInputEmail1" placeholder="Tên danh mục"
                     data-validation='length' data-validation-length='min5' data-validation-error-msg="Tên sản phẩm ít nhất 5 ký tự">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                    <input type="number" name="price_sp" class="form-control"
                     id="exampleInputEmail1" placeholder="giá sản phẩm"
                     data-validation='length' data-validation-length='min1' data-validation-error-msg="Giá sản phẩm phải hơn 1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh Sản Phẩm</label>
                    <input type="file" name="img_sp" id="img_sp" onchange="reviewIMG(this);" required class="form-control img_review"  id="exampleInputEmail1" >
                    <img id="showIMG" width="30%" src="{{'public/img/no-image.png'}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                    <textarea style="resize: none" rows="10" name="content_sp" 
                    class="form-control" id="text-editor" placeholder="Mô tả danh mục"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Hiển thị</label>
                    <select name="status_sp" class="form-control m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                <button type="submit" name="save_sp" class="btn btn-info">Thêm Sản Phẩm</button>
                <input type="reset" class="btn btn-defaul" value="Cancel">
            </form>
            </div>
        </div>
    </section>
</div>

@endsection
