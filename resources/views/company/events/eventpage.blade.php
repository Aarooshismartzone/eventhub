<!-- event page details -->

<div class="mt-3" style="font-weight: 800">Event Page</div>
<div class="mt-4">
    <form method="post" enctype="multipart/form-data" id="eventPage">
        @csrf
        <input type="hidden" name="event_id" id="event_id1" value="">
        <div class="card titlehead">Page Details</div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Page Title</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control mt-2" name="page_title" placeholder="Enter post title"
                    onclick="slugCreate(this.value)" onchange="slugCreate(this.value)" required>
				<i style="color: blue"> The page title will appear as the URL of the landing page, and the URL character
                    limit is (20) please, adjust the page title accordingly.</i>
                    <span class="error_page_title qerr"></span>
            </div>
            
			    
        </div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">URL</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control mt-2" name="page_slug" placeholder="Slug" id="slug" readonly required>                
            </div>
            <span class="error_page_slug qerr"></span>
        </div> 
        
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">About The Event</div>
            <div class="col-sm-9 col-7">
                <textarea class="form-control" rows="5" name="page_about" required></textarea>
            </div>
            <span class="error_page_about qerr"></span>
        </div> 
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Upload Logo (Types:jpg,jpeg,png. Size: upto 1MB)</div>
            <div class="col-sm-9 col-7">
                
            <div class="card w-100 filecard" id="filecard">
				<span class="btn lbl" id="spnFilePath" style="color: white">Choose File</span></div>
            </div>
			<input type="file" name="logo" id="logo" accept="image/*" required style="display:none">
        </div>
        <span class="error_logo qerr"></span>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Upload Feature Image (Types:jpg,jpeg,png. Size: upto 1MB)</div>
            <div class="col-sm-9 col-7">
                
            <div class="card w-100 filecard" id="featimage"><span class="btn lbl" style="color: white" id="spnFilePath1">Choose File</span></div>
            </div>
			<input type="file" id="featuredimage" accept="image/*" name="feature_image" required style="display:none">
        </div>
        <span class="error_feature_image qerr"></span>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Images of the Venue/Event
            </div>
            <div class="col-sm-9 col-7">
                <input type="file" name="images[]" id="venueimages" multiple required style="display:none" onClick="uploadImages()">
                <div class="card w-100 filecard lbl text-center" id="vibox">
                    <img src="{{asset('images/icons/imageicon.png')}}" class="imageicon mx-auto">
                    Drag & Drop your files here or Select a file
                </div>
                <div class="previewDiv row">
                    
                </div>
            </div>
            <span class="error_images qerr"></span>
        </div> 
        <div class="eventPageStatusMsg"></div>
        <div class="mt-4 mb-3">
            <button type="button" class="btn bluebutton" id="eventPageBtn" onClick="eventPageSubmit()">Save & next</button>
            
        </div>  
    </form>
</div>
<!-- <form id='post-form' class='post-form' method='post'>
  <label for='files'>Select multiple files: </label>
  <input id='files' type='file' multiple/>
  <output id='result' />
</form> -->
                    <!-- event page details end -->
<script>
    function slugCreate(title) {
        const kebabCase = str => str
            .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
            .join('-')
            .toLowerCase();
		var rand = Math.floor(Math.random() * 100) + 1;
        var slug = rand + "-" + kebabCase(title);
        document.getElementById("slug").value = slug;
    }
</script>

<script>
function eventPageSubmit(){
    $('.qerr').html('');
    $('.eventPageStatusMsg').html('');

    var form = $('#eventPage')[0];		 
    var data = new FormData(form);

    $.ajax({
        type:'POST',
        enctype: 'multipart/form-data',
        processData: false,
        url:"{{ url('/addEventPageDetails') }}",
        data:data,
        contentType: false,
        cache: false,
        timeout: 600000,      
        beforeSend: function() {
            $('.eventPageStatusMsg').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Processing...</span></div><div class="card successcard">Processing......</div>');
            
           },  
        success:function(response){
            $("#eventPageBtn").delay(5000);
            $('.eventPageStatusMsg').html('');
            if( response.status == false ) {

                $.each(response.errors, function (errors_key, errors_val) {
                    console.log(errors_key,errors_val);
                    $('.error_'+errors_key).html(errors_val[0]).css("color","red","display","show");
                    $( errors_key ).text(errors_val[0]);
                });
                // $('.eventPageStatusMsg').html('<span style="color:red;">'+response.msg+'</div>');
            }
            if( response.status == true ) {
                $('#eventPageBtn').hide();
                // $('#eventPagePreviewBtn').hide();
                $('.eventFbtn').show();
                $('.eventPageStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                $("#cimg3").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
            }
        }
    });
 
}


        
   
</script>

<script type="text/javascript">
    window.onload = function () {
        var logo = document.getElementById("logo");
        var filePath = document.getElementById("spnFilePath");
        var button = document.getElementById("filecard");
		
		var fimg = document.getElementById("featuredimage");
        var featimage = document.getElementById("featimage");
		var filePath1 = document.getElementById("spnFilePath1");
		
		var venueimages = document.getElementById("venueimages");
        var vibox = document.getElementById("vibox");
		
        button.onclick = function () {
            logo.click();
        };		
		
		
		featimage.onclick = function () {
            fimg.click();
        };
		
		vibox.onclick = function () {
            venueimages.click();
        };
		
		logo.onchange = function () {
           var fileName = logo.value.split('\\')[logo.value.split('\\').length - 1];
           filePath.innerHTML = "<b>Selected File: </b>" + fileName;
       };
		
		fimg.onchange = function () {
           var fileName = fimg.value.split('\\')[fimg.value.split('\\').length - 1];
           filePath1.innerHTML = "<b>Selected File: </b>" + fileName;
       };
    };
</script>
<style>
    .thumbnail {
    height: 100px;
    padding:10px;
    /* margin: 10px; */
    }
</style>
<script>
    $(function() {
        var filesAmount=0;
        
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        $('.previewDiv').html('');
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#venueimages').on('change', function() {
        imagesPreview(this, 'div.previewDiv');
    });
});
    // window.onload = function() {
    // function uploadImages() {
    //     //Check File API support
    //     if (window.File && window.FileList && window.FileReader) {
    //         var filesInput = document.getElementById("venueimages");
    //         filesInput.addEventListener("change", function(event) {
    //         var files = event.target.files; //FileList object
    //         var output = document.getElementById("previewDiv");
    //         for (var i = 0; i < files.length; i++) {
    //             var file = files[i];
    //             //Only pics
    //             if (!file.type.match('image'))
    //             continue;
    //             var picReader = new FileReader();
    //             picReader.addEventListener("load", function(event) {
    //             var picFile = event.target;
    //             var div = document.createElement("div");
    //             div.className = "col-md-3";
    //             div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
    //                 "title='" + picFile.name + "'/>";
    //             output.insertBefore(div, null);
    //             });
    //             //Read the image
    //             picReader.readAsDataURL(file);
    //         }
    //         });
    //     } else {
    //         console.log("Your browser does not support File API");
    //     }
    // }
</script>