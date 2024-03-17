<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  use HasFactory;

  protected $table = 'vendors';

  protected $primaryKey = 'vendor_id';

  protected $fillable = [
    'vendor_name', 
    'vendor_account_no',
    'vendor_passport',
    'vendor_gst_no',
    'vendor_file_name',
    'vendor_file_size'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

}
