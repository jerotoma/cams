@extends('layout.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_select.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/selectboxit.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tagsinput.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tokenfield.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/touchspin.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/maxlength.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/formatter.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/moment/moment.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/daterangepicker.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/anytime.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.time.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/legacy.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/wysihtml5.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/toolbar.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/parsers.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/jgrowl.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/form_floating_labels.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/picker_date.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/editor_wysihtml5.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('page_css')
<style>
    .list-group {
        border: 0;
    }
    .list-group-item {
        border: 1px solid #ddd;
    }
    .badge {
        background-color: #999999;
    }
    span.index {
        margin-right: 20px;
    }
    .text-clickable {
        cursor: pointer;
    }
</style>
@endsection
@section('page_title')
    Data Exports
@stop
@section('page_heading_title')
    <h4><i class="fa fa-share"></i> <span class="text-semibold">System </span> Data Exports</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Backup And sharing</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients')}}" class="btn btn-primary "><i class="fa fa-home"></i> <span>Home</span></a>
            <a  href="{{url('backup/export/advanced')}}" class="btn btn-primary"><i class="fa fa-share"></i> <span>Export Data</span></a>
            <a  href="{{url('backup/import/advanced')}}" class="btn btn-primary"><i class="fa fa-upload"></i> <span>Import Data</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active text-primary"><a data-toggle="tab" href="#process-exports">Process Exports</a></li>
                <li class="text-primary"><a data-toggle="tab" href="#available-doc-for-export">Available Doc for Exports</a></li>
            </ul>
            <div class="tab-content">
                <div id="process-exports" class="tab-pane fade in active row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class=" text-center text-uppercase"> DATA SYNCHRONIZATION EXPORT FROM LOCAL TO CENTRAL SYSTEM</h5>
                                <div class="alert alert-info">
                                    This module is design for exporting data from local individual installed system to central system,Select the module to export
                                    such as Client module which will export all client registration data from local system, you can do the same to other modules. For exporting
                                    all data at per select All Modules
                                </div>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(array('url'=>'backup/export/advanced','role'=>'form','id'=>'formExportItems','files'=>true)) !!}
                                <div class="form-body">
                                    @if (session('message'))
                                        <div class="alert alert-danger">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                                            <div class="form-group">
                                                <label class="control-label text-bold"> Select Module to export</label>
                                                <select class="select" name="module" id="module" data-placeholder="Choose an option...">
                                                    <option></option>
                                                    <option value="1">Clients</option>
                                                    <option value="2">Clients Assessments</option>
                                                    <option value="3">Clients Referrals</option>
                                                    <option value="4">NFIs Inventory</option>
                                                    <option value="5">Cash Distributions</option>
                                                    <option value="6">Progress Monitoring</option>
                                                    <option value="7">All Modules</option>
                                                </select>
                                                @if($errors->first('module') !="")
                                                    <label id="address-error" class="validation-error-label" for="module">{{ $errors->first('module') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 pull-left" id="output">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                                        <button type="submit" id ="" class="btn btn-block btn-primary"><i class="fa fa-cogs"></i> Export Data </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="available-doc-for-export" class="tab-pane fade in row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                List of Available Documents
                            </div>
                            <div class="panel-body">
                                <ul class="list-group" id="availableDocument">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>

        function loadAvailableDocs() {
            $.ajax({
                url: "{{url('rest/secured/backup/import/advanced/available-docs')}}",
                type: 'GET',
                success:function(response){
                    const docs = response.docs;
                    let docList = '';
                    if (docs) {
                        docList += '<li class="list-group-item">';
                        docList +=      '<div class="row">';
                        docList +=          '<div class="col-md-2">';
                        docList +=              '<h4 class="text-info text-left">No</h4>';
                        docList +=          '</div>';
                        docList +=          '<div class="col-md-6">';
                        docList +=              '<h4 class="text-info text-left">File Name</h4>';
                        docList +=          '</div>';
                        docList +=          '<div class="col-md-4">';
                        docList +=              '<h4 class="text-info text-center">Action</h4>';
                        docList +=          '</div>';
                        docList +=      '</div>';
                        docList +=  '</li>';
                        docs.forEach((doc, index) => {
                            doc.lastIndexOf('/')
                            docList +=  '<li data-docpath="/backup/export/advanced/downloads/?filePath=' + doc.substring(0, doc.lastIndexOf('.xml')) + '" class="list-group-item available-doc-list">';
                            docList +=      '<div class="row">';
                            docList +=          '<div class="col-md-1">';
                            docList +=              '<span class="text-info text-bold index" >'+ (index + 1) +'</span>';
                            docList +=          '</div>';
                            docList +=          '<div class="col-md-7">';
                            docList +=              doc.substring(doc.lastIndexOf('/') + 1);
                            docList +=          '</div>';
                            docList +=          '<div class="col-md-2 text-clickable" data-action="download" data-filename=' + doc.substring(doc.lastIndexOf('/') + 1) + '>';
                            docList +=              '<span class="text-primary text-clickable" ><i class="fa fa-download"></i> Download</span>';
                            docList +=          '</div>';
                            docList +=          '<div class="col-md-2 text-clickable" data-action="delete" data-filename=' + doc.substring(doc.lastIndexOf('/') + 1) + '>';
                            docList +=              '<span class="text-danger text-clickable" ><i class="fa fa-trash"></i> Delete</span>';
                            docList +=          '</div>';
                            docList +=      '</div>';
                            docList +=  '</li>';
                        });
                    }
                    $('#availableDocument').html(docList);
                    $('.available-doc-list').on('click', function(e){
                        e.preventDefault();
                        let docpath = $(e.target).parent().parent().parent().data('docpath');
                        let action = $(e.target).parent().data('action');
                        let fileName = $(e.target).parent().data('filename');
                        if (docpath && action) {
                            if (action == 'download') {
                                window.location.replace(docpath);
                            } else if (action == 'delete') {
                                deleteFile(docpath, fileName);
                            }
                        }
                    });
                }
            });
        }
        function deleteFile(docpath, fileName) {
            bootbox.confirm('Are you sure you want to delele '+ fileName +'?', function(result) {
                if(result){
                    $.ajax({
                        url: docpath,
                        type: 'post',
                        data: {_method: 'delete', _token :"{{csrf_token()}}"},
                        success:function(data){
                            swal({
                                title: "Request has  been succeeded!",
                                text: data.message,
                                type: "success",
                                timer: 3000,
                                confirmButtonColor: "#43ABDB"
                            });
                            loadAvailableDocs();
                        }
                    });
                }
            });
        }

        $(function(){
            loadAvailableDocs();
            $('form#formExportItems').on('submit', function(e){
                e.preventDefault();
                $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Processing your request please wait...</span><h3>");
                var postData = $('form#formExportItems').serializeArray();
                var formURL = $('form#formExportItems').attr("action");
                $.ajax({
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                        swal({
                            title: "Request has  been succeeded!",
                            text: data.message,
                            type: "success",
                            timer: 3000,
                            confirmButtonColor: "#43ABDB"
                        });
                        $('#output').html('');
                        $('#module').prop('selectedIndex', 0);
                        $('#module').val('');
                        loadAvailableDocs();
                    },
                    error: function(jqXhr,status, response) {
                        if( jqXhr.status === 401 ) {
                            location.replace("{{url('login')}}");
                        }
                        if(jqXhr.status === 400) {
                            if (jqXhr.responseJSON.errors == 1)                            {
                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                                errorsHtml += '<h5 class="text-danger">'+jqXhr.responseJSON.message + '</h5>'
                                $('#output').html(errorsHtml);
                            } else {
                                var errors = jqXhr.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                });
                                errorsHtml += '</ul></di>';
                                $('#output').html(errorsHtml);
                            }
                        } else {
                            $('#output').html(jqXhr.message);
                        }
                    }
                });
            });
        });
    </script>
@stop
