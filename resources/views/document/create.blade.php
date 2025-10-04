{{Form::open(array('url'=>'document','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('assign_to',__('Assign To'),array('class'=>'form-label'))}}
            {{Form::select('assign_to',$client,null,array('class'=>'form-control hidesearch'))}}
        </div>
        <div class="form-group  col-md-6">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter document name')))}}
        </div>
        <!--<div class="form-group col-md-6">
            {{Form::label('category_id',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category_id',$category,null,array('class'=>'form-control hidesearch','id'=>'category'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('sub_category_id',__('Room No'),array('class'=>'form-label'))}}
            <div class="sc_div">
               <select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id">
                    <option value="">{{__('Select Sub Category')}}</option>
                </select>
				{{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Room No')))}}
            </div>
        </div>-->
       
        <div class="form-group col-md-3">
            {{Form::label('tages',__('Room No'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Room No')))}}
        </div>
		<div class="form-group col-md-3">
            {{Form::label('tages',__('Rack No'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Rack No')))}}
        </div>
        <div class="form-group col-md-3">
            {{Form::label('stage_id',__('Shlef No'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Shelf No')))}}
        </div>
		<div class="form-group col-md-3">
            {{Form::label('stage_id',__('Box No'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Box No')))}}
        </div>
		 <div class="form-group  col-md-6">
            {{Form::label('document',__('Document'),array('class'=>'form-label'))}}
            {{Form::file('document',array('class'=>'form-control'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>3))}}
        </div>
    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('SUBMIT'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}
<script>
      var baseUrl = "{{ route('category.sub-category', ':id') }}";
</script>
<script src="{{ asset('js/custom/document.js?') }}{{ time() }}"></script>
