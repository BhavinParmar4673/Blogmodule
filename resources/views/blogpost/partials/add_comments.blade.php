<form action="{{ route('comments.store', $blog->id) }}" method="POST" class="mt-2 mb-4">
	@csrf
	<div class="input-group">
	  <input 
	  	name="new_comment" 
	  	type="text" 
	  	class="form-control" 
	  	placeholder="write your comment.."
	  	required>
         
	  <input type="hidden" name="post_id" value="{{$blog->id}}">
	  <div class="input-group-append">
	    <button class="btn btn-primary" type="submit">Add Comment</button> 
	  </div>

	</div>

</form>