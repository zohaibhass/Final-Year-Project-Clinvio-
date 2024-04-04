<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Pagination\Paginator;



class DepartmentController extends Controller
{
    public function add_dept(Request $req){
        $add_dept=Department::insert([
            'Name'=>$req->dept_name,
            'Description'=>$req->dept_description
        ]);

        // return view('admin.departments',['main_departments'=>$add_dept]);
        return back()->with('success','Depatment Added Successfully');

    }
    public function ShowDepartments(){
        $show_dept = Department::select('Dept_id','Name','Description')->Simplepaginate(8);
       
        return view('admin.departments',['show_depts'=>$show_dept]);
    }

    public function get_dept(){
        $get_dept=Department::all();

        return view('admin.add_sub_department',['dropdown'=>$get_dept]);

    }

    public function delete_dept(string $id){

        $dlt_doc=Department::where('Dept_id',$id)->delete();
        return back();

    }

    public function updatedept_page(string $id){
        $updatedept_page=Department::select('Dept_id','Name','Description')->where('Dept_id','=',$id)->first();
        
        return view('admin.update_dept',['update'=>$updatedept_page]);

    }

    public function update_dept(string $id){
       
        $update_data = [
            'Name' => request('dept_name'),
            'Description' => request('dept_description'), 
        ];
    
        Department::where('Dept_id', $id)->update($update_data);
    
        return back()->with('success', 'Department updated successfully');
    }
    
}
