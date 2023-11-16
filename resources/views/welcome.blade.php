@extends('dashboard.partial.layout')
@section('content')
<?php 
$totalSumExports = DB::table('exports')->sum('amount');
$totalSumImports = DB::table('imports')->sum('amount');

?>
<div class="col-lg-12">
   <div class="row">
     <div class="card col-lg-12">
        <div class="card-header">
           <h3>مرحبا {{Auth::user()->name}}</h3>
        
        </div>
        
        <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$totalSumExports}} ريال</h3>

                <p>مجموع الخارج</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('exports-index')}}" class="small-box-footer">للتفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalSumImports}} ريال</h3>

                <p>مجموع الداخل</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('imports-index')}}" class="small-box-footer">للتفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
               
                <h3>{{$totalSumExports - $totalSumImports}} ريال</h3>

                <p>الريح</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="card col-lg-12">
            <div class="card-header">
              <h3>اخر عمليات الخارج</h3>
            </div>
            <div class="card-body">
               <table id="example" class="table table-bordered table-striped" style="font-size:15px;width:100%">
                    <thead>
                        <td>#</td>
                        <td>البروفايل</td>
                        <td>الكمية</td>
                        <td>السبب</td>
                        <td>التاريخ</td>
                        <td>العمليات</td>
                    </thead>
                    <tbody>
                        @foreach($exports as $key=>$export)
                            <tr>
                               <td> {{ $export->id}} </td>
                               <td> {{ $export->user->name}}</td>
                               <td> {{ $export->reason}} </td>
                               <td> {{ $export->amount}} </td>
                               <td> {{ $export->date}}</td>
                               <td>
                                    <a  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$export->id}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                     <!-- Modal -->
                                     <div class="modal fade" id="exampleModal{{$export->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$export->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$export->id}}">تعديل العملية</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="{{route('exports-update')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$export->id}}" name="id">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">الكمية</label>
                                                        <input type="number" name="amount" value="{{$export->amount}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        <div id="emailHelp" class="form-text">إدخل السعر بالريال السعودي</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">سبب خروج المبلغ</label>
                                                        <textarea name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$export->reason}}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">التاريخ</label>
                                                        <input type="date" value="{{$export->date}}" id="hijri-calendar" name="date" class="form-control"  aria-describedby="emailHelp">
                                                    
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                               
                                    <a href="{{ route('exports-delete',$export->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                               </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

              </div>
          </div>
        </div>

        <div class="row">
          <div class="card col-lg-12">
           <div class="card-header">
             <h3>اخر عمليات الداخل</h3>
           </div>
           <div class="card-body">
               <table id="example" class="table table-bordered table-striped" style="font-size:15px;width:100%">
                    <thead>
                        <td>#</td>
                        <td>البروفايل</td>
                        <td>الكمية</td>
                        <td>السبب</td>
                        <td>التاريخ</td>
                        <td>العمليات</td>
                    </thead>
                    <tbody>
                        @foreach($imports as $key=>$import)
                            <tr>
                               <td> {{ $import->id}} </td>
                               <td> {{ $import->user->name}}</td>
                               <td> {{ $import->reason}} </td>
                               <td> {{ $import->amount}} </td>
                               <td> {{ $import->date}}</td>
                               <td>
                                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$import->id}}">
                                        <i class="fas fa-edit"></i>
                                         
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$import->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$import->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$import->id}}">تعديل العملية</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="{{route('imports-update')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$import->id}}" name="id">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">الكمية</label>
                                                        <input type="number" name="amount" value="{{$import->amount}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        <div id="emailHelp" class="form-text">إدخل السعر بالريال السعودي</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">سبب خروج المبلغ</label>
                                                        <textarea name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$import->reason}}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">التاريخ</label>
                                                        <input type="date" value="{{$import->date}}" id="hijri-calendar" name="date" class="form-control"  aria-describedby="emailHelp">
                                                    
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                               
                                    <a href="{{ route('imports-delete',$import->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
   </div>

</div>

@endsection