   <?php $incAssHelper = new InclusionAssessmentHelper(); ?>
    <div class="assessment-container">
        <div class="row">
            <div class="col-md-12 form-box">
                <form role="form" id="inclusion-assessment" class="inclusion-assessment" action="{{url('assessments/inclusion/store-assessment')}}" method="POST">
                           @include('assessments.inclusion.form.inclusion_section_one')
        				   @include('assessments.inclusion.form.inclusion_section_two')
        				   @include('assessments.inclusion.form.inclusion_section_three')
        				   @include('assessments.inclusion.form.inclusion_section_four')
        				   @include('assessments.inclusion.form.inclusion_section_five')
        				   @include('assessments.inclusion.form.inclusion_section_six')
        				   @include('assessments.inclusion.form.inclusion_section_seven')
                </form>
            </div>
        </div>
    </div>
