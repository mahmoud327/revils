@php
    $data = $this->getData();
@endphp
<x-filament::page>
    <x-filament::card>
        <div class="title">

            <h1> {{ $data['username'] }}</h1>
        </div>

        <div class="content">
            <ul>
                {{-- <li>website:{{ $data->['website'] }}</li> --}}
                <li>Email:{{ $data->email }}</li>
                <li>website:{{ optional($data->userProfile)->website }}</li>
                <li>job title:{{ optional($data->userProfile)->job_title }}</li>
                <li>phone:{{ optional($data->userProfile)->phone }}</li>
                <li>street:{{ optional($data->userProfile)->street1 }}</li>
                <li>street2:{{ optional($data->userProfile)->street2 }}</li>
                <li>company title:{{ optional($data->userProfile)->company_title }}</li>


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
