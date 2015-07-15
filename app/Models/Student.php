<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Lookitsatravis\Listify\Listify;

class Student extends Model 
{
    use Listify;
    
    /**
     * {@inheritDoc}
     */
    protected $table = 'students';

    /**
     * {@inheritDoc}
     */
    protected $guarded = [
        'id',
    ];

        /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::bootListify();
        
    }

    public function __construct(array $attributes = [])
    {
        
        parent::__construct($attributes);

        $this->initListify();
    }
    
}
