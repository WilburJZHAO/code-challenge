function hoverOn(index) {
    var idx = "d" + index;
    document.getElementById(index).style.visibility = "visible";
    document.getElementById(idx).style.visibility = "visible";
}

function hoverOff(index) {
    var idx = "d" + index;
    document.getElementById(index).style.visibility = "hidden";
    document.getElementById(idx).style.visibility = "hidden";
}

function hoverOnModal(index) {
    var idx_description = "d_detail_" + index;
    var idx = "detail_" + index;
    document.getElementById(idx).style.visibility = "visible";
    document.getElementById(idx_description).style.visibility = "visible";
}

function hoverOffModal(index) {
    var idx_description = "d_detail_" + index;
    var idx = "detail_" + index;
    document.getElementById(idx_description).style.visibility = "hidden";
    document.getElementById(idx).style.visibility = "hidden";
}

function likeImage(index) {
    var description = document.getElementById(index).dataset.description;
    var url_raw = document.getElementById(index).dataset.url_raw;
    var url_regular = document.getElementById(index).dataset.url_regular;
    var unsplash_id = document.getElementById(index).dataset.unsplash_id;
    var ImageToken = document.getElementById(index).dataset._token;
    var isLike = null;
    if (description == "") {
        description = "This is an image";
    }

    $.ajax({
        type: "POST",
        url: '/like',
        data: {
            isLike: isLike,
            description: description,
            url_raw: url_raw,
            url_regular: url_regular,
            unsplash_id: unsplash_id,
            _token: ImageToken
        },
        success: function (data) {
            if (data == "N") {
                window.location.href = "/login";
            }
            if (data == "like") {
                document.getElementById(index).children[0].children[0].style.display = 'none';
                document.getElementById(index).children[0].children[1].style.display = 'inline';
            }
            if (data == "dislike") {
                document.getElementById(index).children[0].children[1].style.display = 'none';
                document.getElementById(index).children[0].children[0].style.display = 'inline';
            }


        }
    });

}

function likeDetailImage(index) {
    index = "detail_" + index;
    var description = document.getElementById(index).dataset.description;
    var url_raw = document.getElementById(index).dataset.url_raw;
    var url_regular = document.getElementById(index).dataset.url_regular;
    var unsplash_id = document.getElementById(index).dataset.unsplash_id;
    var ImageToken = document.getElementById(index).dataset._token;
    var isLike = null;
    if (description == "") {
        description = "This is an image";
    }

    $.ajax({
        type: "POST",
        url: '/like',
        data: {
            isLike: isLike,
            description: description,
            url_raw: url_raw,
            url_regular: url_regular,
            unsplash_id: unsplash_id,
            _token: ImageToken
        },
        success: function (data) {
            if (data == "N") {
                window.location.href = "/login";
            }
            if (data == "like") {
                document.getElementById(index).children[0].children[0].style.display = 'none';
                document.getElementById(index).children[0].children[1].style.display = 'inline';
            }
            if (data == "dislike") {
                document.getElementById(index).children[0].children[1].style.display = 'none';
                document.getElementById(index).children[0].children[0].style.display = 'inline';
            }


        }
    });

}

function dislikeImage(index) {
    var description = document.getElementById(index).dataset.description;
    var url_raw = document.getElementById(index).dataset.url_raw;
    var url_regular = document.getElementById(index).dataset.url_regular;
    var unsplash_id = document.getElementById(index).dataset.unsplash_id;
    var ImageToken = document.getElementById(index).dataset._token;
    var isLike = null;
    $.ajax({
        type: "POST",
        url: '/like',
        data: {
            isLike: isLike,
            description: description,
            url_raw: url_raw,
            url_regular: url_regular,
            unsplash_id: unsplash_id,
            _token: ImageToken
        },
        success: function (data) {
            if (data == "N") {
                window.location.href = "/login";
            }
            if (data == "like") {
                document.getElementById(index).children[0].children[0].style.display = 'none';
                document.getElementById(index).children[0].children[1].style.display = 'inline';
            }
            if (data == "dislike") {
                window.location.href = "/vip/dashboard"
                document.getElementById('like').style.display = 'inline';
                document.getElementById('collection').style.display = 'none';
                document.getElementById('imageSearch').style.display = 'none';
                // document.getElementById(index).children[0].children[1].style.display = 'none';
                // document.getElementById(index).children[0].children[0].style.display = 'inline';
            }


        }
    });

}

function downloadImage(index) {
    var description = document.getElementById(index).dataset.description;
    var url_raw = document.getElementById(index).dataset.url_raw;
    var ImageToken = document.getElementById(index).dataset._token;
    $.ajax({
        type: "POST",
        url: '/download',
        data: {
            description: description,
            url_raw: url_raw,
            url_regular: url_regular,
            unsplash_id: unsplash_id,
            _token: ImageToken
        },
        success: function (data) {
            if (data == "N") {
                window.location.href = "/login";
            }
            if (data == "like") {
                document.getElementById(index).children[0].children[0].style.display = 'none';
                document.getElementById(index).children[0].children[1].style.display = 'inline';
            }
            if (data == "dislike") {
                document.getElementById(index).children[0].children[1].style.display = 'none';
                document.getElementById(index).children[0].children[0].style.display = 'inline';
            }
        }
    });

}

function profileSwitch(switcher) {
    switch (switcher) {
        case 'like':
            document.getElementById('like').style.display = 'inline';
            document.getElementById('collection').style.display = 'none';
            document.getElementById('imageSearch').style.display = 'none';
            break;
        case 'collection':
            document.getElementById('collection').style.display = 'inline';
            document.getElementById('imageSearch').style.display = 'none';
            document.getElementById('like').style.display = 'none';
            break;
        case 'search':
            document.getElementById('imageSearch').style.display = 'inline';
            document.getElementById('like').style.display = 'none';
            document.getElementById('collection').style.display = 'none';
            break;
    }

}

function clearInput($event) {
    $event.target.value = "";
}

function downloadImage(index) {
    var description = document.getElementById(index).dataset.description;
    var url_raw = document.getElementById(index).dataset.url_raw;
    var ImageToken = document.getElementById(index).dataset._token;
    if (description == "") {
        description = "This is an image";
    }

    $.ajax({
        type: "POST",
        url: '/download',
        data: {
            description: description,
            url_raw: url_raw,
            _token: ImageToken
        },
        success: function (data) {
            alert("ssss");
            if (data == "N") {
                window.location.href = "/login";
            }
        }
    });

}

function addToCollection(pic_index, collection_index) {
    var idx = "c" + collection_index;
    var description = document.getElementById(pic_index).dataset.description;
    var url_raw = document.getElementById(pic_index).dataset.url_raw;
    var url_regular = document.getElementById(pic_index).dataset.url_regular;
    var unsplash_id = document.getElementById(pic_index).dataset.unsplash_id;
    var ImageToken = document.getElementById(pic_index).dataset._token;
    var collection_id = document.getElementById(idx).dataset.collection_id;
    $.ajax({
        type: "POST",
        url: '/addImage',
        data: {
            description: description,
            url_raw: url_raw,
            url_regular: url_regular,
            unsplash_id: unsplash_id,
            _token: ImageToken
        },
        success: function (data) {
            if (data == "N") {
                window.location.href = "/login";
            } else {
                $.ajax({
                    type: "POST",
                    url: '/addToCollection',
                    data: {
                        image_id: data,
                        collection_id: collection_id,
                        _token: ImageToken
                    },
                    success: function (data) {
                        if (data == "N") {
                            window.location.href = "/login";
                        }
                        if (data == "success") {
                            $idx_btn_add = "btn_add_" + collection_index;
                            document.getElementById($idx_btn_add).innerHTML = "Exist";
                            document.getElementById("alert_add_collection").style.color = "black";
                            document.getElementById("alert_add_collection").innerHTML = "Add successfully!";

                        }
                        if (data == "exist") {
                            document.getElementById("alert_add_collection").style.color = "red";
                            document.getElementById("alert_add_collection").innerHTML = "Image has already existed! Please try others!";
                        }
                    }
                });
            }
        }
    });
}

function createCollection() {
    var collection_name = document.getElementById("input-1").value;
    var collection_description = document.getElementById("input-2").value;
    var collectionToken = document.getElementById("input-2").dataset._token;
    $.ajax({
        type: "POST",
        url: 'collections',
        data: {
            c_name: collection_name,
            c_description: collection_description,
            _token: collectionToken
        },
        success: function (data) {
            if (data == "success") {
            }
        }
    });
    return false;
}

function deleteCollection(index) {
    var idx = "c" + index;
    var collection_id = document.getElementById(idx).dataset.collection_id;
    var collectionToken = document.getElementById(idx).dataset._token;
    $.ajax({
        type: "POST",
        url: 'deleteCollection',
        data: {
            collection_id: collection_id,
            _token: collectionToken
        },
        success: function (data) {
            if (data == "success") {
                window.location.reload();
            }
        }
    });
}
