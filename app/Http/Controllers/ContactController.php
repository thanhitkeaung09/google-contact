<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use http\Env\Request;
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
        $contact = Contact::all();
//        return $contact;
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

//        return $contact;
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
//        $contact->delete();
        return redirect()->route('contact.index');
    }

    public function multipleDeltete(\Illuminate\Http\Request $request)
    {
        Contact::destroy($request->checkbox);
        return redirect()->route('contact.index');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
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
//        return $id;
        $contact = Contact::withTrashed()->where('id',$id)->restore();
        return redirect()->route('contact.trash');

    }


}
