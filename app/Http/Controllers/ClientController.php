<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientPhoto;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->get();
        return view('backend.pages.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.client.client_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $filePdf = $request->file('file_pdf');
        $filePdfName = time().'.'.$filePdf->extension();
        $filePdf->move(public_path('images'),$filePdfName);
    

        $client = Client::create([
            'name' => $request->client_name,
            'profile_image' => "",
            'file_pdf' => $filePdfName
        ]);

    
        //insert multiple photo
        $images = $request->images;
        if (!empty($images)) {
            $index = 1;
            foreach($images as $image) {
                if($index == 1){
                    Client::findOrFail($client->id)->update([
                        'profile_image' => $image
                    ]);
                }
              
                ClientPhoto::insert([
                    'client_id' => $client->id,
                    'image' => $image
                ]);
                $index++;
            }
        }

        $notification = array(
            'message' => 'Client Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.client')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Client::findOrFail($id);
        return view('backend.pages.client.client_edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = $request->id;

        Client::findOrFail($id)->update([
            'name' => $request->name,
            'profile_image' => $request->profile_image,
            'file_pdf' => $request->file_pdf
        ]);


         $notification = array(
            'message' => 'Client Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('all.client')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $client =  Client::findOrFail($id);
        $photoClients = ClientPhoto::where('client_id', $client->id)->get();

        foreach($photoClients as $photoClient){
            $img = $photoClient->image;
            if(!empty($img)) unlink(public_path('images/'.$img));
            $photoClient->delete();
        }
        
        $file_pdf = $client->file_pdf;
        if(!empty($img)) unlink(public_path('images/'.$file_pdf));
        $client->delete();

        $notification = array(
           'message' => 'Client Deleted Successfully',
           'alert-type' => 'success'

       );

       return redirect()->back()->with($notification);

    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
    
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);
        
    
        return response()->json(['success'=>$imageName]);
    }
}
