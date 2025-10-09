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
        <div class="form-group col-md-6">
            {{Form::label('category_id',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category_id',$category,null,array('class'=>'form-control hidesearch','id'=>'category'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('sub_category_id',__('Sub Category'),array('class'=>'form-label'))}}
            <div class="sc_div">
                <select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id">
                    <option value="">{{__('Select Sub Category')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group  col-md-4">
            {{Form::label('document',__('Document'),array('class'=>'form-label'))}}
            {{Form::file('document',array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('tages',__('Tages'),array('class'=>'form-label'))}}
            {{Form::select('tages[]',$tages,null,array('class'=>'form-control hidesearch','multiple'))}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('stage_id',__('Stage'),array('class'=>'form-label'))}}
            {{Form::select('stage_id',$stage_id,null,array('class'=>'form-control hidesearch'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>3))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('document_type',__('Document Type'),array('class'=>'form-label'))}}
            {{Form::select('document_type',['book'=>'Book','document'=>'Document','paper_cutting'=>'Paper Cutting'],null,array('class'=>'form-control hidesearch','id'=>'document_type'))}}
        </div>
    </div>
    <div class="row" id="book_fields" style="display: none;">
        <div class="form-group col-md-6">
            {{Form::label('author',__('Author'),array('class'=>'form-label'))}}
            {{Form::text('author',null,array('class'=>'form-control','placeholder'=>__('Enter author')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('publisher',__('Publisher'),array('class'=>'form-label'))}}
            {{Form::text('publisher',null,array('class'=>'form-control','placeholder'=>__('Enter publisher')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('isbn',__('ISBN'),array('class'=>'form-label'))}}
            {{Form::text('isbn',null,array('class'=>'form-control','placeholder'=>__('Enter ISBN')))}}
        </div>
    </div>
    <div class="row" id="paper_cutting_fields" style="display: none;">
        <div class="form-group col-md-6">
            {{Form::label('newspaper_name',__('Newspaper Name'),array('class'=>'form-label'))}}
            {{Form::text('newspaper_name',null,array('class'=>'form-control','placeholder'=>__('Enter newspaper name')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('clipping_date',__('Clipping Date'),array('class'=>'form-label'))}}
            {{Form::date('clipping_date',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('headline',__('Headline'),array('class'=>'form-label'))}}
            {{Form::text('headline',null,array('class'=>'form-control','placeholder'=>__('Enter headline')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('section',__('Section'),array('class'=>'form-label'))}}
            {{Form::text('section',null,array('class'=>'form-control','placeholder'=>__('Enter section')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('forwarded_to',__('Forwarded To'),array('class'=>'form-label'))}}
            {{Form::text('forwarded_to',null,array('class'=>'form-control','placeholder'=>__('Enter forwarded to')))}}
        </div>
    </div>
    <div class="row" id="document_fields" style="display: none;">
        <div class="form-group col-md-6">
            {{Form::label('doc_category',__('Document Category'),array('class'=>'form-label'))}}
            {{Form::text('doc_category',null,array('class'=>'form-control','placeholder'=>__('Enter document category')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('ref_number',__('Reference Number'),array('class'=>'form-label'))}}
            {{Form::text('ref_number',null,array('class'=>'form-control','placeholder'=>__('Enter reference number')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('file_number',__('File Number'),array('class'=>'form-label'))}}
            {{Form::text('file_number',null,array('class'=>'form-control','placeholder'=>__('Enter file number')))}}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('copies_total',__('Total Copies'),array('class'=>'form-label'))}}
            {{Form::number('copies_total',null,array('class'=>'form-control','placeholder'=>__('Enter total copies')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('copies_available',__('Available Copies'),array('class'=>'form-label'))}}
            {{Form::number('copies_available',null,array('class'=>'form-control','placeholder'=>__('Enter available copies')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('rack',__('Rack'),array('class'=>'form-label'))}}
            {{Form::text('rack',null,array('class'=>'form-control','placeholder'=>__('Enter rack')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('shelf',__('Shelf'),array('class'=>'form-label'))}}
            {{Form::text('shelf',null,array('class'=>'form-control','placeholder'=>__('Enter shelf')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('room',__('Room'),array('class'=>'form-label'))}}
            {{Form::text('room',null,array('class'=>'form-control','placeholder'=>__('Enter room')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('cabinet',__('Cabinet'),array('class'=>'form-label'))}}
            {{Form::text('cabinet',null,array('class'=>'form-control','placeholder'=>__('Enter cabinet')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('language',__('Language'),array('class'=>'form-label'))}}
            {{Form::text('language',null,array('class'=>'form-control','placeholder'=>__('Enter language')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('published_year',__('Published Year'),array('class'=>'form-label'))}}
            {{Form::number('published_year',null,array('class'=>'form-control','placeholder'=>__('Enter published year')))}}
        </div>

    </div>
</div>
<div class="modal-footer">

    {{Form::submit(__('Create'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}
<script>
      var baseUrl = "{{ route('category.sub-category', ':id') }}";
</script>
<script src="{{ asset('js/custom/document.js?') }}{{ time() }}"></script>
<script>
    $(document).ready(function(){
        function toggle_fields() {
            var document_type = $('#document_type').val();
            if(document_type == 'book'){
                $('#book_fields').show();
                $('#paper_cutting_fields').hide();
                $('#document_fields').hide();
            } else if(document_type == 'paper_cutting'){
                $('#book_fields').hide();
                $('#paper_cutting_fields').show();
                $('#document_fields').hide();
            } else if(document_type == 'document'){
                $('#book_fields').hide();
                $('#paper_cutting_fields').hide();
                $('#document_fields').show();
            }
        }
        toggle_fields();
        $('#document_type').change(function(){
            toggle_fields();
        });
    });
</script>

