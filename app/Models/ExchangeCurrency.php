<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExchangeCurrency
 *
 * @property int $id
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string $passport
 * @property int $currency_id
 * @property int $exchange_office_id
 * @property int $sold_currency_count
 * @property int $bought_currency_count
 * @property int $sold_rub_count
 * @property int $bought_rub_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereBoughtCurrencyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereBoughtRubCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereExchangeOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereFName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereLName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereMName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereSoldCurrencyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereSoldRubCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeCurrency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|ExchangeCurrency filter(array $frd)
 */
class ExchangeCurrency extends Model
{
    use HasFactory;

    protected $table = 'exchange_currencies';

    protected $fillable = [
        'f_name',
        'l_name',
        'm_name',
        'passport',
        'currency_id',
        'exchange_office_id',
        'sold_currency_count',
        'bought_currency_count',
        'sold_rub_count',
        'bought_rub_count',
    ];

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->f_name;
    }

    /**
     * @param string $f_name
     */
    public function setFName(string $f_name): void
    {
        $this->f_name = $f_name;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->l_name;
    }

    /**
     * @param string $l_name
     */
    public function setLName(string $l_name): void
    {
        $this->l_name = $l_name;
    }

    /**
     * @return string
     */
    public function getMName(): string
    {
        return $this->m_name;
    }

    /**
     * @param string $m_name
     */
    public function setMName(string $m_name): void
    {
        $this->m_name = $m_name;
    }

    /**
     * @return string
     */
    public function getPassport(): string
    {
        return $this->passport;
    }

    /**
     * @param string $passport
     */
    public function setPassport(string $passport): void
    {
        $this->passport = $passport;
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
    public function getExchangeOfficeId(): int
    {
        return $this->exchange_office_id;
    }

    /**
     * @param int $exchange_office_id
     */
    public function setExchangeOfficeId(int $exchange_office_id): void
    {
        $this->exchange_office_id = $exchange_office_id;
    }

    /**
     * @return int
     */
    public function getSoldCurrencyCount(): int
    {
        return $this->sold_currency_count;
    }

    /**
     * @param int $sold_currency_count
     */
    public function setSoldCurrencyCount(int $sold_currency_count): void
    {
        $this->sold_currency_count = $sold_currency_count;
    }

    /**
     * @return int
     */
    public function getBoughtCurrencyCount(): int
    {
        return $this->bought_currency_count;
    }

    /**
     * @param int $bought_currency_count
     */
    public function setBoughtCurrencyCount(int $bought_currency_count): void
    {
        $this->bought_currency_count = $bought_currency_count;
    }

    /**
     * @return int
     */
    public function getSoldRubCount(): int
    {
        return $this->sold_rub_count;
    }

    /**
     * @param int $sold_rub_count
     */
    public function setSoldRubCount(int $sold_rub_count): void
    {
        $this->sold_rub_count = $sold_rub_count;
    }

    /**
     * @return int
     */
    public function getBoughtRubCount(): int
    {
        return $this->bought_rub_count;
    }

    /**
     * @param int $bought_rub_count
     */
    public function setBoughtRubCount(int $bought_rub_count): void
    {
        $this->bought_rub_count = $bought_rub_count;
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

}
