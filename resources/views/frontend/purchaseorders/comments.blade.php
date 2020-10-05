@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-6">    
        <div class="table-responsive" style="text-align: left;">
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif

          <form action="{{ route('comments.store') }}" method="POST" id="add_comments" style="width: 100%;">
            <h4>To add a comment, please fill the form.</h4><br>

            <div class="form-group">
              <label>Description</label>
              @csrf
              <input type="hidden" name="purchase_id" class="purchase_id" value="{{ $record->id }}">
              <input type="hidden" class="url" value="{{ $url }}">
              <textarea rows="8" name="description" id="description" placeholder="Description" class="form-control description" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-danger" href="{{ route('purchaseorders.create') }}" style="color: #fff;">Back</a>

          </form>
        </div>
      </div>
      <div class="col-6 h-100">
        <div class="bg-secondary p-4">
          <h4 class="card-title">Comments </h4>
          <div id="profile-list-left" class="py-2 live_comments_table">
            @if($comments)
              @foreach($comments as $comment)

                <div class="card rounded mb-2">
                  <div class="card-body p-3">
                    <div class="media">
                      <!-- <img src="../../../assets/images/faces/face1.jpg" alt="image" class="img-sm mr-3 rounded-circle"> -->
                      <div class="media-body">
                        <i class="fa fa-user"></i> {{ $comment->getUsername($comment->writer) }} ({{ $comment->sign_date }})
                        <p class="mb-0 text-muted"> <?= nl2br($comment->description) ?> </p>
                      </div>
                    </div>
                  </div>
                </div>

              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop

@section('script')
<script>
  function livecomments (){
    var url = $('.url').val();

    setInterval(function()
    { 
      $.ajax({
        url: url,
        data: {},
        type: 'GET',
        success: function(result, status) {
          var parent = $('.live_comments_table');
          if (result) {
            $('.live_comments_table').empty();
            for (var i = 0; i < result.length; i++) {
              var tag = '<div class="card rounded mb-2"><div class="card-body p-3"><div class="media"><div class="media-body"><i class="fa fa-user"></i> '+result[i]["username"]+' ('+result[i]["sign_date"]+') '+'<p class="mb-0 text-muted">'+result[i]['description']+'</p></div></div></div></div>'
              parent.append(tag);
            }
          }
        }
      });
    }, 2000);
  }; 

  livecomments ();
</script>
@endsection