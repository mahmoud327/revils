@php
    $data = $this->getData();
@endphp
<x-filament::page>
    <x-filament::card>
        <div class="title">

            <h1> {{ $data->username }}</h1>
        </div>

        <div class="content">
            <ul>
                {{-- <li>website:{{ $data->['website'] }}</li> --}}
                <li>Email:{{ $data->email }}</li>
                <li>website:{{ optional($data->businessProfile)->website }}</li>
                <li>job title:{{ optional($data->businessProfile)->job_title }}</li>
                <li>phone:{{ optional($data->businessProfile)->phone }}</li>
                <li>street:{{ optional($data->businessProfile)->street }}</li>
                <li>street2:{{ optional($data->businessProfile)->street2 }}</li>
                <li>bio:{{ optional($data->businessProfile)->bio }}</li>


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
