    <!-- Scripts -->




    <!-- css local tailwind 1.0 -->
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/format.css') }}" rel="stylesheet">


    <!-- Scripts local datepicker 
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    

    <script src="{{ asset('js/loader.js') }}"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">


<style>
    .cuerpo {
  height: 890px;
  width: 1218px;
  background-color: white;
}

.footer {
  width: 1218px;
}


    .border {
   border:2px solid black;
   border-radius:22px;
   margin: 4px;
}

    .logoBachoco{
    position:absolute;

    margin: 7px;


}

    .texto-vertical-2 {
    writing-mode: vertical-lr;
    transform: rotate(180deg);
}


    .velocidadUno{
    height: 313px;
    background-color: white;
}


    .altoVelocidades{
    height: 335px;
    background-color: white;
    }

    .velocidadDos{
    height: 152px;
    background-color: white;
    }







</style>
<div class="cuerpo border bg-white">

    <div class="grid grid-cols-12 mb-0">
        <div class="col-span-3 flex justify-center items-center m-2 ml-3 mb-0" style="height: 50px" ><img src="{{URL::asset('/images/logo-bachoco.png')}}" style="height: 30px;"></div>

        <div class="col-span-6 flex justify-center items-center text-3xl">
            <p class="font-sans md:font-serif" >
                Información de flota {{$cedis}} {{$operacion}}
            </p>
        </div>
        <div class="col-span-3 flex justify-center items-center mr-2 ml-0 text-sm" style="align-content: right">
            <p class="font-sans md:font-serif font-bold"><br>
            Torre de monitoreo T2&nbsp;
            </p>
            <img src="{{URL::asset('/images/torre-monitoreo.png')}}" style="height: 40px; ">
        </div>

    </div>


        <div class="grid grid-cols-12 gap-1 m-2 mt-0" style="border: 1px solid #ff4040">
            
            <div class="col-span-5 m-2" id="disponibilidad" style="border: 1px solid #000"></div>
            <div class="col-span-7 m-2" id="utilizacionFlota"></div>

        </div>

        <div class="grid grid-cols-12 gap-1 m-2" style="border: 1px solid #ff4040">
            <div class="col-span-7 text-center"><p class="font-sans md:font-serif">Unidades en ruta</p></div>
            <div class="col-span-5 text-center"><p class="font-sans md:font-serif">Otras unidades</p></div>
            <div class="col-span-7 m-2 mt-0 flex justify-center items-center" id="informacionFlota"  style="border: 1px solid #000"></div>
            <div class="col-span-5 m-2 mt-0" id="otrasUnidades" style="border: 1px solid #000"></div>
                                


        </div>
</div>

<div class="footer bg-white">

    <div class="grid grid-cols-12 m-0 text-xs">
        <div class="col-span-9 text-sm">
            <p class="font-sans md:font-serif text-left">
                Gráficos generados con la información recopilada a lo largo de la operación correspondiente.
                Dudas y comentarios con tu analista en turno.
            </p>
        </div>
        
        <div class="col-span-3 text-sm mr-2">
            <p class="text-right font-sans md:font-serif ">Fecha de operación: {{$fechaDMY}}</p>
        </div>

    </div>
</div>



<script>


                //informacion de flota
                $(document).ready(function(){
                //hacemos focus al campo de búsqueda

                var fecha = '{{$fecha}}';
                var operacion = '{{$operacion}}';
                var cedis = '{{$cedis}}';
                

                function generarInformacionFlota(){          
                    //hace la búsqueda
                    $.ajax({


                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    operacion:operacion,
                    fecha:fecha,
                    cedis:cedis
                },
                type: "POST", // GET or POST
                    url: "{{ route('choferes.informacionFlota') }}", // the file to call
                    dataType: 'html',   
                    success: function(informacionFlota) {

                    if (informacionFlota) {
                        console.log(informacionFlota);

                        $('#informacionFlota').html(informacionFlota);
                        alert("Información de flota lista!");



                    } else {

                        $("#informacionFLota").empty();
                    }
                    }



                });
                }

                generarInformacionFlota();

                });


                    //generar disponibilidad
                    $(document).ready(function(){
                    //hacemos focus al campo de búsqueda

                    var fecha = '{{$fecha}}';
                    var operacion = '{{$operacion}}';
                    var cedis = '{{$cedis}}';

                    function generarDisponibilidadFlota(){          
                        //hace la búsqueda
                        $.ajax({ // create an AJAX call...
                        data:  {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            operacion:operacion,
                            fecha:fecha,
                            cedis:cedis

                        },

                        type: "POST", // GET or POST
                        url: "{{ route('unidades.disponibilidadFlota') }}", // the file to call
                        dataType: 'html',   
                        success: function(informacionFlota) {

                        if (informacionFlota) {
                            console.log(informacionFlota);

                            $('#disponibilidad').html(informacionFlota);
                            alert("¡Disponibilidad de flota lista!");

                        } else {

                            $("#cedis").empty();
                        }
                        }

                        
                        
                    });
                    }

                    generarDisponibilidadFlota();

                    });


                //generar utilizacion de flota
                $(document).ready(function(){
                //hacemos focus al campo de búsqueda

                var fecha = '{{$fecha}}';
                var operacion = '{{$operacion}}';
                var cedis = '{{$cedis}}';

                function generarUtilizacionFlota(){          
                    //hace la búsqueda
                    $.ajax({ // create an AJAX call...
                    data:  {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        operacion:operacion,
                        fecha:fecha,
                        cedis:cedis

                    },

                    type: "POST", // GET or POST
                    url: "{{ route('unidades.utilizacionFlota') }}", // the file to call
                    dataType: 'html',   
                    success: function(utilizacionFlota) {

                    if (utilizacionFlota) {
                        console.log(utilizacionFlota);

                        $('#utilizacionFlota').html(utilizacionFlota);
                        alert("¡Utilización de flota listo!");



                    } else {

                        $("#utilizacionFLota").empty();
                    }
                    }



                });
                }

                generarUtilizacionFlota();

                });


                //generar otras unidades
                $(document).ready(function(){
                //hacemos focus al campo de búsqueda

                var fecha = '{{$fecha}}';
                var operacion = '{{$operacion}}';
                var cedis = '{{$cedis}}';

                function generarOtrasUnidades(){          
                    //hace la búsqueda
                    $.ajax({ // create an AJAX call...
                    data:  {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        operacion:operacion,
                        fecha:fecha,
                        cedis:cedis

                    },

                    type: "POST", // GET or POST
                    url: "{{ route('unidades.otrasUnidades') }}", // the file to call
                    dataType: 'html',   
                    success: function(otrasUnidades) {

                    if (otrasUnidades) {
                        console.log(otrasUnidades);

                        $('#otrasUnidades').html(otrasUnidades);
                        alert("¡Otras unidades listas!");



                    } else {

                        $("#otrasUnidades").empty();
                    }
                    }



                });
                }

                generarOtrasUnidades();

                });

</script>