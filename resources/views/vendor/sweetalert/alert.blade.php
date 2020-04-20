@if (Session::has('alert.config'))
    @if(config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    <script src="{{ $cdn?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
    <script>
        Swal.fire({!! Session::pull('alert.config') !!});
    </script>
@endif
@if ($errors->any())
@php
    $temp = "<ul>";

    foreach ($errors->all() as $error){

        $temp .= "<li>".$error."</li>";
    }
    
    $temp .= "</ul>";
@endphp
 <script src="{{ $cdn?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
    <script>
        Swal.fire({
            html: "{!! $temp !!}",
            title: "Erro",
            icon: 'error',
            // more options
        });
    </script>
@endif
