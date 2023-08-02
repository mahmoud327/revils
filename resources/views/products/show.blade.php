@php
    $data = $this->getData();
@endphp
<x-filament::page>
    <x-filament::card>
        <div class="title">

            <h1> {{ $data->name }}</h1>
        </div>




        <div class="content">
            <ul>
                {{-- <li>website:{{ $data->['website'] }}</li> --}}
                <li>user:{{ optional($data->user)->name }}</li>
                <li>category:{{ optional($data->category)->name }}</li>
                <li>is handcrafted:{{$data->is_handcrafted }}</li>
                <li>is liquid_shipping:{{$data->is_liquid_shipping }}</li>
                <li>is dangerous_shipping:{{$data->is_dangerous_shipping }}</li>
                <li>description:{!! $data->description!!} </li>
                <li>description:{!! $data->description!!} </li>
                <li>weight:{!! $data->weight!!} </li>
                <li>price:{!! $data->price!!} </li>
                <li>description:{!! $data->description!!} </li>
                <li>description:{!! $data->description!!} </li>

                <li>user:{{ optional($data->user)->name }}</li>


            </ul>

        </div>


    </x-filament::card>

</x-filament::page>

<style>
    .title {
        font-size: 30px;
    }

    .content {
        margin: 30px;
    }

    .content ul {
        list-style-type: circle;
    }

    .content ul li {
        padding: 5px;
        font-size: 20px;
        border-bottom-style: dotted;
        border-bottom-color: red;
    }
</style>
