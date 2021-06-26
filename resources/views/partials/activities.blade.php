<div>
    <h4>Activities</h4>
    <div>
        @foreach($activities as $activity)
            <div class="mt-1">
                @include("activities.{$activity->description}", ['subject' => 'ticket'])
                <span class="ml-2 text-sm text-gray">{{ $activity->created_at->diffForHumans(null, true) }} ago</span>
            </div>
        @endforeach
    </div>
</div>
