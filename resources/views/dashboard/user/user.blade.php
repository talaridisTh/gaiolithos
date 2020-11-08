@extends("layouts.dashboard")

@section("style")

@endsection

@section("content")
    <div class="container-fluid mt-4">
        <form
            @if(request()->route()->getName()=="user.create")
            action="{{route('user.store')}}"
            method="POST"
            @else
            action="{{route('user.show')}}"
            method="PUT"
            @endif
            id="form-user-create"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
        </form>

        <div class="row">
            <div class="col-md-6 col-lg-4">

                <!-- Simple card -->
                <div class="card d-block">
                    <div class="card-body">

                        <div class="form-group"> <!-- BEGIN: First-name -->
                            <label for="user-firstName">'Ονομα</label>
                            <input type="text"
                                   id="user-firstName"
                                   class="form-control @error('first_name') border-danger @enderror"
                                   name="first_name"
                                   placeholder="Εισάγετε ονομα.."
                                   value="{{isset($user)?$user->first_name: (old('first_name') != "" ? old('first_name') : "" )}}"
                                   form="form-user-create"
                            >
                            @error("first_name")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: First-name -->

                        <div class="form-group"> <!-- BEGIN: Last-name -->
                            <label for="user-lastName">Επίθετο</label>
                            <input type="text"
                                   id="user-lastName"
                                   class="form-control  @error('last_name') border-danger @enderror"
                                   name="last_name"
                                   placeholder="Εισάγετε επίθετο.."
                                   value="{{isset($user)?$user->last_name: (old('last_name') != "" ? old('last_name') : "" )}}"
                                   form="form-user-create"
                            >
                            @error("last_name")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div><!-- END: Last-name -->

                        <div class="form-group"> <!-- BEGIN: E-mail -->
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text"
                                       id="user-email"
                                       class="form-control  @error('email') border-danger @enderror"
                                       name="email"
                                       placeholder="Εισάγετε email.."
                                       value="{{isset($user)?$user->email: (old('email') != "" ? old('email') : "" )}}"
                                       form="form-user-create"
                                >
                            </div>
                            @error("email")
                            <div class="invalid-feedback d-block d-block">{{$message}}</div>
                            @enderror
                        </div><!-- END: E-mail -->

                        <div class="form-group"><!-- BEGIN: Phone -->
                            <label for="user-phone">Τηλεφωνώ</label>
                            <input type="text"
                                   id="user-phone"
                                   class="form-control  @error('phone') border-danger @enderror "
                                   name="phone"
                                   placeholder="Εισάγετε τηλεφωνώ.."
                                   value="{{isset($user)?$user->phone: (old('phone') != "" ? old('phone') : "" )}}"
                                   form="form-user-create"
                            >
                            @error("phone")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: Phone -->

                        <div class="form-group"> <!-- BEGIN: Profile -->
                            <label for="example-textarea">Προφιλ</label>
                            <textarea
                                id="example-textarea"
                                class="form-control @error('profile') border-danger @enderror"
                                name="profile"
                                placeholder="Εισάγετε πληροφορίες"
                                rows="5">
                                {{isset($user)?$user->profile: (old('profile') != "" ? old('profile') : "" )}}"
                            </textarea>
                            @error("profile")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: Profile -->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <div class="col-md-6 col-lg-4">

                <!-- Simple card -->
                <div class="card d-block">
                    <div class="card-body">

                        <div class="form-group"> <!-- BEGIN: Role -->
                            <label for="user-role">'Role</label>
                            <select
                                id="user-role"
                                class="form-control  @error("role") border-danger  @enderror"
                                name="role"
                                form="form-user-create"
                            >
                                @foreach($roles as  $role)
                                    <option
                                        {{isset($user)?($user->getRoleNames()[0]==$role->name?"selected":""):($role->id==2?"selected":"")}}
                                        value="{{$role->id}}">{{$role->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error("role")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: Role -->

                        <div class="form-group"> <!-- BEGIN: Password -->
                            <label for="user-password">Κωδικός </label>
                            <div class="input-group input-group-merge">
                                <input autocomplete="off"
                                       type="password"
                                       id="user-password"
                                       class="form-control @error("password") border-danger @enderror"
                                       name="password"
                                       placeholder="Εισάγετε Κωδικό.."
                                       form="form-user-create"
                                />
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @error("password")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: Password -->

                        <div class="form-group"> <!-- BEGIN: Password-confirmation -->
                            <label for="password_confirmation">Επανάληψη κωδικού</label>
                            <div class="input-group input-group-merge">
                                <input autocomplete="off"
                                       type="password"
                                       id="password_confirmation"
                                       class="form-control @error("password_confirmation") border-danger @enderror"
                                       name="password_confirmation"
                                       placeholder="Εισάγετε επανάληψη κωδικού.."
                                       form="form-user-create"
                                />
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @error("password_confirmation")
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div> <!-- END: Password-confirmation -->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <div class="col-md-6 col-lg-4">

                <!-- Simple card -->
                <div class="card d-block">
                    <div class="card-body">

                        <div class="d-flex">
                            <button type="button" id="submit-user-create" class="w-100 btn btn-primary">Save</button>
                            <i class="mdi-content-save"></i>
                        </div>

                        <div
                            class="form-row justify-content-center align-items-center border-top border-bottom my-3 p-3">
                            <!-- BEGIN: Status -->
                            <label class="font-16 mr-3">Status</label>
                            <input type="checkbox"
                                   id="user-status"
                                   data-switch="primary"
                                   form="form-user-create"
                                {{isset($user)?($user->status==1?"checked":""):""}}
                            />
                            <label for="user-status" data-on-label="On" data-off-label="Off"></label>
                        </div> <!-- END: Status -->

                        <div class="form-group text-center"> <!-- BEGIN: Avatar -->
                            <div class="d-inline-block position-relative">
                                <img height="150" src="https://via.placeholder.com/200" alt="image"
                                     class="img-fluid rounded">
                                <span data-toggle="modal" data-target="#user-upload" class="position-absolute edit-avatar js-file-uploader"> <i
                                        class="dripicons-pencil "></i>
                                </span>
                            </div>
                        </div> <!-- END: Avatar -->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div>
    <x-file-upload uploadName='user-upload'></x-file-upload>
@endsection

@section("script")
    <script src="https://releases.transloadit.com/uppy/v1.22.0/uppy.min.js"></script>

    <script src="{{mix("js/dashboard/user/user.js")}}"></script>



@endsection

