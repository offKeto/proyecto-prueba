<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Task extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'description',
    'status',
  ];

  public static function rules()
  {
    return [
      'title' => 'required|string|max:255',
      'description' => 'nullable|string|max:1000',
      'status' => 'required|in:pending,completed',
    ];
  }
}
