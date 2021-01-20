<?php
namespace App;

use App\Traits\CalendaritemBaseFunc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    //use LogsActivity;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *    ;
     * @var array
     */
    protected $fillable = ['origin', 'name', 'filename','path','worknote','adnote', 'pub'];

    public function booking()
    {
        return $this->belongsToMany('App\Booking', 'booking_file');
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
 
}
