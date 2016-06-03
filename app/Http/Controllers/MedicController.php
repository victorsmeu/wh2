<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;
use App\MedicData;
use App\Http\Requests;
use Auth, View, Session;

class MedicController extends Controller
{
    protected $user;
    protected $medicData;

    public function __construct(User $user, MedicData $medicData)
    {
        $this->middleware('auth');

        $this->user = $user;
        $this->medicData = $medicData;

        View::share(['menu'=> 'medics']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medics = $this->user->where('role_id', 3)->get();
        foreach($medics as $medic){
            $medic->data = $this->medicData->getDataForMedic($medic->id);
        }
        return view('medics.index', [
            'medics' => $medics
        ]);
    }

    public function editCV()
    {
        $id = Auth::user()->id;

        return view('medics.edit-cv', [
            'medicData' => $this->medicData->getDataForMedic($id),
            'user_id' => $id
        ]);
    }
    
    public function viewCV($user_id)
    {
        $medicData = $this->medicData->getDataForMedic($user_id);
        $cv = json_decode($medicData['cv_file']['info']);
        return response()->download(storage_path('uploads') . '/' . $cv->filename);
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
        $files = [
            'cv_file' => 'mimes:pdf',
            'image' => 'mimes:jpeg,png',
            'signature' => 'mimes:jpeg,png'
        ];
        
        $type = $request->type;
        if(!isset($files[$type])) {
            Session::flash('flash_error_message', 'Error with form elements');
            return redirect()->back();
        }
        
        $this->validate($request, [
            $type => $files[$type]
        ]);

        $originalName = $request->file($type)->getClientOriginalName();
        
        if($type == 'cv_file') {
            $filename = md5(microtime() . $id) . '.' . $request->file($type)->getClientOriginalExtension();
            try {
                $request->file($type)->move(storage_path('uploads'), $filename);
            } catch (Exception $ex) {
                Session::flash('flash_error_message', $ex);
            }
        } else {
            $image = $request->file($type);
            $filename = $this->resize($image, 200);
        }

        $fileInfo = ['filename' => $filename, 'originalName' => $originalName];

        $input = [
            'user_id' => $id,
            'label' => $type,
            'info' => json_encode($fileInfo)
        ];
        
        //Check if row exists then delete old resource and update with the new
        $data = $this->medicData->where('user_id', Auth::user()->id)
                                ->where('label', $type)
                                ->first();
        if ($data !== null) {
            $oldFile = json_decode($data['info']);
            if($oldFile) unlink(storage_path('uploads') . '/' . $oldFile->filename);
            $this->medicData->find($data['id'])->update($input);
        } else {
            $this->medicData->create($input);
        }
         
        Session::flash('flash_message', 'Resource added ok!');
        return redirect()->back();
    }
    
    private function resize($image, $size)
    {
        try {
            $extension = $image->getClientOriginalExtension();
            $imageRealPath = $image->getRealPath();
            $newName = md5(microtime()) . $image->getClientOriginalName();

            $img = Image::make($imageRealPath);
            $img->resize(intval($size), null, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(storage_path('uploads') . '/' . $newName);
            return $newName;
        } catch (Exception $e) {
            return false;
        }
    }

}
