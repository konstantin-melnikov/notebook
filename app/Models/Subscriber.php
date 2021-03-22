<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'phone',
        'email',
    ];

    protected $formFields = [
        [ 'name' => 'full_name', 'type' => 'text', 'label' => 'ФИО' ],
        [ 'name' => 'phone', 'type' => 'tel', 'label' => 'Телефон' ],
        [ 'name' => 'email', 'type' => 'email', 'label' => 'Email' ],
    ];

    public function getFormFields()
    {
        return $this->formFields;
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
