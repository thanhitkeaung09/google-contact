<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Contact;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        foreach ($stores as $store){
//            echo $store;
            if($store->receiver === Auth::user()->email){
                $contacts = Contact::find($store->contact_id);
//                echo $store->contact_id;
//                $ids = $store->contact_id;
//                echo json_decode($ids,true);

//                $contacts = Contact::all()->whereIn('id',[3,7]);
//
                return view('store.index',compact(['contacts','store']));
            }

        }
        return view('store.diff');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
//        return $request;
        $store = new Store();
        $store->sender = Auth::user()->email;
        $store->receiver = $request->receiverEmail;
        $store->contact_id = $request->contact_id;
        $store->save();
        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
