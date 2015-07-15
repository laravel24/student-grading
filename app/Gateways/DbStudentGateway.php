<?php namespace App\Gateways;

use App\Models\Student;
use Illuminate\Contracts\Validation\Factory;

class DbStudentGateway
{
        use ActsAsList;
    
    /**
     * The Eloquent student.
     *
     * @var \App\Models\Student
     */
    protected $student;

    /**
     * Constructor.
     *
     * @param \App\Models\Student|string $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function newInstance($attributes = [])
    {
        return $this->student->newInstance($attributes);
    }

    public function all()
    {
        return $this
            ->student
            ->newQuery()
            ->orderBy('position', 'asc')
            ->get();
    }

    public function find($id)
    {
        return $this
            ->student
            ->where('id', (int)$id)
            ->first();
    }

    public function create(array $data)
    {
        with($client = $this->student)->fill($data)->save();

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
