<table class="table table-hover">
    <thead>
        <tr>
            <th scope="row">#</th>
            <th>@lang('dashboard.name')</th>
            <th width="30">@lang('dashboard.description')</th>
            <th>@lang('dashboard.products.price')</th>
            <th>@lang('dashboard.products.weight')</th>
            <th>@lang('dashboard.products.unit')</th>
            <th>@lang('dashboard.products.is liquid shipping')</th>
            <th>@lang('dashboard.products.is handcrafted')</th>
            <th>@lang('dashboard.products.category')</th>
            <th>@lang('dashboard.products.status')</th>
            <th>@lang('dashboard.products.quantity')</th>
            <th>@lang('dashboard.products.user')</th>
            <th width="30">@lang('dashboard.products.attributes')</th>
            <th width="30">@lang('dashboard.products.attributes values')</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($items as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>


                <td>{{ $item->name }}</td>

                <td>{{ $item->descriptiom }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->unit }}</td>
                <td>{{ $item->is_liquid_shipping }}</td>
                <td>{{ $item->is_handcrafted }}</td>
                <td>{{ optional($item->category)->name }}</td>
                <td>{{ $item->getStatus() }}</td>
                <td>{{ $item->qunatity }}</td>
                <td>{{ optional($item->user)->name }}</td>
                <td>
                    @foreach ($item->attributes as $it)
                        {{ $it->name }}
                        ---
                    @endforeach
                </td>
                <td>
                    @foreach ($item->attributes as $it)
                        <?php
                        $attribute_value = App\Models\Product\AttributeValue::find(optional($it->pivot)->attribute_value_id);
                        ?>

                        {{ $attribute_value->value }}
                        ---
                    @endforeach
                </td>




            </tr>
        @endforeach



    </tbody>
</table>
