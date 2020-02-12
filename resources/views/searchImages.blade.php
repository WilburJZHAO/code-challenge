@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <div style="margin-top: 0px; color: white">
        <div style="width: 100%; height: 100px;">
            <div style="width: 80%; margin-left: 10%; ">

            <template>
                <b-breadcrumb>
                    <b-breadcrumb-item href="{{url('/1')}}">
                        <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                        Home
                    </b-breadcrumb-item>
                    <b-breadcrumb-item href="#foo">Search</b-breadcrumb-item>
                    <b-breadcrumb-item active>
                        <?php if($search == ''){
                            echo "Popular images";
                        }
                        else{
                            echo "Results for \"", $search, "\"";
                        }?>

                    </b-breadcrumb-item>
                </b-breadcrumb>
            </template>

                <form action="{{url('search')}}" method="post">
                    {{csrf_field()}}
                    <b-input-group size="lg">
                        <b-input-group-prepend is-text>
                            <b-icon-search></b-icon-search>
                        </b-input-group-prepend>
                        <b-form-input type="search" name="search" value="{{$search}}" placeholder="Search your favorite photos" onclick="clearInput(event)"></b-form-input>
                    </b-input-group>
                </form>
            </div>
        </div>
        <?php
        if($allImages!=''){
            ?>
        <div style="margin-top: 2vw; width: 100%; height: auto; color: black;">
            <div style="width: 80%; margin-left: 10%">
                <b-card-group columns>
                    <?php
                    for($i = 0; $i < count($allImages) - 2; $i++){
                    ?>
                    {{--                        <a href="{{$allImages[$i][2]}}" download="{{$allImages[$i][0]}}">Download</a>--}}
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo $i; ?>)" onmouseleave="hoverOff(<?php echo $i; ?>)"
                                    img-src="<?php echo $allImages[$i][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo $i; ?>" data-unsplash_id="{{$allImages[$i][3]}}"
                                     data-description="{{$allImages[$i][0]}}" data-url_regular="{{$allImages[$i][1]}}"
                                     data-url_raw="{{$allImages[$i][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="likeImage(<?php echo $i; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allImages[$i][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo $i; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allImages[$i][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>
                    <?php
                    }
                    ?>

                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($allImages) - 2; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($allImages) - 2; ?>)"
                                    img-src="<?php echo $allImages[count($allImages) - 2][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($allImages) - 2; ?>" data-unsplash_id="{{$allImages[count($allImages) - 2][3]}}"
                                     data-description="{{$allImages[count($allImages) - 2][0]}}" data-url_regular="{{$allImages[count($allImages) - 2][1]}}"
                                     data-url_raw="{{$allImages[count($allImages) - 2][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px" onclick="likeImage(<?php echo count($allImages) - 2; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allImages[count($allImages) - 2][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo count($allImages) - 2; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allImages[count($allImages) - 2][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($allImages) - 1; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($allImages) - 1; ?>)"
                                    img-src="<?php echo $allImages[count($allImages) - 1][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($allImages) - 1; ?>" data-unsplash_id="{{$allImages[count($allImages) - 1][3]}}"
                                     data-description="{{$allImages[count($allImages) - 1][0]}}" data-url_regular="{{$allImages[count($allImages) - 1][1]}}"
                                     data-url_raw="{{$allImages[count($allImages) - 1][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"onclick="likeImage(<?php echo count($allImages) - 1; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allImages[count($allImages) - 1][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo count($allImages) - 1; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allImages[count($allImages) - 1][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>

                </b-card-group>
            </div>
        </div>
        <?php

        }else{?>
            <div style="margin-top: 1.5vw; width: 100%; height: auto; color: black;">
                <div style="width: 80%; margin-left: 10%">
                    <b-alert show variant="light" style="font-size: 18px">No results for {{$search}}. Let's try others: </b-alert>
                </div>
            </div>

        <div style="margin-top: 2vw; width: 100%; height: auto; color: black;">
            <div style="width: 80%; margin-left: 10%">
                <b-card-group columns>
                    <?php
                    for($i = 0; $i < count($allRandomImages) - 2; $i++){
                    ?>
                    {{--                        <a href="{{$allRandomImages[$i][2]}}" download="{{$allRandomImages[$i][0]}}">Download</a>--}}
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo $i; ?>)" onmouseleave="hoverOff(<?php echo $i; ?>)"
                                    img-src="<?php echo $allRandomImages[$i][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo $i; ?>" data-unsplash_id="{{$allRandomImages[$i][3]}}"
                                     data-description="{{$allRandomImages[$i][0]}}" data-url_regular="{{$allRandomImages[$i][1]}}"
                                     data-url_raw="{{$allRandomImages[$i][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="likeImage(<?php echo $i; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allRandomImages[$i][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                              style="background: white; border: white; height: 35px" onclick="downloadImage(<?php echo $i; ?>)">
                                        <b-icon icon="download" style="color: black"></b-icon>
                                    </b-button>
                                </div>
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo $i; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allRandomImages[$i][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>
                    <?php
                    }
                    ?>

                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($allRandomImages) - 2; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($allRandomImages) - 2; ?>)"
                                    img-src="<?php echo $allRandomImages[count($allRandomImages) - 2][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($allRandomImages) - 2; ?>" data-unsplash_id="{{$allRandomImages[count($allRandomImages) - 2][3]}}"
                                     data-description="{{$allRandomImages[count($allRandomImages) - 2][0]}}" data-url_regular="{{$allRandomImages[count($allRandomImages) - 2][1]}}"
                                     data-url_raw="{{$allRandomImages[count($allRandomImages) - 2][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px" onclick="likeImage(<?php echo count($allRandomImages) - 2; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allRandomImages[count($allRandomImages) - 2][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo count($allRandomImages) - 2; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allRandomImages[count($allRandomImages) - 2][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($allRandomImages) - 1; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($allRandomImages) - 1; ?>)"
                                    img-src="<?php echo $allRandomImages[count($allRandomImages) - 1][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($allRandomImages) - 1; ?>" data-unsplash_id="{{$allRandomImages[count($allRandomImages) - 1][3]}}"
                                     data-description="{{$allRandomImages[count($allRandomImages) - 1][0]}}" data-url_regular="{{$allRandomImages[count($allRandomImages) - 1][1]}}"
                                     data-url_raw="{{$allRandomImages[count($allRandomImages) - 1][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"onclick="likeImage(<?php echo count($allRandomImages) - 1; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $allRandomImages[count($allRandomImages) - 1][3])->where('user_id', $userId)->first();

                                        if($result !== null){
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
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo count($allRandomImages) - 1; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $allRandomImages[count($allRandomImages) - 1][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>

                </b-card-group>
            </div>
        </div>

       <?php }
        ?>

    </div>
    <div class="" style="margin-top: 1vw; background: black">
        <div style="width: 80%; margin-left: 10%">
            <b-card-group>
                <b-card style="border: 0; background: black; color: white">
                    <b-card-text>
                        This is a wider card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                    </b-card-text>
                </b-card>

                <b-card style="border: 0; background: black; color: white">
                    <b-card-text>
                        This card has supporting text below as a natural lead-in to additional content.
                    </b-card-text>
                </b-card>

                <b-card style="border: 0; background: black; color: white" title="Contact us">
                    <b-card-text>
                        <b-icon-phone></b-icon-phone>
                        Tel: 0414888888<br/>
                        <b-icon-envelope></b-icon-envelope>
                        Email: picskyteam@gmail.com<br/>
                        <b-icon-house></b-icon-house>
                        Address: Adelaide, SA, 5000<br/>
                    </b-card-text>
                </b-card>
            </b-card-group>
        </div>
    </div>
    <footer style="margin-bottom: -22px">
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
</style>