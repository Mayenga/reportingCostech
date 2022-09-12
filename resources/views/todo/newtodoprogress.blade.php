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
            <div class="card-body">
              <?php 
                $carbon = \Carbon\Carbon::now();  
                $d1 = date('d');
                $to = 0;
                $leo = $carbon->dayOfWeek;
                if($leo < 7){
                  $cd = 6 - $leo;
                  $to = $d1 + $cd;
                }
                $d2 = $to;
              ?>
              <h5 class="card-title">Add Activity Processes and Progress</h5>
              <!-- and {{$d2}} -->
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
              <?php
                    $todoname = DB::select("SELECT title FROM todos WHERE id IN(SELECT MAX(id) FROM todos)");
                    foreach($todoname As $name){
                        $name = $name->title;
                    }
                ?>
              <ul><li><h2>Activity Title : {{ $name }}</h2></li></ul>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Process</th>
                    <th>Status</th>
                    <th>Progress</th>
                  </tr>
                </thead>
              <?php
                $id = 0;
                $todoid = DB::select("SELECT MAX(id) AS id FROM todos");
                foreach($todoid As $id){
                    $id = $id->id;
                }
                $processes = DB::select("SELECT * FROM processes WHERE todo_id = $id");
                
                foreach($processes As $process){
                    if($process->status == 0){
                        $status = 'Pending';
                        $statusclass = 'badge bg-warning';
                    }
               ?>
               <tbody>
                  <tr>
                    <td>{{ $process->process }}</td>
                    <td><span class="{{ $statusclass }}">{{$status}}</span></td>
                    <td>{{ $process->progress }}%</td>
                  </tr>
                </tbody>
               <?php
                }
              ?>
              </table>
              <!-- Floating Labels Form -->
              <form class="row g-3" action="/uploadprocess" method="get">
                @csrf
                <div class="col-6">
                  <div class="form-floating">
                    <input type="text" name="process" class="form-control" id="" placeholder="Activity As Per Action Plan">
                    <?php echo "<input type='hidden' name='todoid' value=$id>"; ?>
                    <label for="floatingTextarea">Process</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Add Processes</button> | <a href="dashboard/todolist">Add later</a>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
  </div>
</section>

</main><!-- End #main -->
</x-app-layout>