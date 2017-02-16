@if($camp_id=="All")
@foreach(\App\Camp::all() as $camp)
<table border="1" style="border: 1px solid ">
    <thead>
     <tr>
         <th colspan="6">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
     </tr>
    <tr>
        <th rowspan="2">Specific Needs & Codes</th>
        <th colspan="2">0-17 Yrs</th>
        <th colspan="2">18-49 Yrs</th>
        <th colspan="2">50-59yrs</th>
        <th colspan="2">60 and ></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>F</th>
        <th>M</th>
        <th>F</th>
        <th>M</th>
        <th>F</th>
        <th>M</th>
        <th>F</th>
        <th>M</th>
        <th>F</th>
        <th>Total</th>
    </tr>
    @foreach(\App\PSNCode::all() as $code)
        <tr>
            <td>{{$code->description}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','D')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','D')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get())}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endforeach
    @else
    <?php $camp=\App\Camp::find($camp_id);?>
    <table border="1" style="border: 1px solid ">
        <thead>
        <tr>
            <th colspan="6">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
        </tr>
        <tr>
            <th rowspan="2">Specific Needs & Codes</th>
            <th colspan="2">0-17 Yrs</th>
            <th colspan="2">18-49 Yrs</th>
            <th colspan="2">50-59yrs</th>
            <th colspan="2">60 and ></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>Total</th>
        </tr>
        @foreach(\App\PSNCode::all() as $code)
            <tr>
                <td>{{$code->description}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Female')->where('age_score','=','D')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->where('sex','=','Male')->where('age_score','=','D')->whereBetween('date_arrival', $range)->get())}}</td>
                <td>{{count(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get())}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif