<template>
    <div style="margin-top: -22px; color: white">


        <div class="top-search-pic">

            <div class="div-middle">
                <span style="margin-top: 3.5vw;" class="top-search-font">PicSky</span>
                <div>
                    <h1 style="margin-top: 2.5vw; margin-bottom: 0; font-size: 25px">A powerful pictures searching
                        engine</h1>
                    <p></p>
                    <p>PicSky provides high quality and completely free stock photos.</p>
                </div>
                <b-button href="search" id="searchBotton" @mouseover="onHover()" @mouseleave="offHover()" variant="outline-secondary" size="lg" style="width: 60%; color: white; background: rgba(250,243,255,0.4);">Start Searching Wonderful Universe</b-button>
                <p></p>
                <p>Trending: flower, wallpapers, backgrounds, happy, love</p>
            </div>

        </div>


        <div style="margin-top: 1vw; width: 100%; height: 200px; background: black">
            <div class="text-center">
                <p style="font-size: 28px; color: white; padding-top: 3%; position: relative;">Membership</p>
                <p style="color: lightblue"><a href="#" style="color: lightblue">Learn more</a> > </p>
            </div>
        </div>

        <div style="width: 80%; margin-left: 10%">
            <div style="margin-top: 0px; color: white" v-if="pictures!=1 && likes!=1 && isLikes != []">
                <div style="margin-top: 2vw; width: 100%; height: auto; color: black;">
                    <div>
                        <b-card-group columns>
                            <a v-for="i in pictures.length" :key="i">
                                <div>
                                    <b-card
                                            @mouseover="hoverOn(i)" @mouseleave="hoverOff(i)"
                                            :img-src="pictures[i-1][1]"
                                            img-alt="Image"
                                            overlay v-b-modal="'pic_' + i"
                                    >
                                        <div
                                                :id="'image' + i"
                                                style="position: absolute; z-index: 999; right: 20px; visibility: hidden"
                                                :data-unsplash_id="pictures[i-1][3]"
                                                :data-description="pictures[i-1][0]"
                                                :data-url_regular="pictures[i-1][1]"
                                                :data-url_raw="pictures[i-1][2]"
                                                onClick="event.cancelBubble = true">
                                            <b-button variant="outline-primary"
                                                      style="background: white; border: white; height: 35px"
                                                      @click="likeImage('image' + i)">
                                                <b-icon :id="'likeimage' + i" icon="heart-fill"
                                                        style="color: black;"
                                                        :style="{display : isLikes[i] ? 'inline' : 'none'}"></b-icon>
                                                <b-icon :id="'dislikeimage' + i" icon="heart" style="color: black;"
                                                        :style="{display : !isLikes[i] ? 'inline' : 'none'}"></b-icon>


                                            </b-button>

                                            <b-button variant="outline-primary"
                                                      style="background: white; border: white; color: black; height: 35px"
                                                      @click="getAllCollections()" v-b-modal="'m'+ i">
                                                <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect
                                            </b-button>


                                            <b-modal :id="'m' + i" centered title="My collections" size="xl" scrollable>
                                                <div v-if="!isColEmpty" style="margin-left: 3%; margin-right: 3%">
                                                    <b-card-group deck>
                                                        <div :id="'colImages' + img"
                                                             v-for="img in collections.length" :key="'col' + img"

                                                             :data-collection_id="collections[img-1].id">
                                                            <b-card
                                                                    :title="collections[img-1].c_name"
                                                                    :img-src="colCoverImgs[img-1]"
                                                                    :img-alt="collections[img-1].c_name"
                                                                    img-top
                                                                    img-height="250px"
                                                                    style="max-width: 20rem;"
                                                                    class="mb-2"
                                                                    :footer="collections[img-1].created_at"
                                                            >
                                                                <b-card-text>
                                                                    {{collections[img-1].c_description}}
                                                                </b-card-text>

                                                                <b-button :id="'btn_add_' + img" variant="primary"
                                                                          @click="addToCollection(i, img)">Add
                                                                </b-button>
                                                                <b-button :id="'btn_details_' + img" variant="primary"
                                                                          v-b-modal="'collection_detail_' + img"
                                                                          @click="seeDetails(img)">Details
                                                                </b-button>

                                                                <b-modal :id="'collection_detail_' + img" centered
                                                                         title="Details"
                                                                         size="xl" scrollable>

                                                                    <div v-if="c_imgs != 1">
                                                                        <b-card-group v-if="!isColImgEmpty" columns>
                                                                            <a v-for="c_img in c_imgs.length"
                                                                               :key="c_img">
                                                                                <div>
                                                                                    <b-card
                                                                                            @mouseover="collectionHoverOn(c_img)"
                                                                                            @mouseleave="collectionHoverOff(c_img)"
                                                                                            :img-src="c_imgs[c_img-1].url_regular"
                                                                                            img-alt="Image"
                                                                                            overlay
                                                                                            v-b-modal="'like_pic_' + c_img"
                                                                                    >
                                                                                        <div
                                                                                                :id="'c_image' + c_img"
                                                                                                style="position: absolute; z-index: 999; right: 20px; visibility: hidden"
                                                                                                :data-unsplash_id="c_imgs[c_img-1].unsplash_id"
                                                                                                :data-description="c_imgs[c_img-1].description"
                                                                                                :data-url_regular="c_imgs[c_img-1].url_regular"
                                                                                                :data-url_raw="c_imgs[c_img-1].url_raw"
                                                                                                onClick="event.cancelBubble = true">
                                                                                            <b-button
                                                                                                    variant="outline-primary"
                                                                                                    style="background: white; border: white; height: 35px"
                                                                                                    @click="likeImage('c_image' + c_img)">
                                                                                                <b-icon :id="'likec_image' + c_img"
                                                                                                        icon="heart-fill"
                                                                                                        style="color: black; display: none"></b-icon>
                                                                                                <b-icon :id="'dislikec_image' + c_img"
                                                                                                        icon="heart"
                                                                                                        style="color: black; display: inline"></b-icon>
                                                                                            </b-button>
                                                                                            <b-button
                                                                                                    variant="outline-primary"
                                                                                                    style="background: white; border: white; height: 35px">
                                                                                                <b-icon icon="download"
                                                                                                        style="color: black"
                                                                                                        @click="downloadWithAxios(c_imgs[c_img-1].url_raw)"></b-icon>
                                                                                            </b-button>
                                                                                            <b-button
                                                                                                    variant="outline-primary"
                                                                                                    style="background: white; border: white; color: black; height: 35px"
                                                                                                    @click="deleteImages(c_img, img)">
                                                                                                <b-icon icon="x"
                                                                                                        style="color: black"></b-icon>&nbsp;Delete
                                                                                            </b-button>
                                                                                        </div>
                                                                                        <div style="position: absolute; z-index: 999; left: 20px; bottom: 20px; visibility: hidden"
                                                                                             :id="'c_des' + c_img">
                                                                                            <b style="color: white; font-size: 15px ">{{c_imgs[c_img-1].description}}</b>
                                                                                        </div>
                                                                                    </b-card>
                                                                                </div>

                                                                                <div>
                                                                                    <b-modal :id="'like_pic_' + c_img"
                                                                                             centered title="" size="xl"
                                                                                             scrollable>
                                                                                        <!--                                    <div>-->
                                                                                        <!--                                        <b-button variant="outline-dark"-->
                                                                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                                                                        <!--                                                  @click="likeImage('image' + i)">-->
                                                                                        <!--                                            <b-icon :id="'likeimage' + i" icon="heart-fill"-->
                                                                                        <!--                                                    style="color: black;"-->
                                                                                        <!--                                                    :style="{display : isLikes[i] ? 'inline' : 'none'}"></b-icon>-->
                                                                                        <!--                                            <b-icon :id="'dislikeimage' + i" icon="heart" style="color: black;"-->
                                                                                        <!--                                                    :style="{display : !isLikes[i] ? 'inline' : 'none'}"></b-icon>-->
                                                                                        <!--                                        </b-button>-->

                                                                                        <!--                                        <b-button variant="outline-dark" :id="'b'+ i"-->
                                                                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                                                                        <!--                                                  v-b-modal="'m' + i">-->
                                                                                        <!--                                        <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect-->
                                                                                        <!--                                        </b-button>-->
                                                                                        <!--                                        <b-button variant="outline-dark"-->
                                                                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                                                                        <!--                                                  onclick="downloadImage('image' + i)">-->
                                                                                        <!--                                            <b-icon icon="download" style="color: black"></b-icon>-->
                                                                                        <!--                                        </b-button>-->
                                                                                        <!--                                    </div>-->
                                                                                        <div style="margin-top: 1vw;">
                                                                                            <b-carousel
                                                                                                    id="carousel-fade"
                                                                                                    style="text-shadow: 0px 0px 2px #000;"
                                                                                                    fade
                                                                                                    controls
                                                                                                    indicators
                                                                                                    no-wrap
                                                                                                    img-height="480"
                                                                                                    img-width="1024"
                                                                                            >
                                                                                                <b-carousel-slide
                                                                                                        :caption="c_imgs[c_img-1].description"
                                                                                                        :img-src="c_imgs[c_img-1].url_regular"
                                                                                                ></b-carousel-slide>

                                                                                            </b-carousel>
                                                                                        </div>
                                                                                    </b-modal>
                                                                                </div>
                                                                            </a>

                                                                        </b-card-group>
                                                                        <div v-if="isColImgEmpty">
                                                                            <h3>No pictures in this collection!</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div v-else>No images in this collection. Go to <a href="search">search page</a> to add.</div>
                                                                    <div class="text-center" v-else>
                                                                        <b-spinner label="Spinning"></b-spinner>
                                                                        <b-spinner type="grow"
                                                                                   label="Spinning"></b-spinner>
                                                                        <b-spinner variant="primary"
                                                                                   label="Spinning"></b-spinner>
                                                                        <b-spinner variant="primary" type="grow"
                                                                                   label="Spinning"></b-spinner>
                                                                        <b-spinner variant="success"
                                                                                   label="Spinning"></b-spinner>
                                                                        <b-spinner variant="success" type="grow"
                                                                                   label="Spinning"></b-spinner>
                                                                    </div>
                                                                </b-modal>

                                                                <b-button :id="'btn_delete_' + img" variant="primary"
                                                                          @click="deleteCollection(img)">Delete
                                                                </b-button>
                                                            </b-card>
                                                        </div>
                                                    </b-card-group>
                                                </div>
                                                <div v-if="isColEmpty">
                                                    <h3>No collections!</h3>&nbsp;&nbsp;&nbsp;
                                                </div>

                                                <template v-slot:modal-footer="{ ok, hide }">
                                                    <b-button v-b-modal.create variant="primary">Create</b-button>
                                                    <b-modal id="create" centered title="Create collection">
                                                        <template>
                                                            <div>
                                                                <form @submit.prevent="createCollection(i)">
                                                                    <b-form-group id="input-group-1"
                                                                                  label="Collection Name:"
                                                                                  label-for="input-1">
                                                                        <b-form-input id="input-1" required
                                                                                      placeholder="Enter name"
                                                                                      v-model="colName"></b-form-input>
                                                                    </b-form-group>
                                                                    <b-form-group id="input-group-2"
                                                                                  label="Description:"
                                                                                  label-for="input-2">
                                                                        <b-form-textarea
                                                                                id="input-2"
                                                                                placeholder="Enter description"
                                                                                v-model="colDescription"
                                                                        ></b-form-textarea>
                                                                    </b-form-group>
                                                                    <div style="width: 35%;margin-left: 70%; margin-top: 2vw">
                                                                        <b-button id="submit" type="submit"
                                                                                  variant="primary">Submit
                                                                        </b-button>
                                                                        <b-button id="reset" type="reset"
                                                                                  variant="danger">
                                                                            Reset
                                                                        </b-button>
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
                                                    <b-button size="md" variant="primary" @click="ok()">
                                                        Done
                                                    </b-button>
                                                </template>
                                            </b-modal>
                                            <b-button variant="outline-primary"
                                                      style="background: white; border: white; height: 35px">
                                                <b-icon icon="download" style="color: black"
                                                        @click="downloadWithAxios(pictures[i-1][2])"></b-icon>
                                            </b-button>
                                        </div>
                                        <div style="position: absolute; z-index: 999; left: 20px; bottom: 20px; visibility: hidden"
                                             :id="'des' + i">
                                            <b style="color: white; font-size: 15px ">{{pictures[i-1][0]}}</b>
                                        </div>
                                    </b-card>
                                </div>

                                <div>
                                    <b-modal :id="'pic_' + i" centered title="" size="xl" scrollable>
                                        <!--                                    <div>-->
                                        <!--                                        <b-button variant="outline-dark"-->
                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                        <!--                                                  @click="likeImage('image' + i)">-->
                                        <!--                                            <b-icon :id="'likeimage' + i" icon="heart-fill"-->
                                        <!--                                                    style="color: black;"-->
                                        <!--                                                    :style="{display : isLikes[i] ? 'inline' : 'none'}"></b-icon>-->
                                        <!--                                            <b-icon :id="'dislikeimage' + i" icon="heart" style="color: black;"-->
                                        <!--                                                    :style="{display : !isLikes[i] ? 'inline' : 'none'}"></b-icon>-->
                                        <!--                                        </b-button>-->

                                        <!--                                        <b-button variant="outline-dark" :id="'b'+ i"-->
                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                        <!--                                                  v-b-modal="'m' + i">-->
                                        <!--                                        <b-icon icon="plus" style="color: black"></b-icon>&nbsp;Collect-->
                                        <!--                                        </b-button>-->
                                        <!--                                        <b-button variant="outline-dark"-->
                                        <!--                                                  style="background:white; color: black; height: 35px"-->
                                        <!--                                                  onclick="downloadImage('image' + i)">-->
                                        <!--                                            <b-icon icon="download" style="color: black"></b-icon>-->
                                        <!--                                        </b-button>-->
                                        <!--                                    </div>-->
                                        <div style="margin-top: 1vw;">
                                            <b-carousel
                                                    id="carousel-fade"
                                                    style="text-shadow: 0px 0px 2px #000;"
                                                    fade
                                                    controls
                                                    indicators
                                                    no-wrap
                                                    img-height="480"
                                                    img-width="1024"
                                            >
                                                <b-carousel-slide
                                                        :caption="pictures[i-1][0]"
                                                        :img-src="pictures[i-1][1]"
                                                ></b-carousel-slide>

                                            </b-carousel>
                                        </div>
                                    </b-modal>
                                </div>


                            </a>

                        </b-card-group>
                    </div>
                </div>

            </div>
            <div class="text-center" v-else>
                <b-spinner label="Spinning"></b-spinner>
                <b-spinner type="grow" label="Spinning"></b-spinner>
                <b-spinner variant="primary" label="Spinning"></b-spinner>
                <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
                <b-spinner variant="success" label="Spinning"></b-spinner>
                <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
            </div>
        </div>
        <div class="" style="margin-top: 1vw; background: black">
            <div style="width: 80%; margin-left: 10%">
                <b-card-group>
                    <b-card style="border: 0; background: black; color: white">
                        <b-card-text>
                            PicSky provides high quality and completely free stock photos. All photos are easy to
                            discover through our discover pages.
                        </b-card-text>
                    </b-card>

                    <b-card style="border: 0; background: black; color: white">
                        <b-card-text>
                            By providing free stock photos PicSky helps people all over the world to create beautiful
                            products and designs easily.
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pictures: '',
                collections: [],
                likes: '',
                isLikes: [],
                isCILikes: [],
                searchName: '',
                results: 1,
                counts: 0,
                userId: '',
                isColEmpty: '',
                colName: '',
                colDescription: '',
                colCoverImgs: [],
                c_imgs: [],
                isColImgEmpty: '',
                isAdd: [],
            }
        },
        created() {
            this.start();
            this.fetchRandomImages();
            this.getUserLikes();
        },
        computed: {
            isLoaded: function () {
                return this.pictures + ' ' + this.likes;
            }
        },

        watch: {
            isLoaded: function (val) {
                if (val != '1 1') {
                    setTimeout(this.isLike(), 2000);
                }
            }
        },

        methods: {
            start() {
                for (let i = 0; i <= 30; i++) {
                    this.isLikes[i] = false;
                }
            },

            // searchImage() {
            //     this.pictures = 1;
            //     var vm = this;
            //     let data = {"searchName": this.searchName};
            //     axios.post('api/searchImages', data);
            // },

            isLike() {
                this.userId = document.getElementById('searchTag').dataset.user_id;
                if (this.userId != "") {
                    for (let i = 0; i < this.pictures.length; i++) {
                        var check = false;
                        for (let j = 0; j < this.likes.length; j++) {
                            if (this.likes[j].unsplash_id == this.pictures[i][3]) {
                                check = true;
                                break;
                            }
                        }
                        if (check) {
                            this.isLikes[i + 1] = true;
                        } else {
                            this.isLikes[i + 1] = false;
                        }
                    }
                }
            },

            isCollectionImageLike() {
                this.userId = document.getElementById('searchTag').dataset.user_id;
                if (this.userId != "") {
                    for (let i = 0; i < this.c_imgs.length; i++) {
                        var check = false;
                        for (let j = 0; j < this.likes.length; j++) {
                            if (this.likes[j].unsplash_id == this.c_imgs[i][3]) {
                                check = true;
                                break;
                            }
                        }
                        if (check) {
                            this.isCILikes[i + 1] = true;
                        } else {
                            this.isCILikes[i + 1] = false;
                        }
                    }
                }
            },

            getUserLikes() {
                this.likes = 1;
                var vm = this;
                this.userId = document.getElementById('searchTag').dataset.user_id;
                if (this.userId != "") {
                    let data = {
                        "user_id": this.userId
                    };
                    axios.post('/getUserLikes', data)
                        .then(function (response) {
                            vm.likes = response.data;
                        }).catch(function (error) {
                        alert(error);
                    });
                } else {
                    this.likes = "";
                }
            },

            fetchRandomImages() {
                this.pictures = 1;
                var vm = this;
                axios.get('/aaa')
                    .then(function (response) {
                        vm.pictures = response.data;
                    }).catch(function (error) {
                    alert("Random Image"+error);
                });
            }
            ,
            hoverOn(index) {
                var img_idx = "image" + index;
                var des_idx = "des" + index;
                document.getElementById(img_idx).style.visibility = "visible";
                document.getElementById(des_idx).style.visibility = "visible";
            },

            hoverOff(index) {
                var img_idx = "image" + index;
                var des_idx = "des" + index;
                document.getElementById(img_idx).style.visibility = "hidden";
                document.getElementById(des_idx).style.visibility = "hidden";
            },

            collectionHoverOn(index) {
                var img_idx = "c_image" + index;
                var des_idx = "c_des" + index;
                document.getElementById(img_idx).style.visibility = "visible";
                document.getElementById(des_idx).style.visibility = "visible";
            }
            ,

            onHover(){
                document.getElementById('searchBotton').style.backgroundColor = "rgba(250,243,255,0.6)";
            },

            offHover(){
                document.getElementById('searchBotton').style.backgroundColor = "rgba(250,243,255,0.4)";
            },

            collectionHoverOff(index) {
                var img_idx = "c_image" + index;
                var des_idx = "c_des" + index;
                document.getElementById(img_idx).style.visibility = "hidden";
                document.getElementById(des_idx).style.visibility = "hidden";
            }
            ,

            likeImage(index) {
                this.userId = document.getElementById('searchTag').dataset.user_id;
                if (this.userId == "") {
                    window.location.href = '/login';
                } else {

                    var description = document.getElementById(index).dataset.description;
                    var url_raw = document.getElementById(index).dataset.url_raw;
                    var url_regular = document.getElementById(index).dataset.url_regular;
                    var unsplash_id = document.getElementById(index).dataset.unsplash_id;


                    if (description == "") {
                        description = "This is an image";
                    }
                    let data = {
                        "description": description,
                        "url_raw": url_raw,
                        "url_regular": url_regular,
                        "unsplash_id": unsplash_id,
                        "user_id": this.userId
                    };

                    axios.post('api/like', data)
                        .then(function (response) {
                            if (response.data == "like") {
                                document.getElementById('like' + index).style.display = "inline";
                                document.getElementById('dislike' + index).style.display = "none";

                            }
                            if (response.data == "dislike") {
                                document.getElementById('like' + index).style.display = "none";
                                document.getElementById('dislike' + index).style.display = "inline";
                            }
                        }).catch(function (error) {
                        alert(error);
                    });
                }

            },

            clearInput($event) {
                $event.target.value = "";
            },

            getAllCollections() {
                var vm = this;
                this.isAdd = [];
                this.userId = document.getElementById('searchTag').dataset.user_id;
                if (this.userId == "") {
                    window.location.href = '/login';
                } else {
                    let data = {
                        "user_id": this.userId,
                    };
                    axios.post('api/getCollectionsByUserId', data)
                        .then(function (response) {
                            if (response.data == "empty") {
                                vm.isColEmpty = true;
                            } else {
                                vm.isColEmpty = false;
                                vm.collections = response.data[0];
                                vm.colCoverImgs = response.data[1];
                            }
                        }).catch(function (error) {
                        alert(error);
                    });
                }
            },

            createCollection() {
                var vm = this;
                this.userId = document.getElementById('searchTag').dataset.user_id;
                let data = {
                    "user_id": this.userId,
                    "c_name": this.colName,
                    "c_description": this.colDescription,
                };
                axios.post('api/collections', data)
                    .then(function (response) {
                        if (response.data == "success") {
                            vm.getAllCollections();
                            vm.$bvModal.hide('create');
                            vm.colName = '';
                            vm.colDescription = '';
                        }
                    }).catch(function (error) {
                    alert(error);
                });
            },

            addToCollection(pic_index, collection_index) {
                var vm = this;
                var idx = "image" + pic_index;
                var cid = "colImages" + collection_index;
                var description = document.getElementById(idx).dataset.description;
                var url_raw = document.getElementById(idx).dataset.url_raw;
                var url_regular = document.getElementById(idx).dataset.url_regular;
                var unsplash_id = document.getElementById(idx).dataset.unsplash_id;
                var collection_id = document.getElementById(cid).dataset.collection_id;
                let data = {
                    "description": description,
                    "url_raw": url_raw,
                    "url_regular": url_regular,
                    "unsplash_id": unsplash_id,
                };

                axios.post('api/addImage', data)
                    .then(function (response) {
                        let data2 = {
                            "image_id": response.data,
                            "collection_id": collection_id,
                        };
                        axios.post('api/addToCollection', data2)
                            .then(function (response) {

                                if (response.data == "success") {
                                    vm.isAdd[collection_index] = true;
                                    vm.getAllCollections();
                                }
                                if (response.data == "exist") {
                                    alert('This pictue has existed in this collection!')
                                }

                            }).catch(function (error) {
                            alert(error);
                        });


                    }).catch(function (error) {
                    alert(error);
                });

            },


            deleteCollection(index) {
                var vm = this;
                var idx = "colImages" + index;
                var collection_id = document.getElementById(idx).dataset.collection_id;
                let data = {
                    "collection_id": collection_id,
                };
                axios.post('api/deleteCollection', data)
                    .then(function (response) {
                        if (response.data == "success") {
                            vm.getAllCollections();
                        }

                    }).catch(function (error) {
                    alert(error);
                });
            },

            deleteImages(pic_index, collection_index) {
                var vm = this;
                var cid = "colImages" + collection_index;
                var collection_id = document.getElementById(cid).dataset.collection_id;
                var img_id = this.c_imgs[pic_index - 1].id;
                let data = {
                    "collection_id": collection_id,
                    "image_id": img_id,
                };
                axios.post('api/deleteImages', data)
                    .then(function (response) {
                        if (response.data == "success") {
                            vm.seeDetails(collection_index);
                        }

                    }).catch(function (error) {
                    alert(error);
                });
            },

            seeDetails(collection_index) {
                this.c_imgs = 1;
                var vm = this;
                var cid = "colImages" + collection_index;
                var collection_id = document.getElementById(cid).dataset.collection_id;
                let data = {
                    "collection_id": collection_id,
                };

                axios.post('api/seeCollectionDetails', data)
                    .then(function (response) {
                        if (response.data == "") {
                            vm.isColImgEmpty = true;
                        } else {
                            vm.isColImgEmpty = false;
                            vm.c_imgs = response.data;
                        }

                        vm.isCollectionImageLike();

                    }).catch(function (error) {
                    alert(error);
                });
            },

            forceFileDownload(response) {
                const url = window.URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'file.png') //or any other extension
                document.body.appendChild(link)
                link.click()
            },

            downloadWithAxios(url) {
                axios({
                    method: 'get',
                    url: url,
                    responseType: 'arraybuffer'
                })
                    .then(response => {

                        this.forceFileDownload(response)

                    })
                    .catch(() => console.log('error occured'))


            }


        },
        name: "Home"
    }
</script>

<style scoped>
    .top-search-pic {
        width: 100%;
        height: 600px;
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