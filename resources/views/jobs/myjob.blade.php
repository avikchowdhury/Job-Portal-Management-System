@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Your jobs</div>

                <div class="card-body">

                    <table class="table">

                        <tbody>

                            @foreach($jobs as $job)
                            <tr>
                                <td>
                                    @if(empty(Auth::user()->company->logo))

                                    <img width="100" src="{{asset('uploads/logo/logo.jpg')}}">

                                    @else
                                    <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" width="80">
                                    @endif
                                </td>
                                <td>Position:{{$job->position}}
                                    <br>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}
                                </td>
                                <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address:{{$job->address}}
                                </td>
                                <td><i class="fa fa-globe"
                                        aria-hidden="true"></i>&nbsp;Date:{{$job->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                        <button class="btn btn-success btn-sm"> Read
                                        </button>
                                    </a>
                                </td>
                                <td>

                                    <a href="{{route('job.edit',[$job->id])}}"> <button
                                            class="btn btn-dark">Edit</button></a>
                                </td>
                                <td>
                                    <form action="{{ route('job.destroy',[$job->id]) }}" method="POST">
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                        @csrf
                                        @method('DELETE')
                                       
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection