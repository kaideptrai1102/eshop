{{-- kế thừa thuộc tính,vv trang index --}}
@extends('admin.layouts.index')
{{-- câu lệnh để nhúng --}}
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment Product
                            <small>Add Comment</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    {{-- kiểm tra xem có tồn tại lỗi không rồi in ra --}}
                        @if(count($errors) > 0 )
                            <div class="alert alert-danger">
                                {{-- gọi đến tất cả các lỗi có thể xảy ra --}}
                                @foreach ($errors->all() as $loi)
                                    {!! $loi !!}<br>
                                @endforeach
                            </div>
                        @endif

                        {{-- kiểm tra xem có nhận đc session thông báo lúc redirect lại không --}}
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {!! session('thongbao') !!}
                            </div>
                        @endif
                        
                        <form action="{{ url('admin/comment-product/add') }}" method="POST">
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control" name="User">
                                @foreach ($user as $ur)
                                    <option @if(old('User')==$ur->id) {!! "selected" !!} @endif value="{!! $ur->id !!}">{!! $ur->name !!}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product</label>
                                <select class="form-control" name="Product">
                                @foreach ($product as $pro)
                                    <option @if(old('Product')==$pro->id) {!! "selected" !!} @endif value="{!! $pro->id !!}">{!! $pro->ten !!}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea id="demo" class="form-control ckeditor" name="NoiDung">{!! old('NoiDung') !!}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                             {{-- KHÔNG BAO GIỜ ĐƯỢC THIẾU TOKEN --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection