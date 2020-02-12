<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Collection;
use Illuminate\Auth\SessionGuard;

class CollectionController extends Controller
{
    //All collect list
    public function index()
    {
        $role = auth()->role()->id;
        $collections = Collection::all();
        return view('collections')->with('allCollections', $collections)->with('id', $role);
    }

    //post.admin/collect //Add collect
    public function store(Request $request)
    {
        $reCover = Image::where('unsplash_id', '0')->first();
        if($reCover == null){
            $image = new Image([
                'description' => "0",
                'url_raw' => "0",
                'unsplash_id' => "0",
                'url_regular' => "https://magnuskolsjo.se/wp-content/uploads/sites/2/2019/03/no-image.jpg",
            ]);
            $image->save();
        }
        $reCover = Image::where('unsplash_id', '0')->first();
        $collection = new Collection([
            'c_name' => $request['c_name'],
            'c_description' => $request['c_description'],
            'user_id' => $request['user_id'],
            'image_id'=> $reCover->id,
        ]);
        $collection->save();
        return "success";

    }

    //Add collect
    public function create()
    {
        $data = Collection::where('id', 1)->get();

        return view('collectionsCreate', compact('data'));
    }

    //show collect
    public function show()
    {

    }

    //delete collect
    public function destroy(Request $request)
    {
        Collection::where('id', $request['collection_id'])->delete();
        return "success";
    }

    // update collect
    public function update(Request $request, $id)
    {
        $input = $request->except('_token', '_method');
        $re = Collection::where('id', $id)->update($input);
        if ($re) {
            return redirect('collections');
        } else {
            return back()->with('errors', 'Error');
        }
    }

    //edit collect
    public function edit($id)
    {
        $field = Collection::find($id);
        return view('collectionsEdit', compact('field'));
    }

    public function getCollectionsByUserId(Request $request)
    {
        $cols = Collection::where('user_id', $request['user_id'])->get();
            if(count($cols)!= 0){
                $reCols = Collection::where('user_id', $request['user_id'])->get();
                for($i = 0; $i< count($reCols); $i++){
                    $imgs = explode(',', $reCols[$i]->image_id);
                    if(count($imgs) == 1){
                        $reCol[$i] = Image::where('id', $imgs[0])->first()->url_regular ;
                    }else{
                        $reCol[$i] = Image::where('id', $imgs[1])->first()->url_regular ;
                    }
                }
                return [$cols, $reCol];
        }else{
            return "empty";
        }
    }

    public function deleteImages(Request $request)
    {
        $cols = Collection::where('id', $request['collection_id'])->first()->image_id;

        $imgs = explode(',', $cols);
        $c = count($imgs);
        for($i = 0; $i< $c; $i++){
            if($request['image_id'] == $imgs[$i]){
                unset($imgs[$i]);
                $imgs = array_values($imgs);
                $imgs = implode(',', $imgs);
            }
        }
        Collection::where('id', $request['collection_id'])->update(['image_id' => $imgs]);

        return "success";
    }


    public function seeCollectionDetails(Request $request)
    {
        $cols = Collection::where('id', $request['collection_id'])->first()->image_id;
        $imgs = explode(',', $cols);
        if(count($imgs) == 1){
            return "";
        }else{
            for($i = 1; $i< count($imgs); $i++){
                $reCol[$i-1] = Image::where('id', $imgs[$i])->first();
            }
            return $reCol;
        }
    }


}
