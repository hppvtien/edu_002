
<form class="form-horizontal" id="jobs_submit" autocomplete="off" method="POST" action="">
    @csrf

            <div class="card  box-shadow-0">
                <div class="card-body pt-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Name <span>(*)</span></label>
                        <input type="text" class="form-control keypress-count" id="title" value="{{ old('name',$jobedit->name ?? '') }}"  onkeyup="ChangeToSlug();" data-title-seo=".title_seo" data-slug=".slug" name="name">
                        @if($errors->first('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Slug <span>(*)</span></label>
                        <input id="slug" type="text" class="form-control slug" name="slug" value="{{ old('slug',$jobedit->slug ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Desscription </label>               
                        <textarea  class="form-control keypress-count" name="desscription" cols="10" rows="3">{{ old('desscription',$jobedit->desscription ?? '') }}</textarea>
                        @if($errors->first('desscription'))
                        <span class="text-danger">{{ $errors->first('desscription') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Content </label>
                        <textarea name="content" id="article-ckeditor" cols="30" rows="5">{!! old('content',$jobedit->content ?? '') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Phone </label>
                        <input  type="text" class="form-control keypress-count" name="phone" value="{{ old('phone',$jobedit->phone ?? '') }}">
                        @if($errors->first('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Email </label>
                        <input type="text" class="form-control keypress-count" name="email" value="{{ old('email',$jobedit->email ?? '') }}">
                        @if($errors->first('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="">Address </label>
                        <input type="text" class="form-control keypress-count" name="address" value="{{ old('address',$jobedit->address ?? '') }}">
                        @if($errors->first('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Hạn nộp CV <span>(*)</span></label>
                        <input type="date" class="form-control keypress-count" name="end_date" value="{{ old('end_date',$jobedit->end_date ?? '') }}">
                        @if($errors->first('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>
                    <div class="form-group">                      
                        <div>
                            <button class="btn btn-info"><i class="la la-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
</form>

@section('script')
<script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace('article-ckeditor', {
        filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
        filebrowserImageBrowseUrl: "{{ asset('/plugin/ckfinder/ckfinder.html?type=Images') }}",
        filebrowserFlashBrowseUrl: "{{ asset('/plugin/ckfinder/ckfinder.html?type=Flash') }}",
        filebrowserUploadUrl: "{{ asset('/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
        filebrowserImageUploadUrl: "{{ asset('/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        filebrowserFlashUploadUrl: "{{ asset('/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
    });
</script>
@stop
