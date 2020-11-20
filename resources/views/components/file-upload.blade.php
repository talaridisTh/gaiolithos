<div class="modal fade" id="{{$uploadName}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Image Gallery</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs mb-3"><!-- BEGIN: tabs -->
                    <li class="nav-item">
                        <a href="#upload-modal" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                            <span class="d-none d-md-block">Media library</span>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#Media-library-modal" data-toggle="tab" aria-expanded="true" class="nav-link ">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Upload</span>
                        </a>
                    </li>
                </ul> <!-- END: tabs -->


                <div class="tab-content ">

                    <div class="tab-pane show active" id="upload-modal"> <!-- BEGIN: image container -->

                        <form action="{{route('searchMedia')}}"> <!-- BEGIN: serach media -->
                            <div class="form-row justify-content-end mb-2 mr-3">
                                <input type="text" class="w-25 form-control" id="search-media" name="search-media"
                                       placeholder="Αναζήτηση...">
                            </div>
                        </form> <!-- END: search media -->

                        <x-uploader :media=$media></x-uploader>


                    </div> <!-- END: image container -->

                    <div class="tab-pane " id="Media-library-modal"> <!-- BEGIN: uppy  js -->
                        <div id="select-files"></div>
                    </div>
                </div> <!-- END: uppy  js -->

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
