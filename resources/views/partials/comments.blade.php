<div>
    <h4>Comments</h4>
    <div>
        @foreach($commentable->comments as $comment)
            <div class="mt-1">
                <p>
                    <span class="text-sm text-gray d-block">{{ $comment->user->name }}</span>
                    <span class="{{ $comment->rejection_comment ? 'text-danger' : '' }}">{{ $comment->content }}</span>
                </p>
            </div>
        @endforeach

        @if($commentable->isOpen())
            @can('comment', $commentable)
                <div class="row mt-4">
                    <div class="col-12">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf

                            <input type="text" name="commentable_id" value="{{ $commentable->id }}" hidden>
                            <input type="text" name="commentable_type" value="{{ getModelNamespace(class_basename($commentable)) }}" hidden>

                            <label for="content">Comment:</label>
                            <textarea name="content" id="content" class="form-control" placeholder="Enter comment" rows="2"></textarea>

                            <button class="btn btn-sm btn-primary mt-2">Add Comment</button>
                        </form>
                    </div>
                </div>
            @endcan
        @endif
    </div>
</div>
