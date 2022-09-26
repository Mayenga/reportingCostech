<x-app-layout>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

    <div class="card">
            @if(Session::has('error'))
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                {{ Session::get('error') }}
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(Session::has('success'))
              <div class="alert alert-success">
                {{ Session::get('success') }}
              </div>
            @endif
            <div class="card-body">
              <h5 class="card-title">Edit Activity Process</h5>
              <form class="row g-3" action="/updateprocess" method="POST">
                @csrf
                <!-- @method('patch') -->
                <input style="display:none" name="id" value="{{$process->id}}" />
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="title" value="{{ $process->process }}" class="form-control" id="" placeholder="Activity As Per Action Plan">
                    <label for="floatingName">Activity</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="progress" value="{{ $process->progress }}" placeholder="Activity Progress" id="floatingTextarea">
                    <label for="floatingTextarea">Progress interms of %</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </form><!-- End floating Labels Form -->
              <a href="{{ asset('/' . $process->id . '/newtodoprogresses') }}" class="btn btn-primary">Add Processes</a>
            </div>
          </div>
  </div>
</section>

</main><!-- End #main -->
</x-app-layout>