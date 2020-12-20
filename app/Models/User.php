<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $f_name
 * @property string|null $l_name
 * @property string|null $m_name
 * @property string|null $passport
 * @property-read Collection|\App\Models\UserCurrencyBalance[] $currencyBalances
 * @property-read int|null $currency_balances_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassport($value)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'f_name',
        'l_name',
        'm_name',
        'passport',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getFName().' '.mb_substr($this->getLName(), 0, 1).'. '.mb_substr($this->getMName(), 0, 1).'. ';
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getEmailVerifiedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->email_verified_at;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $email_verified_at
     */
    public function setEmailVerifiedAt(?\Illuminate\Support\Carbon $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->remember_token;
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
     * @return HasMany
     */
    public function currencyBalances():HasMany{
        return $this->hasMany(UserCurrencyBalance::class);
    }

    /**
     * @return Collection
     */
    public function getCurrencyBalances():Collection{
        return $this->currencyBalances;
    }

    /**
     * @param int $id
     * @return UserCurrencyBalance
     */
    public function getCurrencyBalance(int $id):UserCurrencyBalance{
        return $this->currencyBalances()->whereId($id)->first();
    }

    /**
     * @return UserCurrencyBalance
     */
    public function getRubCurrencyBalance():UserCurrencyBalance{
        return $this->currencyBalances()->where('currency_id', '=', 13)->first();
    }

    /**
     * @return string|null
     */
    public function getFName(): ?string
    {
        return $this->f_name;
    }

    /**
     * @param string|null $f_name
     */
    public function setFName(?string $f_name): void
    {
        $this->f_name = $f_name;
    }

    /**
     * @return string|null
     */
    public function getLName(): ?string
    {
        return $this->l_name;
    }

    /**
     * @param string|null $l_name
     */
    public function setLName(?string $l_name): void
    {
        $this->l_name = $l_name;
    }

    /**
     * @return string|null
     */
    public function getMName(): ?string
    {
        return $this->m_name;
    }

    /**
     * @param string|null $m_name
     */
    public function setMName(?string $m_name): void
    {
        $this->m_name = $m_name;
    }

    /**
     * @return string|null
     */
    public function getPassport(): ?string
    {
        return $this->passport;
    }

    /**
     * @param string|null $passport
     */
    public function setPassport(?string $passport): void
    {
        $this->passport = $passport;
    }

}
