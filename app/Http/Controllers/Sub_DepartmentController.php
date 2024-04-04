<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub_department;

class Sub_DepartmentController extends Controller
{
     public function AddSubDept(Request $Request){
        $Add_Sub_Dept=Sub_department::insert([

            'Name'=>$Request->sub_dept_name,
            'Description'=>$Request->sub_dept_description
        ]);
        return back()->with('success', 'sub department added successfully!');
     }


  public function show_sub_dept(){

    $show_sub_dept=Sub_department::all();

      return view('admin.sub_departments',['show_sub_dept'=>$show_sub_dept]);

}
public function delete_sub_dept(string $id){

    $dlt_doc=Sub_department::where('Sub_dept_id',$id)->delete();
    return back();   
}

public function update_sub_dept_page(string $id){
    $updatesubdept_page=Sub_department::select('Sub_dept_id','Name','Description')->where('Sub_dept_id','=',$id)->first();
    
    return view('admin.update_sub_dept',['update_sub_dept_page'=>$updatesubdept_page]);

}

}

