<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    
    public function sections(){
        $sections=Section::all();
        return view("admin.catalogue.sections",compact("sections"));
    }

    public function addUpdateSections(Request $request,$id=null){

        if(empty($id)){

            $request->validate([
                "name"=>"required|regex:/^[a-zA-Z]+$/u|max:50"
            ]);

            $section=new Section();
            $section->name=$request->name;
            $section->save();
            $message="Section Add Successfully";
        }else{

            $section=Section::find($id);

           if($request->isMethod("post")){

                $request->validate([
                    "name"=>"required|regex:/^[a-zA-Z]+$/u|max:50"
                ]);

                $section=Section::find($id);
                $section->name=$request->name;
                $section->update();
                $message="Section Updated Successfully";
           }else{
               return view("admin.catalogue.section_update",compact("section"));
           }
        }

        return redirect()->route("sectionsManagement")->with("success_message",$message);

    }

    public function delete(Request $request,$id=null){
        if(!empty($id)){
            $section=Section::find($id);
            $section->delete();
        }else{
            return "There is no section";
        }

        return redirect()->back()->with("deleted_message","Section deleted successfully");
    }

}
