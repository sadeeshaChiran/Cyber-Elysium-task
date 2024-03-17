<?php

namespace domain\Services;


use App\Models\students;

class UserService
{
    protected $student;

    public function __construct()
    {
        $this->student = new students();
    }


    public function all()
    {

        return $this->student->all();
    }



    public function delete($id)
    {
        $student = $this->student->find($id);

        $student->delete();

    }


    public function add($data)
    {


        $this->student->create($data);

    }

    public function status($id)
    {
        $student = $this->student->find($id);

        if ($student->status == "active") {
            $student->status = "inactive";

        } else {
            $student->status = "active";

        }

        $student->update();


    }

    public function update(array $data, $id)
    {

        $student =  $this ->student->find($id);

        $student->update($this->edit($student, $data));


    }

    protected function edit(students $student, $data)
    {
        return array_merge($student->toArray(), $data);
    }

}
