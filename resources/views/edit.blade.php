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

                        <form method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="text" class="form-control" name="data" id="datepicker" value="{{ $giorno }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nome">Nome mutuato</label>
                                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Scrivi cognome e nome" name="nome" value="{{ $nome }}"  required>
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" aria-describedby="note" placeholder="Note aggiuntive (opzionale)" value="{{ $note }}" name="note">
                            </div>

                            <div class="form-group">
                                <label for="orario">Orario</label>
                                <select class="form-control" id="orario" name="orario" required>
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

        function load() {
            $("#orario").empty();
            var dataSelezionata = 'data='+$('#datepicker').val();
            $.ajax({
                type: "GET",
                url : "{{url('ajax')}}",
                data : dataSelezionata,
                success : function(data){
                    if (data.response != '')
                    {
                        array = data.response;
                        array.forEach(function(element) {
                            if(element.attivo==0) {
                                if(element.disponibile==1) {
                                    $("#orario").append("<option class='text-danger' value='"+element.id+"'>"+element.ora+"</option>");
                                } else {
                                    if(element.id == {{  $orario_id }}) {
                                        $("#orario").append("<option selected class='text-muted' value='"+element.id+"'>"+element.ora+"</option>");
                                    } else {
                                        $("#orario").append("<option disabled class='text-muted' value='"+element.id+"'>"+element.ora+"</option>");
                                    }
                                }
                            } else {
                                if(element.disponibile==1) {
                                    $("#orario").append("<option class='text-dark' value='"+element.id+"'>"+element.ora+"</option>");
                                } else {
                                    if(element.id == {{  $orario_id }}) {
                                        $("#orario").append("<option selected class='text-muted' value='"+element.id+"'>"+element.ora+"</option>");
                                    } else {
                                        $("#orario").append("<option disabled class='text-muted' value='"+element.id+"'>"+element.ora+"</option>");
                                    }
                                }

                            }

                        });
                    }
                }
            });
        }

        // Ogni volta che cambio la data devo caricare il select con i dati di appuntamenti e orari in base al giorno della settimana e appuntamenti già presi
        $('#datepicker').on('change',function(e){
            load();
        });

        load();
    </script>
@endsection