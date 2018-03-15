@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuovo appuntamenti</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form>
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="text" class="form-control" name="data" id="datepicker">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        !function(a){a.fn.datepicker.dates.it={days:["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],daysShort:["Dom","Lun","Mar","Mer","Gio","Ven","Sab"],daysMin:["Do","Lu","Ma","Me","Gi","Ve","Sa"],months:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],monthsShort:["Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic"],today:"Oggi",monthsTitle:"Mesi",clear:"Cancella",weekStart:1,format:"dd/mm/yyyy"}}(jQuery);
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            language: "it",
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection