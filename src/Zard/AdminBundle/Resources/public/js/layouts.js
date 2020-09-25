//  Google Maps API src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
// Inputs for Geolocation
let address;
let geocode;
let gmapsLink;

$(document).ready(function () {

    if ($(".applyCKEditor")[0]) {
        $(".applyCKEditor").each(function (index, value) {
            var id = $(this).attr('id');
            CKEDITOR.replace(id, { height: '200px' });
        });
    }

    if ($('.copy_name')[0]) {
        $(".copy_name").each(function (index, value) {
            var idName = $(this).attr('id');
            var fields = $(this).attr('data-fields');
            var mode = $(this).attr('data-listmode');
            var entity = $(this).attr('data-entity');
            var raiz = "#" + idName;
            var listFields = fields.split(',');
            var listMode = mode.split(',');
            $(raiz).keyup(function () {
                $.each(listFields, function (index, nameField) {
                    if (listMode[index] == 'slug') {
                        $("#" + entity + "_" + nameField).val(getSlug($(raiz).val()));
                    } else {
                        $("#" + entity + "_" + nameField).val($(raiz).val());
                    }
                });
            });
        });
    }


    // Form Structure
    $(".form-group").each(function () {
        if ($(this).children().hasClass("col-sm-6")) {
            $(this).addClass("col-sm-6 no-gutter-custom");
        }
    });


    var section = $('#entity').attr('data-name');
    var id = $('#entity').attr('data-id');

    if ($('.preview-image')[0] && $("#entity").attr("data-form") != "new") {
        $('.preview-image').each(function () {
            var imageName = $(this).val();
            var id = $(this).attr("id");
            $('#' + id + 'File').parent().parent().append("<img src='/images/" + section + "/" + imageName + "' class='preview'>")
            $('#' + id + 'File').change(function () {
                $(this).parent().parent().find('.preview').remove();
            });
        });
    }

    /* notWorking */
    // Cropper JS
    if ($(".cropper")[0]) {
        $(".cropper").each(function () {
            new Cropper($(this));
        });
    }

    // Cropper Event
    $(".cropper-local button").click(function (e) {
        e.preventDefault();
        alert();
        var ruleWidth = $(this).parent().parent().parent().attr('data-max-width');
        var ruleHeight = $(this).parent().parent().parent().attr('data-max-height');
        //Width&Height limit
        console.log("Width & height limit");
        configCroppper = {
            aspectRatio: ruleWidth / ruleHeight,
            viewMode: 3,
            autoCrop: true,
            zoomable: false,
            cropBoxResizable: true,
            movable: false,
            dragCrop: true,
            dragMode: "none",
            background: true,
            ready: function (event) {
                var currentImageWidth = event.srcElement.width;
                var currentImageHeight = event.srcElement.height;
                $('.modal .modal-body .row.msg').remove();
                $('.cropper-container').removeClass('cropper-disabled');
                $('[data-method="getCroppedCanvas"]').removeAttr('disabled');
                console.log("x");
                console.log(currentImageWidth);
                console.log(ruleWidth);
                console.log(currentImageHeight);
                console.log(ruleHeight);
                if (currentImageWidth <= ruleWidth || currentImageHeight <= ruleHeight) {
                    console.log("es menor");
                    var htmlInvalid = '<div class="row msg" >';
                    htmlInvalid += '<div> <span class="cropper-dim-invalid">Imagen demasiado pequeña</span> </div>';
                    htmlInvalid += '</div>';
                    $('.modal .modal-body').append(htmlInvalid);
                    $('.cropper-container').addClass('cropper-disabled');
                    $('[data-method="getCroppedCanvas"]').attr('disabled', 'disabled');
                }
                $(this).cropper('setData', {
                    width: ruleWidth,
                    height: ruleHeight
                });
            }
        }
        $.fn.cropper.setDefaults(configCroppper);
        $.fn.cropper('getCroppedCanvas', {
            fillColor: '#fff'
        });
    });

    if ($('#projects_color')[0]) {
        setColorPicker('#projects_color');
    }
});

function generateCKEditor(textarea, type) {
    let toolbarOptions;

    switch (type) {
        case "text":
            toolbarOptions = ["heading", "|", "bold", "italic", "link"];
            break;

        case "phone":
            toolbarOptions = ["link"];
            break;
    }
    console.log(ClassicEditor);
    if (type) {
        ClassicEditor.create(document.querySelector(textarea), {
            toolbar: toolbarOptions
        })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    } else {
        ClassicEditor.create(document.querySelector(textarea), {
            // toolbar: toolbarOptions
        })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    }
}

// Google Maps API Autocomplete Function
function initAutocomplete(address, geocode, gmapsLink) {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById(address), {
        types: ["geocode"]
    }
    );
    // Specify just the place data fields that you need.
    autocomplete.setFields(["geometry", "url"]);
    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener("place_changed", function () {
        // Get location
        let location = autocomplete.getPlace();
        // Set Latitude and Longitude
        let lat = location.geometry.location.lat();
        let lng = location.geometry.location.lng();
        // Assign coordenates to input geocode
        document.getElementById(geocode).value = `${lat},${lng}`;
        // Create Google Maps Link
        document.getElementById(gmapsLink).value = location.url;
    });
}

function createPreview(input, elementPreview) {
    console.log(input)
    console.log(elementPreview)
    console.log(input.files)
    console.log(input.files[0])
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            elementPreview.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function setColorPicker(input) {
    var $element = $(input)
    $element.keypress(function (e) {
        e.preventDefault();
    });
    if ($element.val()) {
        setColor($element, $element.val());
    }
    $($element).ColorPicker({
        color: $element.val(),
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            var colorPicked = '#' + hex;
            setColor($element, colorPicked);
            /* liveGradient($('#banner_bannerColorA').val(), $('#banner_bannerColorB').val()); */
        }
    });
}

function setColor($element, color) {
    $element.css({
        'backgroundColor': color,
        'color': color
    });
    $element.val(color);
}
