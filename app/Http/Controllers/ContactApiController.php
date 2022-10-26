<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $contact = Contact::latest()->when(\request('keyword'),function ($q){
//            $keyword = \request('keyword');
//            $q->where("fname",'like',"%$keyword%")->orWhere('lname','like',"%$keyword");
//        })->paginate(3)->withQueryString();

//        $contact = Contact::all()->where('user_id',Auth::user()->id);

        $contact = Contact::where('user_id',Auth::user()->id)->when(\request('keyword'),function ($q){
            $keyword = \request('keyword');
            $q->where("fname",'like',"%$keyword%")->orWhere('lname','like',"%$keyword");
        })->paginate(3)->withQueryString();

        return response()->json($contact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->photo;

        $contact = new Contact();
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->company = $request->company;
        $contact->job = $request->job;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->birthday = $request->birthday;
        $contact->note = $request->note;
        $contact->user_id = Auth::user()->id;
//        $contact->photo = "min ga lar par";

        if($request->hasFile('photos')){

//            return "image par par tal";
            $newName = "cover_".uniqid().".".$request->file('photos')->extension();
            $request->file('photos')->storeAs("public",$newName);
            $contact->photo = $newName;

        }

        $contact->save();

        return response()->json(["success"=>200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if(is_null($contact)){
            return response()->json(["message"=>"There is no products"],404);
        }

        return response()->json([
            "product" => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->company = $request->company;
        $contact->job = $request->job;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->birthday = $request->birthday;
        $contact->note =$request->note;
        $contact->update();

        return response()->json("success",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json("soft delete par",204);
    }

    public function forceDelete($id){
        $contacts = Contact::withTrashed()->where("id",$id)->get();

        Contact::withTrashed()->where('id',$id)->forceDelete();
        foreach ($contacts as $contact ){
            if($contact->photo){
                Storage::delete('public/'.$contact->photo);
            }
        }
        return response()->json('forceDelet is OK');
    }

    public function trash(){
        $contact = Contact::onlyTrashed()->get();
        return response()->json($contact);
    }

    public function restore($id){
        $contact = Contact::withTrashed()->where('id',$id)->restore();
        return response()->json("restore is OK",200);
    }

    public function multipleDelete (Request $request) {

        $arr = json_decode( $request->checkbox,true);
        Contact::destroy($arr);
        return response()->json('multiple delete is ok' , 204);
    }

    public function export(){
        //        return Excel::download(new UsersExport, 'users.xlsx');
        return Excel::download(new UsersExport, 'users.docx',\Maatwebsite\Excel\Excel::CSV);
//        return (new UsersExport())->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function copy(\Illuminate\Http\Request $request,$id){
        $contact = Contact::find($id);
        $newContact = $contact->replicate();
        $newContact->created_at = Carbon::now();
        $newContact->lname = $newContact->lname." Copy";
        $newContact->save();
        return response()->json('Copy contact successfully',200);
    }

    public function multipleCopy(\Illuminate\Http\Request $request){
//        return [1,2];
        $lists = json_decode( $request->checkbox,true);
        $contacts = Contact::all()->whereIn('id',$lists);
//        return $contacts;
        foreach ( $contacts as $contact ){
            $newContact = $contact->replicate();
            $newContact->created_at = Carbon::now();
            $newContact->lname = $newContact->lname." Multiple Copy";
            $newContact->save();
        }
        return response()->json("Multiply Copies successful",200);
    }


}
