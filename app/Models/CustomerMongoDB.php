<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class CustomerMongoDB extends Model
{
    use HasFactory;

    // the selected database as defined in /config/database.php
    protected $connection = 'mongodb';

    // equivalent to $table for MySQL
    protected  $collection = 'laracoll';

    // defines the schema for top-level properties (optional).
    protected  $fillable = ['guid', 'first_name', 'family_name', 'email', 'address'];
}
