<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property string $id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quote extends Model
{
    use HasUlids;
}
