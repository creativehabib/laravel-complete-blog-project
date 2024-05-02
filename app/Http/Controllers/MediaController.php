<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media_datalist = Media::orderBy('id','desc')->paginate(5);
        return view('media.index',compact('media_datalist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        $destinationPath = public_path('media');
        $dateTime = date('dmYHis');

        $thumbnail = $request['media_type'];

        $file = $request->file('FileName');

        //Display File Name
        $FileName = $dateTime.'-'.$file->getClientOriginalName();
//        $ThumFileName = $dateTime.'-'.'-'.$file->getClientOriginalName();
        //$FileName = $file->getClientOriginalName();

        //get file extension
        $FileExt = $file->getClientOriginalExtension();

        //Convert uppercase to lowercase
        $FileType = Str::lower($FileExt);

        //Display File Real Path
        $FileRealPath = $file->getRealPath();

        //Display File Size
        $FileSize = $file->getSize();

        //Original file name
        $OriginalFileName = basename($file->getClientOriginalName(), ".".$FileExt);

        //Display File Mime Type
        $FileMimeType = $file->getMimeType();

        if (getFileType(Str::lower($FileExt)) != null) {
            $FileType = getFileType(Str::lower($FileExt));
        } else {
            $FileType = "unknown";
        }

        if (file_exists(public_path('media/'.$FileName))) {
            unlink(public_path('media/'.$FileName));
        }
        $msgList = array();
        if($file->move($destinationPath, $FileName)) {

            $data = array(
                'media_title' => $OriginalFileName,
                'media_alt' => $OriginalFileName,
                'media_file' => $FileName,
                'media_size' => $FileSize,
                'media_type' => $FileType,
                'media_extension' => $FileExt,
            );

            $response = Media::create($data)->id;

            if($response){
                $msgList["msgType"] = 'success';
            }else{
                $msgList['msgType'] = 'error';
            }
        }
        return response()->json($msgList);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMediaById(Request $request): JsonResponse
    {
        $data = Media::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function mediaUpdate(Request $request)
    {
        $res = array();

        $id = $request->input('RecordId');
        $title = $request->input('title');
        $alt_title = $request->input('alternative_text');

        $data = array(
            'media_title' => $title,
            'media_alt' => $alt_title
        );

        $response = Media::where('id', $id)->update($data);
        if($response){
            $res['msgType'] = 'success';
            $res['msg'] = __('Data Updated Successfully');
        }else{
            $res['msgType'] = 'error';
            $res['msg'] = __('Data update failed');
        }

        return response()->json($res);
    }

    public function onMediaDelete(Request $request)
    {
        $res = array();

        $id = $request->id;

        if($id != ''){

            $datalist = Media::where('id', $id)->first();
            $thumbnail = $datalist['media_file'];

            if (file_exists(public_path('media/'.$thumbnail))) {
                unlink(public_path('media/'.$thumbnail));
            }

            $response = Media::where('id', $id)->delete();
            if($response){
                $res['msgType'] = 'success';
                $res['msg'] = __('Data Removed Successfully');
            }else{
                $res['msgType'] = 'error';
                $res['msg'] = __('Data remove failed');
            }
        }

        return response()->json($res);
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        return response()->json($media);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
