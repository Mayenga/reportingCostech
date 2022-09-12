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

<section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Recent Sales -->
        <div class="col-12">
              <div class="card recent-sales">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('todolistall') }}">All Activities</a></li>
                    <li><a class="dropdown-item" href="{{ route('todolistThisWeek') }}">This Week</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <?php 
                    $weak = '';
                    if($week){
                      $weak = 'This Week';
                    }else{
                      $weak = 'All';
                    }
                  ?>
                  <h5 class="card-title">Activity List<span>| <?php echo $weak ?></span></h5>
                  <!-- <a href="{{ route('getReport') }}" target="blank" class="badge bg-primary">PDF</a> -->
                  <h6>
                    <x-alert />
                  </h6>
                  <h3><a target="_blank" href="https://www.gyrocode.com/articles/jquery-datatables-how-to-expand-collapse-all-child-rows/">jQuery DataTables: How to expand/collapse all child rows</a> <small>Responsive extension</small></h3>

<button id="btn-show-all-children" type="button">Expand All</button>
<button id="btn-hide-all-children" type="button">Collapse All</button>
<hr>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th class="none">Age</th>
            <th class="none">Start date</th>
            <th class="none">Salary</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </tfoot>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
        </tr>
        <tr>
            <td>Ashton Cox</td>
            <td>Junior Technical Author</td>
            <td>San Francisco</td>
            <td>66</td>
            <td>2009/01/12</td>
            <td>$86,000</td>
        </tr>
        <tr>
            <td>Bradley Greer</td>
            <td>Software Engineer</td>
            <td>London</td>
            <td>41</td>
            <td>2012/10/13</td>
            <td>$132,000</td>
        </tr>
        <tr>
            <td>Dai Rios</td>
            <td>Personnel Lead</td>
            <td>Edinburgh</td>
            <td>35</td>
            <td>2012/09/26</td>
            <td>$217,500</td>
        </tr>
        <tr>
            <td>Jenette Caldwell</td>
            <td>Development Lead</td>
            <td>New York</td>
            <td>30</td>
            <td>2011/09/03</td>
            <td>$345,000</td>
        </tr>
        <tr>
            <td>Yuri Berry</td>
            <td>Chief Marketing Officer (CMO)</td>
            <td>New York</td>
            <td>40</td>
            <td>2009/06/25</td>
            <td>$675,000</td>
        </tr>
        <tr>
            <td>Caesar Vance</td>
            <td>Pre-Sales Support</td>
            <td>New York</td>
            <td>21</td>
            <td>2011/12/12</td>
            <td>$106,450</td>
        </tr>
        <tr>
            <td>Doris Wilder</td>
            <td>Sales Assistant</td>
            <td>Sidney</td>
            <td>23</td>
            <td>2010/09/20</td>
            <td>$85,600</td>
        </tr>
        <tr>
            <td>Angelica Ramos</td>
            <td>Chief Executive Officer (CEO)</td>
            <td>London</td>
            <td>47</td>
            <td>2009/10/09</td>
            <td>$1,200,000</td>
        </tr>
        <tr>
            <td>Gavin Joyce</td>
            <td>Developer</td>
            <td>Edinburgh</td>
            <td>42</td>
            <td>2010/12/22</td>
            <td>$92,575</td>
        </tr>
        <tr>
            <td>Jennifer Chang</td>
            <td>Regional Director</td>
            <td>Singapore</td>
            <td>28</td>
            <td>2010/11/14</td>
            <td>$357,650</td>
        </tr>
        <tr>
            <td>Brenden Wagner</td>
            <td>Software Engineer</td>
            <td>San Francisco</td>
            <td>28</td>
            <td>2011/06/07</td>
            <td>$206,850</td>
        </tr>
        <tr>
            <td>Fiona Green</td>
            <td>Chief Operating Officer (COO)</td>
            <td>San Francisco</td>
            <td>48</td>
            <td>2010/03/11</td>
            <td>$850,000</td>
        </tr>
        <tr>
            <td>Shou Itou</td>
            <td>Regional Marketing</td>
            <td>Tokyo</td>
            <td>20</td>
            <td>2011/08/14</td>
            <td>$163,000</td>
        </tr>
        <tr>
            <td>Michelle House</td>
            <td>Integration Specialist</td>
            <td>Sidney</td>
            <td>37</td>
            <td>2011/06/02</td>
            <td>$95,400</td>
        </tr>
        <tr>
            <td>Suki Burks</td>
            <td>Developer</td>
            <td>London</td>
            <td>53</td>
            <td>2009/10/22</td>
            <td>$114,500</td>
        </tr>
        <tr>
            <td>Prescott Bartlett</td>
            <td>Technical Author</td>
            <td>London</td>
            <td>27</td>
            <td>2011/05/07</td>
            <td>$145,000</td>
        </tr>
        <tr>
            <td>Gavin Cortez</td>
            <td>Team Leader</td>
            <td>San Francisco</td>
            <td>22</td>
            <td>2008/10/26</td>
            <td>$235,500</td>
        </tr>
        <tr>
            <td>Martena Mccray</td>
            <td>Post-Sales support</td>
            <td>Edinburgh</td>
            <td>46</td>
            <td>2011/03/09</td>
            <td>$324,050</td>
        </tr>
        <tr>
            <td>Unity Butler</td>
            <td>Marketing Designer</td>
            <td>San Francisco</td>
            <td>47</td>
            <td>2009/12/09</td>
            <td>$85,675</td>
        </tr>
        <tr>
            <td>Howard Hatfield</td>
            <td>Office Manager</td>
            <td>San Francisco</td>
            <td>51</td>
            <td>2008/12/16</td>
            <td>$164,500</td>
        </tr>
        <tr>
            <td>Hope Fuentes</td>
            <td>Secretary</td>
            <td>San Francisco</td>
            <td>41</td>
            <td>2010/02/12</td>
            <td>$109,850</td>
        </tr>
        <tr>
            <td>Vivian Harrell</td>
            <td>Financial Controller</td>
            <td>San Francisco</td>
            <td>62</td>
            <td>2009/02/14</td>
            <td>$452,500</td>
        </tr>
        <tr>
            <td>Timothy Mooney</td>
            <td>Office Manager</td>
            <td>London</td>
            <td>37</td>
            <td>2008/12/11</td>
            <td>$136,200</td>
        </tr>
        <tr>
            <td>Jackson Bradshaw</td>
            <td>Director</td>
            <td>New York</td>
            <td>65</td>
            <td>2008/09/26</td>
            <td>$645,750</td>
        </tr>
        <tr>
            <td>Olivia Liang</td>
            <td>Support Engineer</td>
            <td>Singapore</td>
            <td>64</td>
            <td>2011/02/03</td>
            <td>$234,500</td>
        </tr>
        <tr>
            <td>Bruno Nash</td>
            <td>Software Engineer</td>
            <td>London</td>
            <td>38</td>
            <td>2011/05/03</td>
            <td>$163,500</td>
        </tr>
        <tr>
            <td>Sakura Yamamoto</td>
            <td>Support Engineer</td>
            <td>Tokyo</td>
            <td>37</td>
            <td>2009/08/19</td>
            <td>$139,575</td>
        </tr>
        <tr>
            <td>Thor Walton</td>
            <td>Developer</td>
            <td>New York</td>
            <td>61</td>
            <td>2013/08/11</td>
            <td>$98,540</td>
        </tr>
        <tr>
            <td>Finn Camacho</td>
            <td>Support Engineer</td>
            <td>San Francisco</td>
            <td>47</td>
            <td>2009/07/07</td>
            <td>$87,500</td>
        </tr>
        <tr>
            <td>Serge Baldwin</td>
            <td>Data Coordinator</td>
            <td>Singapore</td>
            <td>64</td>
            <td>2012/04/09</td>
            <td>$138,575</td>
        </tr>
        <tr>
            <td>Zenaida Frank</td>
            <td>Software Engineer</td>
            <td>New York</td>
            <td>63</td>
            <td>2010/01/04</td>
            <td>$125,250</td>
        </tr>
        <tr>
            <td>Zorita Serrano</td>
            <td>Software Engineer</td>
            <td>San Francisco</td>
            <td>56</td>
            <td>2012/06/01</td>
            <td>$115,000</td>
        </tr>
        <tr>
            <td>Jennifer Acosta</td>
            <td>Junior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>43</td>
            <td>2013/02/01</td>
            <td>$75,650</td>
        </tr>
        <tr>
            <td>Cara Stevens</td>
            <td>Sales Assistant</td>
            <td>New York</td>
            <td>46</td>
            <td>2011/12/06</td>
            <td>$145,600</td>
        </tr>
        <tr>
            <td>Hermione Butler</td>
            <td>Regional Director</td>
            <td>London</td>
            <td>47</td>
            <td>2011/03/21</td>
            <td>$356,250</td>
        </tr>
        <tr>
            <td>Lael Greer</td>
            <td>Systems Administrator</td>
            <td>London</td>
            <td>21</td>
            <td>2009/02/27</td>
            <td>$103,500</td>
        </tr>
        <tr>
            <td>Jonas Alexander</td>
            <td>Developer</td>
            <td>San Francisco</td>
            <td>30</td>
            <td>2010/07/14</td>
            <td>$86,500</td>
        </tr>
        <tr>
            <td>Shad Decker</td>
            <td>Regional Director</td>
            <td>Edinburgh</td>
            <td>51</td>
            <td>2008/11/13</td>
            <td>$183,000</td>
        </tr>
        <tr>
            <td>Michael Bruce</td>
            <td>Javascript Developer</td>
            <td>Singapore</td>
            <td>29</td>
            <td>2011/06/27</td>
            <td>$183,000</td>
        </tr>
        <tr>
            <td>Donna Snider</td>
            <td>Customer Support</td>
            <td>New York</td>
            <td>27</td>
            <td>2011/01/25</td>
            <td>$112,000</td>
        </tr>
    </tbody>
</table>

                  <table id="example" style="width:100%" class="display">
                    <thead>
                    <?php 
                      if($todos == ''){
                        echo '<h5>You havent register any Activity at the moment.</h5><br />
                        To register New Activity click \'Create Activity\' under \'Activities\' menu.';
                      }else{
                        if (Auth::user()->hasRole('dg') || Auth::user()->hasRole('director')){
                          echo '<tr>
                            <th scope="col">#</th>
                            <th scope="col">Activity</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Output</th>
                            <th scope="col">Transfered</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>';
                        }else{
                          echo '<tr>
                          <th scope="col">#</th>
                          <th scope="col">Activity</th>
                          <th scope="col">Output</th>
                          <th scope="col">Deadline</th>
                          <th scope="col">Progress</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>';
                        }
                      }
                    
                    ?>
                    </thead>
                    <tbody>
                      <?php $counter = 1; ?>
                      @foreach($todos as $todo)
                        <?php 
                        // $date1=date_create("2022-05-15");
                        // $date2=date_create("2013-12-12");
                        // $diff=date_diff($date1,$date2);
                        // echo $diff->format("%R%a days");

                        $d1 = date_create(date("Y-m-d"));
                        $d2 = date_create($todo->deadline);
                        // echo date_diff($d1,$d2);
                          
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
                          
                          if($todo->complited){
                            $statusclass = 'badge bg-success';
                            $status = 'Completed';
                            $statusAction = 'Completed';
                            $style = "pointer-events: none;";
                            $style2 = "pointer-events: none;";
                          }else{
                            $statusclass = 'badge bg-warning';
                            $status = 'Pending';
                            $statusAction = 'Completed';
                          }
                          if($d2 >= $d1){
                            $items = "display:block;";
                            $report = 'display:none;';
                            $sorted = 'display:none;';
                            $reason = 'display:none;';
                          }else{
                            if($todo->complited){
                              $items = "display:block;";
                              $report = 'display:none;';
                              $status = 'Completed';
                              $sorted = 'display:none;';
                              $reason = 'display:none;';
                              $statusclass = 'badge bg-success';
                            }else{
                              if($todo->reason == 'No reason'){
                                if (Auth::user()->hasRole('dg') || Auth::user()->hasRole('director') && $todo->transfered && $todo->reason == 'No reason'){
                                  $items = "display:none;";
                                  $report = 'display:none;';
                                  $sorted = 'display:none;';
                                  $reason = 'display:block;';
                                  $status = 'Pending And Delayed';
                                  $statusclass = 'badge bg-danger'; 
                                }else{
                                  $items = "display:none;";
                                  $report = 'display:block;';
                                  $sorted = 'display:none;';
                                  $reason = 'display:none;';
                                  $status = 'Pending And Delayed';
                                  $statusclass = 'badge bg-danger'; 
                                }
                              }else{
                                $items = "display:none;";
                                $report = 'display:none;';
                                $reason = 'display:none;';
                                $sorted = 'display:block; color:green;';
                                $status = 'Delayed but Sorted';
                                $statusclass = 'badge bg-warning';
                              }
                            }
                          }
                          if($todo->transfered){
                            $statusclasss = 'badge bg-success';
                            $statuss = 'Transfered';
                            $statusActionn = 'Transfered';
                            $style2 = "color:grey";
                            if (Auth::user()->hasRole('dg')){
                              if($todo->transferedWho == 1){
                                $style3 = "pointer-events: none;";
                              }
                              if($todo->transferedWho == 2){
                                $style = "pointer-events: none;";
                              }
                            }
                            if(Auth::user()->hasRole('director')){
                              if($todo->transferedWho == 1 && $todo->reason == 'No reason'){
                                $style = "pointer-events: none;";
                                $reason = 'display:none;';
                                $report = 'display:none;';
                                if($d2 >= $d1){
                                }else{
                                  $report = 'display:block;';  
                                }
                              }
                              if($todo->transferedWho == 2){
                                $style3 = "pointer-events: none;";
                              }
                            }
                            if (Auth::user()->hasRole('user')){
                              $style = "pointer-events: none;";
                              $style3 = "";
                            }
                            if($todo->complited){
                              if (Auth::user()->hasRole('director')){
                                $items = "display:block;";
                                $report = 'display:none;';
                                $status = 'Completed';
                                $sorted = 'display:none;';
                                $reason = 'display:none;';
                                $statusclass = 'badge bg-success';
                                $style3 = "pointer-events: none;";
                                $style = "pointer-events: none;";
                              }else{
                                $items = "display:block;";
                                $report = 'display:none;';
                                $status = 'Completed';
                                $sorted = 'display:none;';
                                $reason = 'display:none;';
                                $statusclass = 'badge bg-success';
                                $style3 = "pointer-events: none;";
                                $style = "pointer-events: none;";
                              }
                            }
                          }
                        ?>
                        <tr style="{{$style2}}">
                          <th scope="row"><a href="#">{{$counter}}</a></th>
                          <td>
                            @if($todo->complited)
                              <span style="text-decoration:line-through">{{$todo->title}}</span>
                            @else
                              {{$todo->title}}
                            @endif
                          </td>
                          <td>
                            @if($todo->complited)
                                <span style="text-decoration:line-through">{{$todo->output}}</span>
                            @else
                              {{$todo->output}}
                            @endif
                          </td>
                          <td>
                            @if($todo->complited)
                                <span style="text-decoration:line-through">{{$todo->deadline}}</span>
                            @else
                              {{$todo->deadline}}
                            @endif
                          </td>
                          <td>
                            @if($todo->complited)
                                <span style="text-decoration:line-through">{{$todo->progress}}%</span>
                            @else
                              {{$todo->progress}}%
                            @endif
                          </td>
                          @if (Auth::user()->hasRole('dg') || Auth::user()->hasRole('director'))
                          <td><span class="{{ $statusclasss }}">{{$statuss}}</span></td>
                          @endif
                          <td><span class="{{ $statusclass }}">{{$status}}</span></td>
                          <td><div style="{{ $items }}"><a style="{{ $style }}" href="{{ asset('/' . $todo->id . '/edit') }}">Edit</a><div style="margin-left:5px;margin-right:5px;border-left: 2px solid black;display:inline;";></div><a style="{{ $style }}" onclick="return confirm('If you delete this task, you can not undo. \n Are you sure you want to delete?')" href="{{ asset('/' . $todo->id . '/delete') }}"><span style="color:red;$style">Delete</span></a><div style="margin-left:5px;margin-right:5px;border-left: 2px solid black;display:inline;";></div><a style="{{ $style3 }}" onclick="return confirm('If you change status, you can not undo. \n You will not be able to Edit, Delete, or change into Incomplete \n Are you sure you want to do this?')" href="{{ asset('/' . $todo->id . '/complited') }}">{{ $statusAction }}</a></div><div style="{{ $report }}"><form class="form-inline" action="/sendDelaymessage" method="post">@csrf<input type="hidden" name="id" value=" {{ $todo->id }}"/><input class="form-control-sm" type="text" placeholder="Why not completed ontime" name="Reason"> <button type="submit" class="btn btn-primary mb-2">Send</button></form></div><div style="{{ $sorted }}"><button onclick="taggleReason()" class="tb btn btn-primary mb-1">View Reason</button><span class="reason">{{ $todo->reason }}</span></div><div style="{{ $reason }}">Pending Reason</div></td>
                        </tr>
                        <?php $counter++; ?>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

      </div>
    </div><!-- End Left side columns -->

  </div>
</section>

</main><!-- End #main -->
</x-app-layout>