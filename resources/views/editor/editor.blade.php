
   

 <div style="width:80%;margin:auto">
    <form action="{{ route('storeblog') }}" method="post" enctype="multipart/form-data">
        @csrf
        <textarea class="form-control" id="summary-ckeditor" name="details"></textarea><br><br>
        <button type="submit" >submit</button><br><br>
        <table>
            <tr>
                <!-- <th>sl</th> -->
                <th>Permalink</th>
                <th></th>
                <!-- <th>news</th> -->
            </tr><hr>
            @foreach($post as $value)
            <tr>
                <!-- <td>{{ $value->id }}</th> -->
                <td><a href="{{ route('blog',$value->id) }}">{{ route('blog',$value->id) }}</a></th>
                <td>
                    <a style="background:#3498db;padding:8px 10px;
                    text-decoration:none;color:white;border-radius:5px" href="{{ route('allpost') }}">View Post</a>
                </td>
                <td>
                    <a style="background:#3498db;padding:8px 10px;
                    text-decoration:none;color:white;border-radius:5px"
                     href="{{ route('edit',$value->id) }}">Edit Post</a>
                </td>
            </tr>
            @endforeach

            
        </table>
        <!-- Edit -->
        <!-- <table>
            <tr>
                <th>sl</th>
                <th><a style="background:#3498db;padding:8px 10px;text-decoration:none;color:white;border-radius:5px" href="{{ route('allpost') }}">Edit Post</a></th>
                <th>news</th>
            </tr><hr>
            @foreach($edit_post as $value)
            <tr>
                <td>{{ $value->id }}</th>
                <td><a href="">rg</a></th>
                <td>{!! $value->details !!}</th>
            </tr>
            @endforeach

            
        </table> -->
    </form>
</div>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
