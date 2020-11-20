<div class="js-image-cnt">
    <div class="d-flex flex-wrap justify-content-start">
        @foreach($media as $thump)

            <div class="image_item">
                <img class="m-2"
                     src="{{asset($thump->path.$thump->slug_name)}}"
                     alt="user-cover"
                     height="100"
                     data-cover-id="{{$thump->id}}"
                >
                <i class="font-20 uil-upload-alt js-attach-media position-absolute"></i>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center js-paginate">
        {!! $media->links() !!}
    </div>
</div>
