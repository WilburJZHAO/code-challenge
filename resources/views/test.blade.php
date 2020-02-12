@extends('layouts.app')
<?php
use App\User;
?>
@section('content')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <div style="margin-top: -22px; color: white">


        {{--Top search Picture--}}
        <div class="top-search-pic">

            <div class="div-middle">
                <span class="top-search-font">PicSky</span>
                <div>
                    <h1 style="margin-top: 16px; margin-bottom: 0; font-size: 18px">XXXX</h1>
                    <p>XXXX</p>
                </div>
                <form action="{{url('search')}}" method="post">
                    {{csrf_field()}}
                    <b-input-group size="lg">
                        <b-input-group-prepend is-text>
                            <b-icon-search></b-icon-search>
                        </b-input-group-prepend>
                        <b-form-input type="search" name="search"
                                      placeholder="Search your favorite photos"></b-form-input>
                    </b-input-group>
                </form>
                <p>aaaa</p>
            </div>

        </div>


        {{--Membership --}}
        <div style="margin-top: 1vw; width: 100%; height: 200px; background: black">
            <div class="text-center">
                <p style="font-size: 28px; color: white; padding-top: 3%; position: relative;">Membership</p>
                <p style="color: lightblue"><a href="#" style="color: lightblue">Learn more</a> > </p>
            </div>
        </div>


        {{-- Images for loop --}}
        <div style="margin-top: 1vw; width: 100%; height: auto; color: black;">
            <div style="width: 80%; margin-left: 10%">
                <b-card-group columns>
                    <?php
                    for($i = 0; $i < count($pics) - 2; $i++){
                    ?>


                    {{--b-card images includes buttons--}}
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo $i; ?>)" onmouseleave="hoverOff(<?php echo $i; ?>)"
                                    img-src="<?php echo $pics[$i][1] ?>"
                                    img-alt="Image"
                                    overlay v-b-modal.pic_<?php echo $i; ?>
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo $i; ?>" data-unsplash_id="{{$pics[$i][3]}}"
                                     data-description="{{$pics[$i][0]}}" data-url_regular="{{$pics[$i][1]}}"
                                     data-url_raw="{{$pics[$i][2]}}" data-_token="{{ csrf_token() }}"
                                     onClick="event.cancelBubble = true">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="likeImage(<?php echo $i; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $pics[$i][3])->where('user_id', $userId)->first();

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

                                    <b-button variant="outline-primary" id="b<?php echo $i; ?>"
                                              style="background: white; border: white; color: black; height: 35px"
                                              v-b-modal.m<?php echo $i; ?>>
                                        <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                    </b-button>


                                    {{--Collection popover--}}
                                    <b-modal id="m<?php echo $i; ?>" centered title="My collections" size="xl"
                                             scrollable>
                                        <div style="margin-left: 3%; margin-right: 3%">


                                                <?php
                                                $userId = auth()->user()->id;
                                                $allCollections = \App\Collection::where('user_id', $userId)->get();

                                                ?>

                                                @if (count($allCollections) != 0)
                                                        <b-card-group deck>
                                                    <?php

                                                for($z = 0;$z < count($allCollections); $z++){
                                                            if ($allCollections[$z]->image_id == null) {
                                                                $cover_url = "https://magnuskolsjo.se/wp-content/uploads/sites/2/2019/03/no-image.jpg";
                                                            } else {
                                                                $first_image_id = explode(",", $allCollections[$z]->image_id)[0];
                                                                $cover = \App\Image::where('id', $first_image_id)->first();
                                                                $cover_url = $cover->url_regular;
                                                            }

                                                ?>

                                                <div id="c<?php echo $z; ?>"
                                                     data-collection_id="{{$allCollections[$z]->id}}">
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
                                                            Some quick example text to build on the card title and make
                                                            up the bulk of the card's content.
                                                        </b-card-text>

                                                        <b-button id="btn_add_<?php echo $z; ?>" variant="primary"
                                                                  onclick="addToCollection({{$i}}, {{$z}})">Add
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
                                                                        <form onsubmit="return createCollection();">
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
                                                                                <b-button id="submit" type="submit" variant="primary">Submit</b-button>
                                                                                <b-button id="reset" type="reset" variant="danger">Reset</b-button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </template>
                                                                <template v-slot:modal-footer="{ ok, hide }">
                                                                    <b-button size="md" variant="primary" @click="ok()">
                                                                        Done
                                                                    </b-button>
                                                                </template>
                                                            </b-modal>
                                                        </div>
                                                  @endif
                                        </div>
                                        <template v-slot:modal-footer="{ ok, hide }">
                                            <div style="width: 90%"><b style="margin-left: 0px"
                                                                       id="alert_add_collection">Please select a
                                                    collection! </b></div>

                                            <b-button size="md" variant="primary" @click="ok()">
                                                Done
                                            </b-button>
                                        </template>
                                    </b-modal>


                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="downloadImage(<?php echo $i; ?>)">
                                        <b-icon icon="download" style="color: black"></b-icon>
                                    </b-button>
                                </div>
                                <div style="position: absolute; z-index: 999; visibility: hidden; left: 20px; bottom: 20px"
                                     id="d<?php echo $i; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $pics[$i][0] ?></b>
                                </div>
                            </b-card>
                        </div>


                        {{--Popover images--}}
                        <div>
                            <b-modal id="pic_<?php echo $i; ?>" centered title="BootstrapVue" size="xl" scrollable>
                                <div>
                                    <b-button variant="outline-dark"
                                              style="background:white; color: black; height: 35px"
                                              onclick="likeImage(<?php echo $i; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $pics[$i][3])->where('user_id', $userId)->first();

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

                                    <b-button variant="outline-dark" id="b<?php echo $i; ?>"
                                              style="background:white; color: black; height: 35px"
                                              v-b-modal.m<?php echo $i; ?>>
                                        <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                    </b-button>
                                    <b-button variant="outline-dark"
                                              style="background:white; color: black; height: 35px"
                                              onclick="downloadImage(<?php echo $i; ?>)">
                                        <b-icon icon="download" style="color: black"></b-icon>
                                    </b-button>
                                </div>
                                <div style="margin-top: 1vw;">
                                    <b-carousel
                                            id="carousel-fade"
                                            style="text-shadow: 0px 0px 2px #000; width: 100%; height: 100%"
                                            fade
                                            controls
                                            indicators
                                            no-wrap
                                            img-height="480"
                                            img-width="1024"
                                    >
                                        <?php
                                        for($m=$i; $m<count($pics); $m++){
                                            ?>
                                            <b-carousel-slide
                                                    style="width: 1024px; height: 480px"
                                                    caption="{{$pics[$m][0]}}"
                                                    img-src="{{$pics[$m][1]}}"
                                            ></b-carousel-slide>
                                        <?php
                                        }
                                        ?>
                                    </b-carousel>
                                </div>
                            </b-modal>
                        </div>
                    </a>
                    <?php
                    }
                    ?>


                    {{--Images without loop--}}
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($pics) - 2; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($pics) - 2; ?>)"
                                    img-src="<?php echo $pics[count($pics) - 2][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($pics) - 2; ?>"
                                     data-unsplash_id="{{$pics[count($pics) - 2][3]}}"
                                     data-description="{{$pics[count($pics) - 2][0]}}"
                                     data-url_regular="{{$pics[count($pics) - 2][1]}}"
                                     data-url_raw="{{$pics[count($pics) - 2][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="likeImage(<?php echo count($pics) - 2; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $pics[count($pics) - 2][3])->where('user_id', $userId)->first();

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
                                     id="d<?php echo count($pics) - 2; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $pics[count($pics) - 2][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>
                    <a>
                        <div id="pic">
                            <b-card
                                    onmouseover="hoverOn(<?php echo count($pics) - 1; ?>)"
                                    onmouseleave="hoverOff(<?php echo count($pics) - 1; ?>)"
                                    img-src="<?php echo $pics[count($pics) - 1][1] ?>"
                                    img-alt="Image"
                                    overlay
                            >
                                <div style="position: absolute; z-index: 999; visibility: hidden; right: 20px"
                                     id="<?php echo count($pics) - 1; ?>"
                                     data-unsplash_id="{{$pics[count($pics) - 1][3]}}"
                                     data-description="{{$pics[count($pics) - 1][0]}}"
                                     data-url_regular="{{$pics[count($pics) - 1][1]}}"
                                     data-url_raw="{{$pics[count($pics) - 1][2]}}" data-_token="{{ csrf_token() }}">
                                    <b-button variant="outline-primary"
                                              style="background: white; border: white; height: 35px"
                                              onclick="likeImage(<?php echo count($pics) - 1; ?>)">
                                        <?php
                                        $userId = auth()->user()->id;
                                        $result = \App\Image::where('unsplash_id', $pics[count($pics) - 1][3])->where('user_id', $userId)->first();

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
                                     id="d<?php echo count($pics) - 1; ?>">
                                    <b style="color: white; font-size: 15px "><?php echo $pics[count($pics) - 1][0] ?></b>
                                </div>
                            </b-card>
                        </div>
                    </a>

                </b-card-group>
            </div>
        </div>
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
<script src="{{URL::asset('/js/home.vue')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<style>
    .top-search-pic {
        width: 100%;
        height: 35vw;
        background: url(https://images.unsplash.com/photo-1543876598-5dbf85b2c12d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80) no-repeat;
        background-size: cover;
    }

    .div-middle {
        width: 60%;
        height: 25vw;
        top: 16%;
        left: 20%;
        position: absolute;
    }

    .top-search-font {
        font-size: 400%;
        font-weight: 700;
        color: white;
    }

    :first-letter {
        text-transform: capitalize;
    }

    a:hover > div {
        opacity: 50%;
    }
</style>