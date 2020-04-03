
   

 <div style="width:80%;margin:auto">
 @foreach($post as $value)
      {{ $value->id}}
      {!! $value->details !!}
   @endforeach
</div>

