<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property string $description
 * @property int $user_id
 * @property string $subject_type
 * @property int $subject_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ActivityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUserId($value)
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $content
 * @property int $rejection_comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereRejectionComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $positions
 * @property-read int|null $positions_count
 * @method static \Database\Factories\DepartmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property int $equipment_category_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EquipmentCategory $category
 * @property-read mixed $available_quantity
 * @property-read mixed $full_name
 * @property-read mixed $short_description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SerialNumber[] $serial_numbers
 * @property-read int|null $serial_numbers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserEquipment[] $userEquipment
 * @property-read int|null $user_equipment_count
 * @method static \Database\Factories\EquipmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment inStock()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEquipmentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUpdatedAt($value)
 */
	class Equipment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Equipment[] $equipment
 * @property-read int|null $equipment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Equipment[] $equipmentInStock
 * @property-read int|null $equipment_in_stock_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FAQ[] $faq
 * @property-read int|null $faq_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SerialNumber[] $serialNumbers
 * @property-read int|null $serial_numbers_count
 * @method static \Database\Factories\EquipmentCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereUpdatedAt($value)
 */
	class EquipmentCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentTicket
 *
 * @property int $id
 * @property int $equipment_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EquipmentCategory $equipmentCategory
 * @property-read \App\Models\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket whereEquipmentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentTicket whereUpdatedAt($value)
 */
	class EquipmentTicket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FAQ
 *
 * @property int $id
 * @property int $equipment_category_id
 * @property string $question
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EquipmentCategory $equipmentCategory
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ query()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereEquipmentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereUpdatedAt($value)
 */
	class FAQ extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfficeSuppliesTicket
 *
 * @property int $id
 * @property string $office_item
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket whereOfficeItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeSuppliesTicket whereUpdatedAt($value)
 */
	class OfficeSuppliesTicket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department $department
 * @method static \Database\Factories\PositionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseOrder
 *
 * @property int $id
 * @property int $ticket_id
 * @property int|null $officer_id
 * @property int|null $hr_officer_id
 * @property \Illuminate\Support\Carbon $delivery_deadline
 * @property int $price
 * @property int|null $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $delivery_deadlinezo
 * @property-read mixed $hr_officer_name
 * @property-read mixed $officer_name
 * @property-read \App\Models\User|null $hrOfficer
 * @property-read \App\Models\User|null $officer
 * @property-read \App\Models\Ticket $ticket
 * @method static \Database\Factories\PurchaseOrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereDeliveryDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereHrOfficerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereOfficerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrder whereUpdatedAt($value)
 */
	class PurchaseOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RepairTicket
 *
 * @property int $id
 * @property int $equipment_id
 * @property string|null $estimated_finish_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Equipment $equipment
 * @property-read \App\Models\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket whereEstimatedFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepairTicket whereUpdatedAt($value)
 */
	class RepairTicket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RoleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SerialNumber
 *
 * @property int $id
 * @property string $serial_number
 * @property int $equipment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Equipment $equipment
 * @property-read mixed $is_used
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserEquipment[] $userEquipment
 * @property-read int|null $user_equipment_count
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber available()
 * @method static \Database\Factories\SerialNumberFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SerialNumber whereUpdatedAt($value)
 */
	class SerialNumber extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property string $ticketable_type
 * @property int $ticketable_id
 * @property int $ticket_status_id
 * @property int $user_id
 * @property int|null $officer_id
 * @property string|null $approval_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $officer_name
 * @property-read mixed $status
 * @property-read mixed $type
 * @property-read \App\Models\User|null $officer
 * @property-read \App\Models\PurchaseOrder|null $purchaseOrder
 * @property-read \App\Models\TicketStatus $ticketStatus
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $ticketable
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TicketFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket open()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereApprovalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOfficerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TicketStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Database\Factories\TicketStatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereUpdatedAt($value)
 */
	class TicketStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property int|null $position_id
 * @property int|null $role_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $department_id
 * @property-read mixed $department_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserEquipment[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Position|null $position
 * @property-read \App\Models\Role|null $role
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User itemsInUse()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserEquipment
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $admin_id
 * @property int $equipment_id
 * @property int|null $serial_number_id
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $return_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $admin
 * @property-read \App\Models\Equipment $equipment
 * @property-read mixed $returned
 * @property-read mixed $returned_date_formated
 * @property-read mixed $serial_no
 * @property-read mixed $start_date
 * @property-read \App\Models\SerialNumber|null $serialNumber
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereSerialNumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEquipment whereUserId($value)
 */
	class UserEquipment extends \Eloquent {}
}

