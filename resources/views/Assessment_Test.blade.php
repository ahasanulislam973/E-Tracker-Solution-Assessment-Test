<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:20px">
    <div class="row">

        <form action="{{url('save_data')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter name" value="{{old('name')}}">
                    </div>
                    @error('name')

                    <strong class="text-danger" role="alert">
                        {{$message}}
                    </strong>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-labell">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Enter email" value="{{old('email')}}">
                    </div>
                    @error('email')

                    <strong class="text-danger" role="alert">
                        {{$message}}
                    </strong>
                    @enderror
                </div>
                <div class="form-group ">
                    <div class="image row">
                        <label for="image" class="col-sm-2 col-form-labell">Image:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" required name="image" id="image">
                        </div>
                    </div>

                    @error('image')

                    <strong class="text-danger" role="alert">
                        {{$message}}
                    </strong>
                    @enderror
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-labell">Gender:</label>
                    <div class="col-sm-10">
                        <input type="radio" id="male" name="gender" value="Male">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label>
                    </div>

                    @error('gender')

                    <strong class="text-danger" role="alert">
                        {{$message}}
                    </strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-labell">Skills:</label><br>
                    <div class="col-sm-10">
                        <label><input type="checkbox" name="skill[]" value="Laravel" class="m-2"> Laravel</label>
                        <label><input type="checkbox" name="skill[]" value="Codeigniter" class="m-2"> Codeigniter</label><br>
                        <label><input type="checkbox" name="skill[]" value="Ajax" class="m-2"> Ajax</label>
                        <label><input type="checkbox" name="skill[]" value="VUE JS" class="m-2"> VUE JS</label><br>
                        <label><input type="checkbox" name="skill[]" value="MySQL" class="m-2"> MySQL</label>
                        <label><input type="checkbox" name="skill[]" value="API" class="m-2"> API</label>
                    </div>
                    @error('skill')

                    <strong class="text-danger" role="alert">
                        {{$message}}
                    </strong>
                    @enderror
                </div>

            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-outline-secondary btn-lg text-dark"> SUBMIT</button>

            </div>

        </form>
    </div>
    <hr class="divider">
    <h4 class="text-center"><u>List Of Data</u></h4>
    <div class="container">
        <table class="table">
            <thead>

            <tr>

                <th>Serial_No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Gender</th>
                <th>Skills</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @php
                $i=1;
            @endphp
            @foreach($datalists as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->Name}}</td>
                    <td>{{$data->Email}}</td>
                    <td><img src="{{ url('/image/'.$data->Image) }}"
                             style="height: 150px; width: 150px;" alt="image"></td>
                    <td>{{$data->Gender}}</td>
                    <td>{{$data->Skills}}</td>

                    <td>
                        <button type="button" value="{{$data->id}}" class="btn btn-primary editbtn btn-sm">Edit
                        </button>

                        <button type="button" value="{{$data->id}}" class="btn btn-danger deletebtn btn-sm">Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

{{--Update Modal--}}
<div class="modal fade " id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('edit_data')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="updateid" name="id">
                    <div class="form-group row">
                        <label for="editname" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="editname" name="editname"
                                   placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editemail" class="col-sm-2 col-form-labell">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="editemail" name="editemail"
                                   placeholder="Enter email">
                        </div>

                    </div>
                    <div class="form-group ">
                        <div class="image row">
                            <label for="editimage" class="col-sm-2 col-form-labell">Image:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" required name="editimage" id="editimage">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-labell">Gender:</label>
                        <div class="col-sm-10">
                            <input type="radio" id="male" name="editgender" value="Male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="editgender" value="Female">
                            <label for="female">Female</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-labell">Skills:</label><br>
                        <div class="col-sm-10">
                            <label><input type="checkbox" name="editskill[]" id="editskill[]" value="Laravel" class="m-2"> Laravel</label>
                            <label><input type="checkbox" name="editskill[]"  id="editskill[]" value="Codeigniter" class="m-2"> Codeigniter</label><br>
                            <label><input type="checkbox" name="editskill[]" id="editskill[]" value="Ajax" class="m-2"> Ajax</label>
                            <label><input type="checkbox" name="editskill[]" id="editskill[]" value="VUE JS" class="m-2"> VUE JS</label><br>
                            <label><input type="checkbox" name="editskill[]" id="editskill[]" value="MySQL" class="m-2"> MySQL</label>
                            <label><input type="checkbox" name="editskill[]" id="editskill[]" value="API" class="m-2"> API</label>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
{{--Close Update Modal--}}


{{--Delete product Modal--}}
<div class="modal fade " id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure to Delete?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deletedata()">Delete</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <input type="hidden" id="deleteid">
            </div>
        </div>
    </div>
</div>
{{--Close Delete Modal--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.editbtn', function () {
            var data_id = $(this).val();
            $('#editmodal').modal('show')

            $.ajax({
                method: "GET",
                url: '/edit/' + data_id,
                success: function (response) {
                    $('#updateid').val(response.data.id);
                    $('#editname').val(response.data.Name);
                    $('#editemail').val(response.data.Email);
                    $('#editimage').val(response.data.Image);
                    $('#editskill').val(response.data.Skills);

                }
            });
        });




        $(document).on('click', '.deletebtn', function () {
            var p_id = $(this).val();
            $('#deleteid').val(p_id);
            $('#deletemodal').modal('show')

        });

    });


    function deletedata() {
        var hiddendata = $('#deleteid').val();
        $.ajax({
            method: "GET",
            url: '/delete_data/' + hiddendata,
            success: function (response) {

                $('#deletemodal').modal('hide');
                window.location.reload();
            }
        });
    }
</script>


</body>

</html>
