
   

 <div style="width:80%;margin:auto">
 <form action="{{ route('updateblog',$edit_posts->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <textarea class="form-control" id="summary-ckeditor"  name="details">{{ $edit_posts->details }}</textarea><br><br>
        <button type="submit" >Update</button><br><br>
      
    </form>
</div>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
