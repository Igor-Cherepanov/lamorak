<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserCurrencyBalance
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property int $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCurrencyBalance whereUserId($value)
 * @mixin \Eloquent
 */
class UserCurrencyBalance extends Model
{
    use HasFactory;

    protected $table = 'users_currency_balances';

    protected $fillable = [
        'user_id',
        'currency_id',
        'balance',
    ];

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }

    /**
     * @param int $currency_id
     */
    public function setCurrencyId(int $currency_id): void
    {
        $this->currency_id = $currency_id;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }


    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }

}
