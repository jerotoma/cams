@if($status =="out")
  <table >
    <thead>
    <tr >
        <th class="text-center">
            #
        </th>
        <th class="text-center">
            Item Name
        </th>
        <th class="text-center">
            Descriptions
        </th>
        <th class="text-center">
            Category
        </th>
        <th class="text-center">
            Quantity
        </th>
        <th class="text-center">
            Unity
        </th>
        <th class="text-center">
            Status
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $count=1;?>
    @if(count(\App\ItemsInventory::where('quantity','<=',1)->get())>0)
        @foreach(\App\ItemsInventory::where('quantity','<=',1)->get() as $item)
            <tr>
                <td> {{$count++}} </td>
                <td>
                    {{$item->item_name	}}
                </td>
                <td>
                    {{$item->description}}
                </td>
                <td>
                    @if(is_object($item->category) && $item->category != null && $item->category !="")
                        {{$item->category->category_name}}
                    @endif
                </td>
                <td>
                    {{$item->quantity}}
                </td>
                <td>
                    {{$item->unit}}
                </td>
                <td>@if(strtolower($item->status) )
                        <span class="label label-success">{{$item->status}}</span>
                    @else
                        <span class="label label-danger">{{$item->status}}</span>
                    @endif
                </td>
            </tr>
        @endforeach
    @endif


    </tbody>
</table>
    @else
    <table >
        <thead>
        <tr >
            <th class="text-center">
                #
            </th>
            <th class="text-center">
                Item Name
            </th>
            <th class="text-center">
                Descriptions
            </th>
            <th class="text-center">
                Category
            </th>
            <th class="text-center">
                Quantity
            </th>
            <th class="text-center">
                Unity
            </th>
            <th class="text-center">
                Status
            </th>

        </tr>
        </thead>
        <tbody>
        <?php $count=1;?>
        @if(count(\App\ItemsInventory::all())>0)
            @foreach(\App\ItemsInventory::all() as $item)
                <tr>
                    <td> {{$count++}} </td>
                    <td>
                        {{$item->item_name	}}
                    </td>
                    <td>
                        {{$item->description}}
                    </td>
                    <td>
                        @if(is_object($item->category) && $item->category != null && $item->category !="")
                            {{$item->category->category_name}}
                        @endif
                    </td>
                    <td>
                        {{$item->quantity}}
                    </td>
                    <td>
                        {{$item->unit}}
                    </td>
                    <td>@if(strtolower($item->status) )
                            <span class="label label-success">{{$item->status}}</span>
                        @else
                            <span class="label label-danger">{{$item->status}}</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        @endif


        </tbody>
    </table>
    @endif