@extends('layouts.app')

@section('content')
    <div style="margin-top: -22px;" id="app">
        <div style="margin-top: 1vw; width: 100%; height: auto;">
            <div style="width: 80%; margin-left: 10%">
                <b-card-group style="width: 40%; margin-left: 0; " deck>
                    <b-card
                            style="border: 0; text-align: left;"
                    >
                        <img src="https://placekitten.com/380/200" style="width: 150px; height: 150px"/>
                    </b-card>

                    <b-card style="border: 0" title="{{auth()->user()->name}}">

                        <b-card-text>Header and footers using slots.</b-card-text>
                        <b-button variant="outline-primary">Edit profile</b-button>

                    </b-card>
                </b-card-group>
            </div>
        </div>
        <div style="width: 100%;">
            <div style="width: 80%; margin-left: 10%">
                <p style="margin-left: 10px; margin-top: 3vw; border-bottom: black">
                    <b-icon-heart-fill style="color: red"></b-icon-heart-fill>
                    <?php
                    $userId = auth()->user()->id;
                    $result = \App\Image::where('user_id', $userId)->get();
                    ?>
                    <b-link onclick="profileSwitch('like')">Like (<?php echo count($result); ?>)</b-link> &nbsp;&nbsp;&nbsp;
                    <b-icon-book style="color: black"></b-icon-book>&nbsp;<b-link onclick="profileSwitch('collection')">
                        My collections
                    </b-link>&nbsp;&nbsp;&nbsp;
                    <b-icon-search style="color: black"></b-icon-search>&nbsp;<b-link onclick="profileSwitch('search')">
                        Search more pictures
                    </b-link>
                </p>
            </div>
            <hr>
        </div>

        <div style="margin-top: 2vw; width: 100%; height: auto;">
            <div style="width: 80%; margin-left: 10%">
                <div id="imageSearch" style="display: none">
                    <b-input-group size="lg">
                        <b-input-group-prepend is-text>
                            <b-icon-search></b-icon-search>
                        </b-input-group-prepend>
                        <b-form-input type="search" placeholder="Search your favorite photos"></b-form-input>
                    </b-input-group>
                </div>


                {{--Like--}}
                <div id="like" style="display: inline">
                    <b-card-group columns>
                        <?php
                        if(!(count($result) < 2)){
                        for($i = 0; $i < count($result) - 2; $i++){
                        ?>
                        <a>
                            <div id="pic">
                                <b-card
                                        onmouseover="hoverOn(<?php echo $i; ?>)"
                                        onmouseleave="hoverOff(<?php echo $i; ?>)"
                                        img-src="<?php echo $result[$i]->url_regular ?>"
                                        img-alt="Image"
                                        overlay
                                >
                                    <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                         id="<?php echo $i; ?>" data-unsplash_id="{{$result[$i]->unsplash_id}}"
                                         data-description="{{$result[$i]->description}}"
                                         data-url_regular="{{$result[$i]->url_regular}}"
                                         data-url_raw="{{$result[$i]->url_raw}}" data-_token="{{ csrf_token() }}">
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px"
                                                  onclick="dislikeImage(<?php echo $i; ?>)">
                                            <?php
                                            $results = \App\Image::where('unsplash_id', $result[$i]->unsplash_id)->where('user_id', $userId)->first();

                                            if($results != null){
                                            ?>
                                            <b-icon icon="heart-fill" style="color: black;  display: inline"></b-icon>
                                            <b-icon icon="heart" style="color: black; display: none"></b-icon>
                                            <?php
                                            }else{
                                            ?>
                                            <b-icon icon="heart" style="color: black; display: inline"></b-icon>
                                            <b-icon icon="heart-fill" style="color: black; display: none"></b-icon>
                                            <?php
                                            }
                                            ?>

                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; color: black; height: 35px">
                                            <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px">
                                            <b-icon icon="download" style="color: black" onclick="">></b-icon>
                                        </b-button>
                                    </div>
                                    <div id="d<?php echo $i; ?>"
                                         style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px">
                                        <b style="color: white; font-size: 15px "><?php echo $result[$i]->description ?></b>
                                    </div>
                                </b-card>
                            </div>
                        </a>
                        <?php
                        }?>
                        <a>
                            <div id="pic">
                                <b-card
                                        onmouseover="hoverOn(<?php echo count($result) - 2; ?>)"
                                        onmouseleave="hoverOff(<?php echo count($result) - 2; ?>)"
                                        img-src="<?php echo $result[count($result) - 2]->url_regular ?>"
                                        img-alt="Image"
                                        overlay
                                >
                                    <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                         data-unsplash_id="{{$result[count($result) - 2]->unsplash_id}}"
                                         data-description="{{$result[count($result) - 2]->description}}"
                                         data-url_regular="{{$result[count($result) - 2]->url_regular}}"
                                         data-url_raw="{{$result[count($result) - 2]->url_raw}}"
                                         data-_token="{{ csrf_token() }}"
                                         id="<?php echo count($result) - 2; ?>">


                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px"
                                                  onclick="dislikeImage(<?php echo count($result) - 2; ?>)">
                                            <?php
                                            $results = \App\Image::where('unsplash_id', $result[count($result) - 2]->unsplash_id)->where('user_id', $userId)->first();

                                            if($results !== null){
                                            ?>
                                            <b-icon icon="heart-fill" style="color: black;  display: inline"></b-icon>
                                            <b-icon icon="heart" style="color: black; display: none"></b-icon>
                                            <?php
                                            }else{
                                            ?>
                                            <b-icon icon="heart" style="color: black; display: inline"></b-icon>
                                            <b-icon icon="heart-fill" style="color: black; display: none"></b-icon>
                                            <?php
                                            }
                                            ?>

                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; color: black; height: 35px">
                                            <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px">
                                            <b-icon icon="download" style="color: black"></b-icon>
                                        </b-button>
                                    </div>
                                    <div id="d<?php echo count($result) - 2; ?>"
                                         style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px">
                                        <b style="color: white; font-size: 15px "><?php echo $result[$i]->description ?></b>
                                    </div>
                                </b-card>
                            </div>
                        </a>


                        <a>
                            <div id="pic">
                                <b-card
                                        onmouseover="hoverOn(<?php echo count($result) - 1; ?>)"
                                        onmouseleave="hoverOff(<?php echo count($result) - 1; ?>)"
                                        img-src="<?php echo $result[count($result) - 1]->url_regular ?>"
                                        img-alt="Image"
                                        overlay
                                >
                                    <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                         data-unsplash_id="{{$result[count($result) - 1]->unsplash_id}}"
                                         data-description="{{$result[count($result) - 1]->description}}"
                                         data-url_regular="{{$result[count($result) - 1]->url_regular}}"
                                         data-url_raw="{{$result[count($result) - 1]->url_raw}}"
                                         data-_token="{{ csrf_token() }}"
                                         id="<?php echo count($result) - 1; ?>">


                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px"
                                                  onclick="dislikeImage(<?php echo count($result) - 1; ?>)">
                                            <?php
                                            $results = \App\Image::where('unsplash_id', $result[count($result) - 1]->unsplash_id)->where('user_id', $userId)->first();

                                            if($results !== null){
                                            ?>
                                            <b-icon icon="heart-fill" style="color: black;  display: inline"></b-icon>
                                            <b-icon icon="heart" style="color: black; display: none"></b-icon>
                                            <?php
                                            }else{
                                            ?>
                                            <b-icon icon="heart" style="color: black; display: inline"></b-icon>
                                            <b-icon icon="heart-fill" style="color: black; display: none"></b-icon>
                                            <?php
                                            }
                                            ?>

                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; color: black; height: 35px">
                                            <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px">
                                            <b-icon icon="download" style="color: black"></b-icon>
                                        </b-button>
                                    </div>
                                    <div id="d<?php echo count($result) - 1; ?>"
                                         style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px">
                                        <b style="color: white; font-size: 15px "><?php echo $result[$i]->description ?></b>
                                    </div>
                                </b-card>
                            </div>
                        </a>
                        <?php
                        }

                        if(count($result) == 1){
                        ?>
                        <a>
                            <div id="pic">
                                <b-card
                                        onmouseover="hoverOn(0)"
                                        onmouseleave="hoverOff(0)"
                                        img-src="<?php echo $result[0]->url_regular ?>"
                                        img-alt="Image"
                                        overlay
                                >
                                    <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                         data-unsplash_id="{{$result[0]->unsplash_id}}"
                                         data-description="{{$result[0]->description}}"
                                         data-url_regular="{{$result[0]->url_regular}}"
                                         data-url_raw="{{$result[0]->url_raw}}" data-_token="{{ csrf_token() }}"
                                         id="0">


                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px"
                                                  onclick="dislikeImage(0)">
                                            <?php
                                            $results = \App\Image::where('unsplash_id', $result[0]->unsplash_id)->where('user_id', $userId)->first();

                                            if($results !== null){
                                            ?>
                                            <b-icon icon="heart-fill" style="color: black;  display: inline"></b-icon>
                                            <b-icon icon="heart" style="color: black; display: none"></b-icon>
                                            <?php
                                            }else{
                                            ?>
                                            <b-icon icon="heart" style="color: black; display: inline"></b-icon>
                                            <b-icon icon="heart-fill" style="color: black; display: none"></b-icon>
                                            <?php
                                            }
                                            ?>

                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; color: black; height: 35px">
                                            <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                        </b-button>
                                        <b-button variant="outline-primary"
                                                  style="background: white; border: white; height: 35px">
                                            <b-icon icon="download" style="color: black"></b-icon>
                                        </b-button>
                                    </div>
                                </b-card>
                            </div>
                        </a>
                        <?php
                        }
                        if(count($result) == 0){
                        ?>
                        <div><b>You don't have any liked pictures.</b></div>
                        <?php
                        }
                        ?>


                    </b-card-group>
                </div>


                {{--Collection part--}}
                <div id="collection" style="display: none">


                    <?php
                    $userId = auth()->user()->id;
                    $allCollections = \App\Collection::where('user_id', $userId)->get();
                    ?>

                    @if(count($allCollections) != 0)

                        <b-card-group deck>
                            <?php
                            for($z = 0;$z < count($allCollections); $z++){
                            if ($allCollections[$z]->image_id == null) {
                                $cover_url = "https://magnuskolsjo.se/wp-content/uploads/sites/2/2019/03/no-image.jpg";
                            } else {
                                $first_image_id = explode(",", $allCollections[$z]->image_id)[1];
                                $cover = \App\Image::where('id', $first_image_id)->first();
                                $cover_url = $cover->url_regular;
                            }
                            ?>

                            <div id="c<?php echo $z; ?>"
                                 data-collection_id="{{$allCollections[$z]->id}}" data-_token="{{ csrf_token() }}">


                                <b-card
                                        title="{{$allCollections[$z]->c_name}}"
                                        img-src="{{$cover_url}}"
                                        img-alt="{{$allCollections[$z]->c_name}}"
                                        img-top
                                        img-height="250px"
                                        style="max-width: 20rem;"
                                        class="mb-2"
                                        footer="{{$allCollections[$z]->created_at}}"
                                >
                                    <b-card-text>
                                        {{$allCollections[$z]->c_description}}
                                    </b-card-text>


                                    {{--See detail--}}
                                    <b-button id="btn_add_<?php echo $z; ?>" variant="primary"
                                              v-b-modal.collection_detail_<?php echo $z; ?>>Details
                                    </b-button>






                                    <b-modal id="collection_detail_<?php echo $z; ?>" centered title="Details"
                                             size="xl" scrollable>
                                        <?php
                                        $c_images = $allCollections[$z]->image_id;
                                        if ($c_images == null) {
                                            echo "there is no images";
                                        } else {
                                        $explode_c_images = explode(",", $c_images);

                                        ?>
                                        <b-card-group columns>
                                            <?php
                                            for($c = 1; $c < count($explode_c_images); $c++){
                                            $reImages = \App\Image::where('id', $explode_c_images[$c])->first();?>
                                            <a>
                                                <div id="pic">
                                                    <b-card
                                                            onmouseover="hoverOnModal(<?php echo $c; ?>)"
                                                            onmouseleave="hoverOffModal(<?php echo $c; ?>)"
                                                            img-src="{{$reImages->url_regular}}"
                                                            img-alt="Image"
                                                            overlay
                                                    >
                                                        <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                                             id="detail_<?php echo $c; ?>"
                                                             data-unsplash_id="{{$reImages->unsplash_id}}"
                                                             data-description="{{$reImages->description}}"
                                                             data-url_regular="{{$reImages->url_regular}}"
                                                             data-url_raw="{{$reImages->url_raw}}"
                                                             data-_token="{{ csrf_token() }}">
                                                            <b-button variant="outline-primary"
                                                                      style="background: white; border: white; height: 35px"
                                                                      onclick="likeDetailImage(<?php echo $c; ?>)">
                                                                <?php
                                                                $userId = auth()->user()->id;
                                                                $result = \App\Image::where('unsplash_id', $reImages->unsplash_id)->where('user_id', $userId)->first();

                                                                if($result !== null){
                                                                ?>
                                                                <b-icon icon="heart-fill"
                                                                        style="color: black;  display: inline"></b-icon>
                                                                <b-icon icon="heart"
                                                                        style="color: black; display: none"></b-icon>
                                                                <?php
                                                                }else{
                                                                ?>
                                                                <b-icon icon="heart"
                                                                        style="color: black; display: inline"></b-icon>
                                                                <b-icon icon="heart-fill"
                                                                        style="color: black; display: none"></b-icon>
                                                                <?php
                                                                }
                                                                ?>

                                                            </b-button>

                                                            <b-button variant="outline-primary" id="b<?php echo $c; ?>"
                                                                      style="background: white; border: white; color: black; height: 35px"
                                                                      v-b-modal.m<?php echo $c; ?>>
                                                                <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                                            </b-button>


                                                            <b-button variant="outline-primary"
                                                                      style="background: white; border: white; height: 35px"
                                                                      onclick="downloadImage(<?php echo $c; ?>)">
                                                                <b-icon icon="download" style="color: black"></b-icon>
                                                            </b-button>
                                                        </div>
                                                        <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                                             id="d_detail_<?php echo $c; ?>">
                                                            <b style="color: white; font-size: 15px ">{{$reImages->description}}</b>
                                                        </div>
                                                    </b-card>
                                                </div>
                                            </a>
                                            <?php
                                            }

                                            ?>
                                        </b-card-group>
                                        <?php
                                        }
                                        ?>
                                    </b-modal>


                                    <b-button id="btn_add_<?php echo $z; ?>" variant="primary"
                                              onclick="deleteCollection({{$z}}, this)">Delete
                                    </b-button>
                                </b-card>


                            </div>
                            <?php
                            }
                            ?>
                        </b-card-group>

                    @else


                        <div>
                            No collections!&nbsp;&nbsp;&nbsp;
                            <b-button v-b-modal.create variant="primary">Create</b-button>
                            <b-modal id="create" centered title="Create collection">
                                <template>
                                    <div>
                                        <form onsubmit="createCollection()">
                                            <b-form-group id="input-group-1" label="Collection Name:"
                                                          label-for="input-1">
                                                <b-form-input
                                                        id="input-1"
                                                        required
                                                        placeholder="Enter name"
                                                ></b-form-input>
                                            </b-form-group>

                                            <b-form-group id="input-group-2" label="Description:"
                                                          label-for="input-2">
                                                <b-form-textarea
                                                        id="input-2"
                                                        data-_token="{{ csrf_token() }}"
                                                        placeholder="Enter description"
                                                ></b-form-textarea>
                                            </b-form-group>
                                            <div style="width: 35%;margin-left: 70%; margin-top: 2vw">
                                                <b-button type="submit" variant="primary">Submit</b-button>
                                                <b-button type="reset" variant="danger">Reset</b-button>
                                            </div>

                                        </form>
                                    </div>
                                </template>
                                <template v-slot:modal-footer="{ }">
                                    <div></div>

                                </template>
                            </b-modal>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>

    <footer style="margin-bottom: -22px">
        <hr>
        <div style="width: 80%; margin-left: 10%">
            <b-card-group>
                <b-card style="border: 0; background: transparent; color: black">
                    <b-card-text>
                        Copyright © 2020 PicSky Inc. All rights reserved.
                    </b-card-text>
                </b-card>

                <b-card style="border: 0; background: transparent; color: black">
                    <b-card-text>
                        Terms of Use | Privacy Policy | Legal | Customer Service
                    </b-card-text>
                </b-card>

                <b-card style="border: 0; background: transparent; color: black">
                    <b-card-text>
                        Developed by <b>Wilbur</b>, Powered by <b>Verto Group</b>
                    </b-card-text>
                </b-card>
            </b-card-group>
        </div>
    </footer>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{URL::asset('/js/home.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<style>
    :first-letter {
        text-transform: capitalize;
    }

    a:hover > div {
        opacity: 50%;
    }

    a:hover {
        color: #1f6fb2;
    }
</style>