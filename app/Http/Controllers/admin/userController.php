<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CommentBlog;
use App\CommentProduct;


class userController extends Controller
{
    public function listUser(){
    	$user= User::orderBy('quyen','desc')->get();
    	return view('admin.user.list',['user'=>$user]);
    }
    public function getAdd(){
    	return view('admin.user.add');
    }
    public function postAdd(Request $request){
    	//bắt lỗi, nếu ng dùng k nhập vào hoặc nhập lung tung
    	//truyền vào 2 tham số,
    	//tham số 1 là các lỗi, tham số 2 là các thông báo hiển thị ra màn hình
    	$this->validate($request,
    	[
    	//check biến có tên là name
    	//kiểm tra, yêu cầu nó phải được truyền vào và tối thiểu 2 kí tự
    		'name'=>'required|min:3|max:100',
    		'password'=>'required|min:8|max:32',
    		'passwordAgain'=>'required|same:password',
    		'email'=>'required|min:8|max:100|unique:users,email'
    	],
    	[
    		//nếu tên k điền thì truyền 1 thông báo
    		'name.required'=>'Bạn chưa nhập tên thể loại',
    		'name.min'=>'Tên người dùng ít nhất phải 3 ký tự',
    		'name.max'=>'Tên người dùng phải có độ dài dưới 100 kí tự',
    		'password.required'=>'Bạn chưa nhập password',
    		'password.min'=>'Password phải ít có ít nhất 8 kí tự',
    		'password.max'=>'Password phải có độ dài dưới 32 kí tự',
    		'passwordAgain.required'=>'Bạn chưa nhập lại password',
    		'passwordAgain.same'=>'Password nhập lại chưa khớp',
    		'email.required'=>'Bạn chưa nhập email',
    		'email.min'=>'Email phải có độ dài trên 8 kí tự',
    		'email.max'=>'Email phải có độ dài dưới 100 kí tự',
    		'email.unique'=>'Email đã tồn tại. Vui lòng chọn Email khác'
    	]);
    	//tạo đối tượng thể loại
    	$user = new User();
    	//trỏ đến tên
    	$user->name= $request->name;
    	$user->email=$request->email;
    	$user->quyen=$request->quyen;
    	$user->password= bcrypt($request->password);
    	//lưu vào csdl
    	$user->save();
    	// chuyển về trang them
    	return redirect('admin/user/add')->with('thongbao','Thêm thành công');
    }
    public function getEdit($id){
    	$user= User::find($id);
    	return view('admin.user.edit',['user'=>$user]);
    }
    public function postEdit(Request $request, $id){

    	$user= User::find($id);
    	//kiểm tra bắt lỗi xem có request truyền vào không?
    	$this->validate($request,
    	[
    	//check biến có tên là name
    	//kiểm tra, yêu cầu nó phải được truyền vào và tối thiểu 2 kí tự
    		'name'=>'required|min:3|max:100'		
    	],
    	[
    		//nếu tên k điền thì truyền 1 thông báo
    		'name.required'=>'Bạn chưa nhập tên thể loại',
    		'name.min'=>'Tên người dùng ít nhất phải 3 ký tự',
    		'name.max'=>'Tên người dùng phải có độ dài dưới 100 kí tự'
    	]);
    		//khai báo đối tượng
    	//$user = new User(); 
    	//chỉ khi thêm mới cần khai báo đối tượng mới để nó rỗng thì mới thêm được dữ liệu, còn bình thường sẽ là update
    	//trỏ đến tên
    	$user->name= $request->name;
    	$user->quyen=$request->quyen;
    	if($request->changePassword=="on")
    	{
    		$this->validate($request,
	    	[
	    	//check biến có tên là name
	    	//kiểm tra, yêu cầu nó phải được truyền vào và tối thiểu 2 kí tự
	    		'password'=>'required|min:8|max:32',
	    		'passwordAgain'=>'required|same:password'
	    	],
	    	[
	    		'password.required'=>'Bạn chưa nhập password',
	    		'password.min'=>'Password phải ít có ít nhất 8 kí tự',
	    		'password.max'=>'Password phải có độ dài dưới 32 kí tự',
	    		'passwordAgain.required'=>'Bạn chưa nhập lại password',
	    		'passwordAgain.same'=>'Password nhập lại chưa khớp'
	    	]);
    		$user->password= bcrypt($request->password);
    	}
    	
    	//lưu vào csdl
    	$user->save();
    	// chuyển về trang them
    	return redirect('admin/user/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getDelete($id)
    {
    	$user= User::find($id);
    	$commentBlog=CommentBlog::where('idUser',$id)->get();
    	$commentProduct=CommentProduct::where('idUser',$id)->get();
    	if(count($commentProduct)==0 && count($commentBlog)==0){
    		$user->delete();
    		return redirect('admin/user/list')->with('thongbao','Đã xóa thành công');
    	}
    	else
    	{
    		return redirect('admin/user/list')->with('error','Phải xóa cmt của User trước');
    	}

    }
}