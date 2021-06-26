<div class="mt-4">
    @forelse($notifications as $notification)
        <div class="alert bg-teal border-0" role="alert">
            @include("notifications.{$notification->data['description']}")
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
            </a>
        </div>

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
</div>
