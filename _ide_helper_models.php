<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $lastname
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role_id
 * @property int $organization_id
 * @property int $membership_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $phone
 * @property bool $active
 * @property bool $staff
 * @property int $creator_id
 * @property bool $newsletter
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereZip($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereUpdatedAt($value)
 */
	class ProductType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $duration
 * @property float|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $max_secondaries
 * @property int $creator_id
 * @property float|null $secondary_price
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereMaxSecondaries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereSecondaryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberType whereUpdatedAt($value)
 */
	class MemberType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMethod
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $icon
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod whereUpdatedAt($value)
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property string|null $memo
 * @property int $show_id
 * @property int $seats
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $type_id
 * @property bool $public
 * @property-read \App\User $creator
 * @property-read string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventMemo[] $memos
 * @property-read int|null $memos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sale[] $sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shift[] $shifts
 * @property-read int|null $shifts_count
 * @property-read \App\Models\Show $show
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @property-read \App\Models\EventType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereShowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereUpdatedAt($value)
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TicketType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $active
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property bool $in_cashier
 * @property bool $public
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventType[] $allowedEvents
 * @property-read int|null $allowed_events_count
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereInCashier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketType whereUpdatedAt($value)
 */
	class TicketType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string|null $memo
 * @property int $creator_id
 * @property int|null $emailed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shift[] $shifts
 * @property-read int|null $shifts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereEmailed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schedule whereUpdatedAt($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string|null $organization
 * @property bool $astc
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $email
 * @property string|null $website
 * @property int $seats
 * @property string|null $logo
 * @property string|null $cover
 * @property float|null $tax
 * @property string|null $membership_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $confirmation_text
 * @property string|null $invoice_text
 * @property float $membership_card_width
 * @property float $membership_card_height
 * @property int $membership_number_length
 * @property int $cashier_customer_dropdown
 * @property bool $membership_card_barcode
 * @property float $ticket_width
 * @property float $ticket_height
 * @property bool $self_confirmation
 * @property int $self_confirmation_days
 * @property string $self_confirmation_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereAstc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCashierCustomerDropdown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereConfirmationText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereInvoiceText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMembershipCardBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMembershipCardHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMembershipCardWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMembershipNumberLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMembershipText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSelfConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSelfConfirmationDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSelfConfirmationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTicketHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTicketWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereWebsite($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Announcement
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property string $title
 * @property string $content
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereUpdatedAt($value)
 */
	class Announcement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShowType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $active
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowType whereUpdatedAt($value)
 */
	class ShowType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Member
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $member_type_id
 * @property int $creator_id
 * @property int $primary_id
 * @property-read \App\User $creator
 * @property-read bool $expired
 * @property-read string $number
 * @property-read \[type] $users
 * @property-read \App\User $primary
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $secondaries
 * @property-read int|null $secondaries_count
 * @property-read \App\Models\MemberType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMemberTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePrimaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUpdatedAt($value)
 */
	class Member extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleMemo
 *
 * @property int $id
 * @property string $message
 * @property int $author_id
 * @property int $sale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \App\Models\Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SaleMemo whereUpdatedAt($value)
 */
	class SaleMemo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property int $id
 * @property int $creator_id
 * @property string $status
 * @property string $source
 * @property bool $taxable
 * @property float|null $subtotal
 * @property float|null $tax
 * @property float|null $total
 * @property bool $refund
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $organization_id
 * @property bool $sell_to_organization
 * @property-read \App\User $creator
 * @property-read \App\User $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \[type] $balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Grade[] $grades
 * @property-read int|null $grades_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SaleMemo[] $memos
 * @property-read int|null $memos_count
 * @property-read \App\Models\Organization $organization
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereSellToOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sale whereUpdatedAt($value)
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrganizationType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $taxable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Organization[] $organizations
 * @property-read int|null $organizations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationType whereUpdatedAt($value)
 */
	class OrganizationType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $phone
 * @property string|null $fax
 * @property string $email
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $type_id
 * @property int $creator_id
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sale[] $sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @property-read \App\Models\OrganizationType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereZip($value)
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Grade
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Grade whereUpdatedAt($value)
 */
	class Grade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shift
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $employees
 * @property-read int|null $employees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $positions
 * @property-read int|null $positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shift whereUpdatedAt($value)
 */
	class Shift extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property bool $open
 * @property bool $sticky
 * @property int $category_id
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read int|null $replies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSticky($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Show
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $duration
 * @property string $description
 * @property string $cover
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $type_id
 * @property bool $active
 * @property string|null $trailer_url
 * @property \Illuminate\Support\Carbon|null $expiration
 * @property-read \App\Models\ShowType $category
 * @property-read \App\User $creator
 * @property-read bool $expired
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereTrailerUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereUpdatedAt($value)
 */
	class Show extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $staff
 * @property int $creator_id
 * @property-read \App\User $creator
 * @property-read \App\Models\RoleAccessControl $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoleAccessControl
 *
 * @property int $id
 * @property string|null $dashboard
 * @property string|null $shows
 * @property string|null $products
 * @property string|null $calendar
 * @property string|null $sales
 * @property string|null $reports
 * @property string|null $members
 * @property string|null $users
 * @property string|null $organizations
 * @property string|null $bulletin
 * @property string|null $settings
 * @property bool|null $admin
 * @property bool|null $cashier
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereBulletin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereCalendar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereCashier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereDashboard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereOrganizations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereReports($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereShows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleAccessControl whereUsers($value)
 */
	class RoleAccessControl extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $cashier_id
 * @property int $payment_method_id
 * @property float|null $total
 * @property float|null $tendered
 * @property float|null $change_due
 * @property string|null $reference
 * @property string $source
 * @property int $sale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $refunded
 * @property-read \App\User $cashier
 * @property-read \App\Models\PaymentMethod $method
 * @property-read \App\Models\Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCashierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereChangeDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereTendered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property string $color
 * @property bool $public
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketType[] $allowedTickets
 * @property-read int|null $allowed_tickets_count
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereUpdatedAt($value)
 */
	class EventType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reply
 *
 * @property int $id
 * @property string $message
 * @property int $post_id
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereUpdatedAt($value)
 */
	class Reply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property float|null $price
 * @property string $description
 * @property int $type_id
 * @property int $creator_id
 * @property bool $inventory
 * @property int $stock
 * @property string $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $active
 * @property bool $public
 * @property bool $in_cashier
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sale[] $sales
 * @property-read int|null $sales_count
 * @property-read \App\Models\ProductType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereInCashier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereInventory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventMemo
 *
 * @property int $id
 * @property string $message
 * @property int $author_id
 * @property int $event_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMemo whereUpdatedAt($value)
 */
	class EventMemo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $event_id
 * @property int $sale_id
 * @property int $customer_id
 * @property int $cashier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticket_type_id
 * @property int $organization_id
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Sale $sale
 * @property-read \App\Models\TicketType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCashierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereTicketTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUpdatedAt($value)
 */
	class Ticket extends \Eloquent {}
}

