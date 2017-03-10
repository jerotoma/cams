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
    @foreach($items as $item)
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
            <td >
                {{$item->unit}}
            </td>
            @if(strtolower($item->status) )
                <td style="background-color: #4CAF50">{{$item->status}}</td>
            @else
                <td style="background-color: #dd0000">{{$item->status}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>