@extends('layout.main')
@section('content')
<div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Applicant Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Applicant Data</li>
            </ol>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">





            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Applicant Data</h3>
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </div>
                  @endif
                  @if (Session::get('errorAdd'))
                  <p class="alert alert-danger">{{Session::get('errorAdd')}}</p>
                  @endif
                  @if (Session::get('success'))
                  <p style="color: green;">{{Session::get('success')}}</p>
                  @endif
                  <div class="card-body p-0">
                    <div class="bs-stepper">
                      <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->

                        <div class="step" data-target="#applicant-part">
                          <button type="button" class="step-trigger" role="tab" aria-controls="applicant-part" id="applicant-part-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">applicant</span>
                          </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#job-part">
                          <button type="button" class="step-trigger" role="tab" aria-controls="job-part" id="job-part-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Various job</span>
                          </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#interview-part">
                          <button type="button" class="step-trigger" role="tab" aria-controls="interview-part" id="interview-part-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">interview Details</span>
                          </button>
                        </div>
                      </div>
                      <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <!-- applicant -->
                        <form action="{{route('update', $applicant['id'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                          <div id="applicant-part" class="content" role="tabpanel" aria-labelledby="applicant-part-trigger">
                            <div class="row gx-5">
                              <div class="row">
                                <div class="form-group p-3">
                                  <label for="name">First Name</label>
                                  <input type="text" class="form-control" id="name" name="first_name" placeholder="first name" value="{{ $applicant['first_name'] }}">
                                </div>
                                <div class="form-group p-3">
                                  <label for="name">Last Name</label>
                                  <input type="text" class="form-control" id="name" name="last_name" placeholder="last name" value="{{ $applicant['last_name'] }}">
                                </div>
                                <div class="row">
                                  <div class="form-group p-3">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="ex: 088975456643" value="{{ $applicant['phone'] }}">
                                  </div>
                                  <div class="form-group p-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" value="{{ $applicant['email'] }}">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputFile">Upload Resume (PDF)</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="resume" id="resume" value="{{ old('resume') ?? $applicant['resume'] }}">
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-primary" onclick="stepper.next()">Next</a>
                          </div>
                          <!-- job details -->
                          <div id="job-part" class="content" role="tabpanel" aria-labelledby="job-part-trigger">
                            <div class="row">
                              <div class="form-group p-3">
                                <label for="name">Position Title</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Position Title" value="{{ $applicant['title'] }}">
                              </div>
                              <div class="form-group p-3">
                                <label for="name">Description</label>
                                <input type="text" class="form-control" id="name" name="description" placeholder="Description" value="{{ $applicant['description'] }}">
                              </div>
                              <div class="form-group p-3">
                                <label>Department</label>
                                <select class="form-control" style="width: 100%;" name="department">
                                  <option value="" selected disabled>Choose Department</option>
                                  <option value="frontend" {{$applicant['department'] == 'frontend' ? 'selected' : ''}}>Frontend</option>
                                  <option value="backend" {{$applicant['department'] == 'backend' ? 'selected' : ''}}>Backend</option>
                                  <option value="fullstack" {{$applicant['department'] == 'fullstack' ? 'selected' : ''}}>Fullstack</option>
                                  <option value="mobile" {{$applicant['department'] == 'mobile' ? 'selected' : ''}}>Mobile</option>
                                </select>
                              </div>
                              <div class="form-group p-3">
                                <label for="name">Experience Required</label>
                                <input type="text" class="form-control" id="name" name="experience" placeholder="experience" value="{{ $applicant['experience'] }}">
                              </div>
                              <div class="row gx-5">
                                <div class="row">
                                  <div class="form-group p-3">
                                    <label for="name">Current Position</label>
                                    <input type="text" class="form-control" id="name" name="position" placeholder="Current Postition" value="{{ $applicant['position'] }}">
                                  </div>
                                  <div class="form-group p-3">
                                    <label for="name">Current Employer</label>
                                    <input type="text" class="form-control" id="name" name="employer" placeholder="Current Employer" value="{{ $applicant['employer'] }}">
                                  </div>
                                  <div class="form-group p-3">
                                    <div class="form-group">
                                      <label>Skill: </label>
                                      <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Select Skills" data-dropdown-css-class="select2-purple" style="width: 100%;" name="skill[]">
                                          <option value="">Choose Skill</option>
                                          @foreach ($skills as $data)
                                          <option value="{{$data->id}}">{{$data->skill}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.form-group -->
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-primary" onclick="stepper.previous()">Previous</a>
                            <a class="btn btn-primary" onclick="stepper.next()">Next</a>
                          </div>
                          <!-- interview -->
                          <div id="interview-part" class="content" role="tabpanel" aria-labelledby="interview-part-trigger">
                            <div class="form-group">
                              <div class="row gx-1">
                                <div class="row">
                                  <div class="form-group p-3 col-4 ">
                                    <label>Date Applied:</label>
                                      <input type="date" class="form-control" name="applied" value="{{ $applicant['applied']}}"/>
                                  </div>
                                  <div class="form-group p-3 col-4">
                                    <label>Date Interview:</label>
                                      <input type="date" class="form-control" name="interview" value="{{ $applicant['interview']}}"/>
                                  </div>
                                  <div class="form-group p-3 col-4">
                                    <label for="name">Interviewed By:</label>
                                    <input type="text" class="form-control" id="name" name="interviewer" placeholder="Current Employer" value="{{ $applicant['interviewer']}}">
                                  </div>

                                  <!-- /.form-group -->
                                </div>

                              </div>
                              <div class="row gx-1">
                                <div class="row">
                                  <div class="form-group p-3 col-4 ">
                                    <label for="name">Interviewed score:</label>
                                    <input type="text" class="form-control" id="name" name="score" placeholder="score" value="{{ $applicant['score']}}">
                                  </div>
                                  <div class="form-group p-3 col-4">
                                    <label for="name">Status:</label>
                                    <input type="text" class="form-control" id="name" name="status" placeholder="Status" value="{{ $applicant['status']}}">
                                  </div>
                                  <div class="form-group p-3 col-4">
                                    <label for="name">Notes:</label>
                                    <input type="text" class="form-control" id="name" name="notes" placeholder="notes" value="{{ $applicant['notes']}}">
                                  </div>

                                  <!-- /.form-group -->
                                </div>

                              </div>
                            </div>
                            <a class="btn btn-primary" onclick="stepper.previous()">Previous</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->

          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

  </div>
  <!-- /.content-wrapper -->


  <!-- /.control-sidebar -->
</div>



@endsection