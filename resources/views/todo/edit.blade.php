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
              <h5 class="card-title">Edit Todo</h5>
              <form class="row g-3" action="/update" method="POST">
                @csrf
                <!-- @method('patch') -->
                <input style="display:none" name="id" value="{{$todo->id}}" />
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="title" value="{{ $todo->title }}" class="form-control" id="" placeholder="Activity As Per Action Plan">
                    <label for="floatingName">Activity</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                  <select name="progress" class="block mt-1 w-full border-grey-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0"></option>
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="30">30%</option>
                        <option value="40">40%</option>
                        <option value="50">50%</option>
                        <option value="60">60%</option>
                        <option value="70">70%</option>
                        <option value="80">80%</option>
                        <option value="90">90%</option>
                        <option value="100">100%</option>
                    </select>
                    
                    <label for="floatingTextarea">Progress Interms of %. Currently {{ $todo->progress }}%</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="inputDate" class="col-sm-2 col-form-label">Deadline</label>
                  <div class="col-sm-10">
                    <input type="date" value="{{ $todo->deadline }}" name="deadline" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="output" value="{{ $todo->output }}" class="form-control" id="floatingZip" placeholder="Zip">
                    <label for="floatingZip">Output</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </form><!-- End floating Labels Form -->
              <a href="{{ asset('/' . $todo->id . '/newtodoprogresses') }}" class="btn btn-primary">Add Processes</a>
            </div>
          </div>
  </div>
</section>

</main><!-- End #main -->
</x-app-layout>