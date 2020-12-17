<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ExchangeOffice
 *
 * @property int $id
 * @property string $name
 * @property int $bank_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExchangeOffice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|ExchangeOffice filter(array $frd)
 * @property-read \App\Models\Bank $bank
 */
class ExchangeOffice extends Model
{
    use HasFactory;

    protected $table = 'exchange_offices';

    protected $fillable = [
        'name',
        'bank_id',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getBankId(): int
    {
        return $this->bank_id;
    }

    /**
     * @param int $bank_id
     */
    public function setBankId(int $bank_id): void
    {
        $this->bank_id = $bank_id;
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
    public function bank():BelongsTo{
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    /**
     * @return Bank
     */
    public function getBank():Bank{
        return $this->bank;
    }


}
