<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property-read \App\Models\Currency $currency
 * @method static Builder|UserCurrencyBalance filter(array $frd)
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

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $frd): Builder
    {
        foreach ($frd as $key => $value) {
            switch ($key) {
                case 'search':
                    $query->where('name', 'like', '%' . $value . '%');
                    break;
            }
        }

        return $query;
    }

    /**
     * @return BelongsTo
     */
    public function currency():BelongsTo{
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return Currency
     */
    public function getCurrency():Currency{
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getSubCurrencyName():string{
        return mb_substr($this->getCurrency()->getName(), 0, 3).'.';
    }

}
