<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Store;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use function GuzzleHttp\Promise\all;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//           $contact = Contact::latest()->when(\request('keyword'),function ($q){
//            $keyword = \request('keyword');
//            $q->where("fname",'like',"%$keyword%")->orWhere('lname','like',"%$keyword");
//        })->paginate(3)->withQueryString();

        $contact = Contact::where('user_id',Auth::user()->id)->when(\request('keyword'),function ($q){
            $keyword = \request('keyword');
            $q->where("fname",'like',"%$keyword%")->orWhere('lname','like',"%$keyword");
        })->paginate(3)->withQueryString();

//     $contact = Contact::all()->where('user_id',Auth::user()->id);
//        dd($contact);


        return view('contact.index',compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {

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

        if($request->hasFile('photos')){
            $newName = "cover_".uniqid().".".$request->file('photos')->extension();
            $request->file('photos')->storeAs("public",$newName);
            $contact->photo = $newName;

        }

        $contact->save();

        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {

        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit')->with('contact',$contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {

        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->company = $request->company;
        $contact->job = $request->job;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->birthday = $request->birthday;
        $contact->note =$request->note;
        $contact->update();

        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contact.index');
    }

    public function multipleDeltete(\Illuminate\Http\Request $request)
    {
//        return $request;
        Contact::destroy($request->checkbox);
        return redirect()->route('contact.index');
    }



    public function export()
    {

        $export = new UsersExport([
            [14, 17, 18],

        ]);

        return Excel::download($export, 'invoices.xlsx');


//        return Excel::download(new UsersExport, 'users.xlsx');
//        $export = new UsersExport([14,17]);
//        return Excel::download(new UsersExport(), 'users.docx',\Maatwebsite\Excel\Excel::CSV);
//        return Excel::download(new UsersExport, 'users.docx',\Maatwebsite\Excel\Excel::CSV);
//        return (new UsersExport())->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }

    public function trashBin(){
        $contact = Contact::onlyTrashed()->get();
        return view('contact.trash',compact(['contact']));
    }

    public function forceDelete( $id){
        $contacts = Contact::withTrashed()->where("id",$id)->get();

        Contact::withTrashed()->where('id',$id)->forceDelete();
        foreach ($contacts as $contact ){
            if($contact->photo){
                Storage::delete('public/'.$contact->photo);
            }
        }
        return redirect()->route('contact.trash');
    }

    public function restore($id){
        $contact = Contact::withTrashed()->where('id',$id)->restore();
        return redirect()->route('contact.trash');

    }

    public function copy(\Illuminate\Http\Request $request,$id){
//        return $id;
        $contact = Contact::find($id);
//        return $contact;
        $newContact = $contact->replicate();
        $newContact->created_at = Carbon::now();
        $newContact->lname = $newContact->lname." Copy";
//        return $newContact;
        $newContact->save();
        return redirect()->route('contact.index');
    }

    public function multipleCopy(\Illuminate\Http\Request $request){
//        return ["copy message"=>$request->checkbox];
        $contacts = Contact::all()->whereIn('id',$request->checkbox);
        foreach ( $contacts as $contact ){
            $newContact = $contact->replicate();
            $newContact->created_at = Carbon::now();
            $newContact->lname = $newContact->lname." Multiple Copy";
            $newContact->save();
        }
        return redirect()->route('contact.index');
    }

//


}
