<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function ratings()
    {
      return $this->hasMany(Rating::class);
    }

    /**
     * Calculate the average rating on a book
     *
     * @return integer
     */
    public function averageRating()
    {
      $ratings = $this->ratings;

      if (!$ratings->isEmpty()) {
        $sum = 0;

        foreach ($ratings as $rating) {
          $sum += $rating->rating;
        }

        return $sum / $ratings->count();
      }
    }
}
