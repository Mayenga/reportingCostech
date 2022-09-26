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
              <ul><li><h2>Activity Title : {{ $todo->title }}</h2></li></ul>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Action</th>
                  </tr>
                </thead>
              <?php
                $no = 1;
                
                $processes = DB::select("SELECT * FROM processes WHERE todo_id = $todo->id");
                
                $status = '';
                $statuss = '';
                $statusclass = '';
                $statusclasss = '';
                $statusAction = '';
                $sorted = '';
                $reason = '';
                $style = "";
                $style2 = "";
                $style3 = "";
                $report = 'display:none;';
                $items = "display:block;";

                foreach($processes As $process){
                    if($process->status == 0){
                        $status = 'Pending';
                        $statusclass = 'badge bg-warning';
                        $statusAction = 'Completed';
                        $style = "";
                    }else{
                        $status = 'Completed';
                        $statusAction = 'Pending';
                        $statusclass = 'badge bg-success';
                        $style = "pointer-events: none;text-decoration:line-through;";
                    }
               ?>
               <tbody>
                  <tr>
                    <td>{{ $no }}</td>
                    <td style="{{$style}}">{{ $process->process }}</td>
                    <td><span style="{{$style}}" class="{{ $statusclass }}">{{$status}}</span></td>
                    <td style="{{$style}}">{{ $process->progress }}%</td>
                    <td style="{{$style}}"><div style="{{ $items }}"><a style="{{ $style }}" href="{{ asset('/' . $process->id . '/editprocess') }}">Edit</a><div style="margin-left:5px;margin-right:5px;border-left: 2px solid black;display:inline;";></div><a style="{{ $style }}" onclick="return confirm('If you delete this task, you can not undo. All processes will be deleted too \n Are you sure you want to delete?')" href="{{ asset('/' . $process->id . '/deleteprocess') }}"><span style="color:red;$style">Delete</span></a><div style="margin-left:5px;margin-right:5px;border-left: 2px solid black;display:inline;";></div><a style="{{ $style }}" onclick="return confirm('If you change status, you can not undo. \n You will not be able to Edit, Delete, or change into Incomplete \n Are you sure you want to do this?')" href="{{ asset('/' . $process->id . '/complitedprocess') }}">{{ $statusAction }}</a></div></td>
                  </tr>
                </tbody>
               <?php
                $no++;
                }
              ?>
              </table>
              <!-- Floating Labels Form -->
              <form class="row g-3" action="/uploadprocesses" method="get">
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