@extends('dashboard.partial.layout')
@section('content')
<style>


.dataTables_filter{
    float:left;
}

</style>

<section class="content mt-2">
   <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="float:right">
                  كل عمليات الفلوس الصادرة
                </h3>
                
                    <a href="" class="btn btn-danger btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       إدخال عملية صادرة
                    </a>
                 

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">إنشاء عملية صادرة</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('exports-store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">الكمية</label>
                                <input type="number" name="amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">إدخل السعر بالريال السعودي</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">سبب خروج المبلغ</label>
                                <textarea name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">التاريخ</label>
                                <input type="date" id="hijri-calendar" name="date" class="form-control"  aria-describedby="emailHelp">
                              
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">طريقة الدفع</label>
                                    <select class="form-control" name="transaction_type" id="exampleFormControlSelect1">
                                    <option value="" selected>اختر طريقة الدفع</option>
                                    <option vlaue="0">كاش</option>
                                    <option value="1">فيزا</option>
                                    
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
    
              </div>
             
              <div class="card-body">
               <table id="example" class="table table-bordered table-striped" style="font-size:15px;width:100%">
                    <thead>
                        <td>#</td>
                        <td>البروفايل</td>
                        <td>الكمية</td>
                        <td>السبب</td>
                        <td>طريقة الدفع</td>
                        <td>التاريخ</td>
                        <td>العمليات</td>
                    </thead>
                    <tbody>
                        @foreach($exports as $key=>$export)
                            <tr>
                               <td> {{ $export->id}} </td>
                               <td> {{ $export->user->name}}</td>
                               <td> {{ $export->amount}} </td>
                               <td> {{ $export->reason}} </td>
                               <td> 
                                  @if($export->transaction_type == 0)
                                    <span class="text-danger text-bold">كاش</span>
                                  @else
                                  <span class="text-success text-bold">فيزا</span>
                                  @endif
                               </td>
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
                                                    <div class="mb-3">
                                                    <div class="form-group">
                                                            <label for="exampleFormControlSelect1">طريقة الدفع</label>
                                                            <select class="form-control" name="transaction_type" id="exampleFormControlSelect1">
                                                            <option value="" selected>اختر طريقة الدفع</option>
                                                            <option vlaue="0">كاش</option>
                                                            <option value="1">فيزا</option>
                                                            
                                                            </select>
                                                        </div>
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
          
      </div>
   </div>
</section>
<!-- <script src="https://cdn.jsdelivr.net/npm/hijri-date-picker/build/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hijri-date-picker/build/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hijri-date-picker/build/js/bootstrap-hijri-datepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('#hijri-calendar').hijriDatePicker();
  });
</script> -->
@endsection