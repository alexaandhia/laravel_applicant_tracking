<div class="card-body table-responsive p-0">

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Date of interview</th>
                    <th>Interviewer</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp

                  @foreach ($applicants as $data)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->first_name}}, {{$data->last_name}}</td>
                    <td>{{$data->title ?? '-'}}</td>
                    <td>{{$data->department}}</td>
                    @php
                    $wa =substr_replace($data->phone, "62",0,1 );
                    $message = 'Hallo '. $data->first_name. ' ' .$data->last_name. '!';
                    @endphp
                    <td><a href="https://wa.me/{{$wa}}/?text=%20{{$message}}%20" target="_blank">{{$wa}}</a></td>
                    <td>{{\Carbon\Carbon::parse($data['interview'])->format(' j F Y') ?? '-'}}</td>
                    <td>{{$data->interviewer ?? '-'}}</td>
                    <td>
                      <button type="button" class="btn bg-indigo" data-toggle="modal" data-target="#modal-{{$data->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                          <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                      </button>
                    </td>



                    <div class="modal fade" id="modal-{{$data->id}}">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Applicant Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h3>{{$data->first_name}}, {{$data->last_name}}'s Data</h3>

                            <ul>
                              <li>Name: {{$data->first_name, $data['id']}}, {{$data->last_name, $data['id']}}</li>
                              <li>Position Title: {{$data->title ?? '-'}} </li>
                              <li>Description: {{$data->description ?? '-'}}</li>
                              <li>Department: {{$data->department ?? '-'}}</li>
                              <li>Experience: {{$data->experience ?? '-'}}</li>
                              <li>Phone: <a href="https://wa.me/{{$wa}}/?text=%20{{$message}}%20" target="_blank">{{$wa}}</a></li>
                              <li>Email: <a href="mailto:{{$data->email}}">{{$data->email}}</a></li>
                              <li>Resume: <a href="../assets/resume/{{$data->resume}}" target="_blank">{{$data->first_name, $data['id']}} {{$data->last_name, $data['id']}}</a><iframe src="{{ asset("assets/resume/{$data->resume}") }}" width="100%" height="500px"></iframe></li>
                              <li>Current Employer: {{$data->employer ?? '-'}}</li>
                              <li>Current Position: {{$data->position ?? '-'}}</li>
                              <li>Skill:</li>
                              <ul>@foreach ($data->skills as $skill)<li>{{ $skill->skill }}</li>@endforeach</ul>
                              <li>Date Applied: {{\Carbon\Carbon::parse($data['applied'])->format(' j F Y') ?? '-'}}</li>
                              <li>Date of interview: {{\Carbon\Carbon::parse($data['interview'])->format(' j F Y') ?? '-'}}</li>
                              <li>interviewed by: {{$data->interviewer ?? '-'}}</li>
                              <li>Interview Score: {{$data->score ?? '-'}}</li>
                              <li>Status: {{$data->status ?? '-'}}</li>
                              <li>Notes: {{$data->notes ?? '-'}}</li>
                            </ul>
                          </div>
                          <div class="modal-footer">
                            <form action="{{route('delete', $data['id'])}}" method="post">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                            <a href="{{route('edit', $data['id'])}}" class="btn btn-outline-primary">Edit</a>

                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </tr>

                </tbody>

                @endforeach
              </table>

              <div class="card-tools">
              <div class="pagination pagination-sm float-left p-3">
                {!! $applicants->links('pagination::bootstrap-5') !!}
              </div>
            </div>