<?php namespace App\Gateways;

use App\Models\ClassDay;
use Illuminate\Contracts\Validation\Factory;

class DbClassDayGateway
{
        use ActsAsList;
    
    /**
     * The Eloquent classDay.
     *
     * @var \App\Models\ClassDay
     */
    protected $classDay;

    /**
     * Constructor.
     *
     * @param \App\Models\ClassDay|string $classDay
     */
    public function __construct(ClassDay $classDay)
    {
        $this->classDay = $classDay;
    }

    public function newInstance($attributes = [])
    {
        return $this->classDay->newInstance($attributes);
    }

    public function all()
    {
        return $this
            ->classDay
            ->newQuery()
            ->orderBy('position', 'asc')
            ->get();
    }

    public function find($id)
    {
        return $this
            ->classDay
            ->where('id', (int)$id)
            ->first();
    }

    public function create(array $data)
    {
        with($client = $this->classDay)->fill($data)->save();

        return $client;
    }

    public function update($id, array $data)
    {
        $client = $this->find($id);

        $client->fill($data)->save();

        return $client;
    }


    public function delete($id)
    {
        if ($client = $this->find($id)) {
            $client->delete();

            return true;
        }

        return false;
    }
}
