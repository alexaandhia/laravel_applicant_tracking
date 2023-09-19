@extends('layout.main')
@section('content')
<div class="wrapper">

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Applicant Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Applicant Data</li>
            </ol>
          </div>
        </div>
        @if (Session::get('errors'))
        <p class="alert alert-danger">{{Session::get('errors')}}</p>
        @endif
        @if (Session::get('success'))
        <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        <div class="card">
          <div class="row g-3 p-2">
            <div class="col ">
              <a href="/data" class="btn btn-default p-2"><svg xmlns="http://www.w3.org/2000/svg" height="30px" width="30px" viewBox="0 0 512 512">
                  <path d="M142.9 142.9c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5c0 0 0 0 0 0H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5c7.7-21.8 20.2-42.3 37.8-59.8zM16 312v7.6 .7V440c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l41.6-41.6c87.6 86.5 228.7 86.2 315.8-1c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.2 62.2-162.7 62.5-225.3 1L185 329c6.9-6.9 8.9-17.2 5.2-26.2s-12.5-14.8-22.2-14.8H48.4h-.7H40c-13.3 0-24 10.7-24 24z" />
                </svg></a>
            </div>
            <div class="col">
              <form action="{{ route('data') }}" method="GET" >
                <select name="department" class="form-control">
                  <option value="" selected disabled>Search by Department</option>
                  <option value="backend">Backend</option>
                  <option value="frontend">Frontend</option>
                  <option value="fullstack">Fullstack</option>
                  <option value="mobile">Mobile</option>
                </select>
              </div>
              <div class="col">
                <div class="select2-purple">
                  <select class="select2" multiple="multiple" data-placeholder="Select Skills" data-dropdown-css-class="select2-purple" style="width: 100%;" name="skill[]">
                    <option value="">Choose Skill</option>
                    @foreach ($skills as $data)
                    <option value="{{$data->id}}">{{$data->skill}}</option>
                    @endforeach
                  </select>
                  <div class="col">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  </div>
                </div>
              </form>
              </div>
          </div>
          <!-- /.card-header -->
          <div id="table_data">
            @include('data_table')
          </div>


          <!-- /.card-body -->
        </div>
    </section>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
    });

    function fetch_data(page) {
      $.ajax({
        url: "/data/fetch_data?page=" + page,
        success: function(data) {
          $('#table_data').html(data);
        }
      });
    }
  });
</script>
@endsection