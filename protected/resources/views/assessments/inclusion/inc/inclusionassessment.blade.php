   <style>
	   .load_hidden-spinner{
            display: none;
            width:40px;
            height:40px;
            border: 2px solid #BB0F18;
            border-top-color:#68bc45;
            border-radius: 100%;
            position:absolute;
            left:400px;
            margin:auto;
            z-index: 9999;
            animation: round 2s linear infinite;
     }
	@keyframes round{
            from{transform: rotate(0deg)}
            to{transform: rotate(360deg)}  
     }

  </style>
	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active">
                    <a href="#inclusion-step-1">
                        <h4 class="list-group-item-heading">Section One</h4>
                        <p class="list-group-item-text">Select Client</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#inclusion-step-2">
                        <h4 class="list-group-item-heading">Section Two</h4>
                        <p class="list-group-item-text">Assessment Interview</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#inclusion-step-3">
                        <h4 class="list-group-item-heading">Section Three</h4>
                        <p class="list-group-item-text">Physical Assessment</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#inclusion-step-4">
                        <h4 class="list-group-item-heading">Section Four</h4>
                        <p class="list-group-item-text">Finish</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#inclusion-step-5">
                        <h4 class="list-group-item-heading">Section Five</h4>
                        <p class="list-group-item-text">Finish</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#inclusion-step-6">
                        <h4 class="list-group-item-heading">Section Six</h4>
                        <p class="list-group-item-text">Finish</p>
                    </a>
                </li>
             </ul>
        </div>
	</div>
<form id="inclusionassessment" action="{{url('/assessments/inclusion/inclusionassessment')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
@include('assessments.inclusion.form.inclusion_section_one')
@include('assessments.inclusion.form.inclusion_section_two')
@include('assessments.inclusion.form.inclusion_section_three')
@include('assessments.inclusion.form.inclusion_section_four')
@include('assessments.inclusion.form.inclusion_section_five')
@include('assessments.inclusion.form.inclusion_section_six')
</form>