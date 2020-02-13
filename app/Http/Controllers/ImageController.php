<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Image;
use App\Like;
use App\Collection;
use App\Utilities\Unplash;
use Symfony\Component\Console\Input\Input;

class ImageController extends Controller
{

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $re = Image::create($input);
        if ($re) {
            return back()->with('errors', 'Error');
        } else {

        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_token', '_method');
        $re = Image::where('id', $id)->update($input);
        if ($re) {
            return redirect('image');
        } else {
            return back()->with('errors', 'Error');
        }
    }

    public function likeImage(Request $request)
    {
        $imageResult = Image::where('unsplash_id', $request['unsplash_id'])->first();
        if ($imageResult == null) {
            $image = new Image([
                'description' => $request['description'],
                'url_raw' => $request['url_raw'],
                'url_regular' => $request['url_regular'],
                'unsplash_id' => $request['unsplash_id']]);
            $image->save();
        }
        $imageRe = Image::where('unsplash_id', $request['unsplash_id'])->first();
        $likeResult = Like::where('image_id', $imageRe->id)->where('user_id', $request['user_id'])->first();
        if ($likeResult == null) {
            $like = new Like([
                'user_id' => $request['user_id'],
                'image_id' => $imageRe->id,
            ]);
            $like->save();
            return 'like';
        } else {
            $likeResult->delete();
            return 'dislike';
        }
    }

    public function addImage(Request $request)
    {

            $result = Image::where('unsplash_id', $request['unsplash_id'])->first();
            if ($result == null) {
                $image = new Image([
                    'description' => $request['description'],
                    'url_raw' => $request['url_raw'],
                    'url_regular' => $request['url_regular'],
                    'unsplash_id' => $request['unsplash_id'],
                ]);
                $image->save();
                return Image::where('unsplash_id', $request['unsplash_id'])->first()->id;
            } else {
                return $result->id;
            }

    }

    public function addToCollection(Request $request)
    {
            $r = false;
            $result = Collection::where('id', $request['collection_id'])->first();
            $re = explode(',', $result->image_id);
            for ($i = 0; $i < count($re); $i++) {
                if ($re[$i] == $request['image_id']) {
                    $r = true;
                    break;
                }
            }
            if ($r) {
                return "exist";
            } else {
                $image_id = $result->image_id . ',' . $request['image_id'];
                Collection::where('id', $request['collection_id'])->update(['image_id' => $image_id]);
                return "success";
            }
    }

    public function searchImage(Request $request)
    {
        $search = $request['searchName'];
        $result = Unplash::getImages($search);
        if ($result == '') {
            $resultRandom = Unplash::getRandomImages();
            return [$resultRandom, 0];
        } else {
            return [$result, 1];
        }
    }

    public function randomImage()
    {
        $result = Unplash::getRandomImages();
        return view('searchImages')->with('allImages', $result)->with('search', "");
    }

    public function randomImage1()
    {
        $result = Unplash::getRandomImages();
        return $result;
    }

    public function getUserLikes(Request $request)
    {
        $user_id = $request['user_id'];
        $result = Image::whereIn('id', Like::where('user_id', $user_id)->get('image_id'))->get();
        return $result;
    }


}
