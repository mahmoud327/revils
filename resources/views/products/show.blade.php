@php
    $data = $this->getData();
@endphp
<x-filament::page>
    <x-filament::card>
        <div class="title">

            <h1> @lang('dashboard.products.name'):-{{ $data->name }}</h1>
        </div>





        <div class="content">
            <ul>
                  <li>@lang('dashboard.products.user'):{{ optional($data->user)->name }}</li>
                <li>@lang('dashboard.products.category'):{{ optional($data->category)->name }}</li>
                <li>@lang('dashboard.products.quantity'):{{ $data->quantity }}</li>
                <li>@lang('dashboard.products.item type'):{{ $data->item_type }}</li>
                <li>@lang('dashboard.products.unit'):{{ $data->unit }}</li>
                <li>@lang('dashboard.products.status'):{{ $data->getStatus() }}</li>
                <li>@lang('dashboard.products.cash'):{{ $data->cash }}</li>
                <li>@lang('dashboard.products.is free shipping'):{{ $data->getIsFreeShipping() }}</li>
                <li>@lang('dashboard.products.is handcrafted'):{{$data->getIsHandcrafted() }}</li>
                <li>@lang('dashboard.products.is batteries shipping'):{{$data->getIsBatteriesShipping() }}</li>
                <li>@lang('dashboard.products.is liquid shipping'):{{$data->getIsLiquidShipping() }}</li>
                <li>@lang('dashboard.products.is dangerous shipping'):{{$data->getIsDangerousShipping() }}</li>
                <li>@lang('dashboard.products.weight'):{!! $data->weight!!} </li>
                <li>@lang('dashboard.products.price'):{!! $data->price!!} </li>
                <li>@lang('dashboard.description'):{!! $data->description!!} </li>

                <ul>
                    <li>@lang('dashboard.products.attributes') </li>
                    @foreach ($data->attributeValues as $attribute)
                    {{ optional( $attribute->attribute)->name }}:

                        {{ $attribute->value }}<br><br>
                    @endforeach
                </ul>



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
