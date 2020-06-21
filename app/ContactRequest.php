<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    //Table name
    protected $table = 'contact_requests';
    //Primary key
    public $primaryKey = 'id';
    //Timestamp
    public $timestamps = true;

}
