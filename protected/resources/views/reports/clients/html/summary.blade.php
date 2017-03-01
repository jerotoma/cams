<div class="row" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-body" style="overflow-x: scroll">
                <h6 class="text-center text-bold">Summary of Active PSN cases assessed/registered by HelpAge as of {{date('jS F Y')}}</h6>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="3" class="text-center">No</th>
                        <th rowspan="3" class="text-center" >Specific Needs</th>
                        <th colspan="9" class="text-center">Active case registered </th>
                        <th colspan="9" class="text-center">Pending for Assessment/Screening Cases</th>
                        <th colspan="9" class="text-center">PSN provided with services</th>
                        <th colspan="9" class="text-center">Receiving Feedback for referred cases</th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center">0-17 years old</th>
                        <th colspan="3" class="text-center">18-49 years old</th>
                        <th colspan="3" class="text-center">50 years or older</th>
                        <th colspan="3" class="text-center">0-17 years old</th>
                        <th colspan="3" class="text-center">18-49 years old</th>
                        <th colspan="3" class="text-center">50 years or older</th>
                        <th colspan="3" class="text-center">0-17 years old</th>
                        <th colspan="3" class="text-center">18-49 years old</th>
                        <th colspan="3" class="text-center">50 years or older</th>
                        <th colspan="3" class="text-center">0-17 years old</th>
                        <th colspan="3" class="text-center">18-49 years old</th>
                        <th colspan="3" class="text-center">50 years or older</th>
                    </tr>
                    <tr>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                        <th>M</th>
                        <th>F</th>
                        <th>Total</th>
                    </tr>
                    <?php $cou=1;?>
                    @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as  $cod)
                        <tr>
                            <td>{{$cou++}}</td>
                            <td>{{$cod->description}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>