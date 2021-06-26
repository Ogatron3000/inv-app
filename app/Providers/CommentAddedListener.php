<?php

namespace App\Providers;

use App\Models\PurchaseOrder;
use App\Models\Role;
use App\Models\Ticket;
use App\Notifications\PurchaseOrderCommentedNotification;
use App\Notifications\TicketCommentedNotification;
use App\Providers\CommentAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentAddedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentAdded  $event
     * @return void
     */
    public function handle(CommentAdded $event)
    {
        $commentAuthor = $event->comment->user;
        $commentable = $event->comment->commentable;

        if (class_basename($commentable) === 'Ticket') {
            // check for special case where user and officer are the same person
            if ($commentable->officer_id && $commentable->officer_id !== $commentable->user_id && $commentAuthor->id === $commentable->user_id) {
                $commentable->officer->notify(new TicketCommentedNotification($event->comment));
            }
            $commentable->user->notify(new TicketCommentedNotification($event->comment));
        } elseif (class_basename($commentable) === 'PurchaseOrder') {
            // purchase order aren't managed (only approved/rejected) by specific officer, so nobody from hr is notified
            if ($commentAuthor->id !== $commentable->officer_id) {
                $commentable->officer->notify(new PurchaseOrderCommentedNotification($event->comment));
            }
        }
    }
}
