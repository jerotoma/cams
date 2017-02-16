<table border="1" style="border: 1px solid ">
    <thead>
     <tr>
         <th colspan="6">Detailed Registration by Category for Nduta (1st January 31st December 2016 )</th>
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
        <th>M</th>
        <th>F</th>
        <th>M</th>
        <th></th>
    </tr>
    @foreach($codes as $code)
        <tr>
            <td>{{$code->description}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Female')->whhere('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Male')->whhere('age_score','=','A')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Female')->whhere('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Male')->whhere('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Female')->whhere('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Male')->whhere('age_score','=','C')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Female')->whhere('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <td>{{count(\App\Client::whhere('sex','=','Male')->whhere('age_score','=','B')->whereBetween('date_arrival', $range)->get())}}</td>
            <tr>
        </tr>
        @endforeach
    </tbody>
</table>