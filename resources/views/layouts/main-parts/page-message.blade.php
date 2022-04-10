
@php $messageName = $messageName ?? "page-message";@endphp
    @if(\Illuminate\Support\Facades\Session::has($messageName))
        @php $data = \Illuminate\Support\Facades\Session::get($messageName);@endphp
        @if($data["status"] == "success")
        <style>
            .alert-success{
                background-color:var(--primary);
                color:#ffff;
            }
        </style>
        @endif
        <div class="alert alert-dismissible alert-{{$data["status"]}} page-message {{$data["status"]}}" >
            <button class="close" type="button" data-dismiss="alert">×</button>
            {{$data["message"]}}.
        </div>
    @endif
