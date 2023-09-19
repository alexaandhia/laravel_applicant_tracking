@extends('layout.main')
@section('content')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Create Data</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Create Data</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- left column -->
          <div class="">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Skill Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if ($errors->any())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </div>
              @endif
              @if (Session::get('errorSkill'))
              <p class="alert alert-danger p-3" role="alert">{{Session::get('errorSkill')}}</p>
              @endif
              @if (Session::get('success'))
              <p style="color: green;">{{Session::get('success')}}</p>
              @endif
              <!-- applicant -->
              <div class="card-body">
                <form action="" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="inputSkill">Skill Name</label>
                    <input type="text" class="form-control" id="inputSkill" placeholder="Input a Skill" name="skill">
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Skill List
                </button> -->
                  </div>
                </form>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </section>
      <section class="content">
        <div class="container-fluid">
          <!-- left column -->
          <div class="">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Delete Skill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if ($errors->any())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </div>
              @endif
              @if (Session::get('errorSkill'))
              <p class="alert alert-danger p-3" role="alert">{{Session::get('errorSkill')}}</p>
              @endif
              @if (Session::get('success'))
              <p style="color: green;">{{Session::get('success')}}</p>
              @endif
              <!-- applicant -->
              <div class="card-body">
                <form action="" method="post">
                  
                  <div class="form-group">
                    <label for="inputSkill">Choose Skills</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select Skills" data-dropdown-css-class="select2-purple" style="width: 100%;" name="id">
                    @foreach($skills as $data)
                      <option value="{{$data->id}}">{{$data->skill}}</option>
                      @endforeach
                    </select>
                   
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Delete Skill</button>
                  </div>
                </form>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </section>

    </div>
  </div>
  <!-- ./wrapper -->
</body>

</html>


@endsection