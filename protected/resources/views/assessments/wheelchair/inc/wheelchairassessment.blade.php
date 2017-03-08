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
                    <a href="#step-1">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Select Client</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-2">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Assessment Interview</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-3">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Physical Assessment</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-4">
                        <h4 class="list-group-item-heading">Step 4</h4>
                        <p class="list-group-item-text">Finish</p>
                    </a>
                </li>
             </ul>
        </div>
	</div>
     
   <form id="wheelchairassessment" action="{{url('/assessments/wheelchair/wheelchairassessment')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
	    @include('assessments.wheelchair.inc.client')
        @include('assessments.wheelchair.inc.assessmentinterview')
        @include('assessments.wheelchair.inc.physicalassessment')
        @include('assessments.wheelchair.inc.finish')
   </form>
