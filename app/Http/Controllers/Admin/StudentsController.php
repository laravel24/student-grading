<?php  namespace App\Http\Controllers\Admin;

use App\Gateways\DbRoleGateway;
use App\Gateways\DbStudentGateway;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class StudentsController extends AdminController
{
    use ValidatesRequests;

    protected $viewNamespace = 'admin.students';

    protected $defaultTitle = 'Students';

    protected $student;

    protected $request;

    protected $rules = [
    ];

    protected $storeRules = [
    ];

    public function __construct(DbStudentGateway $student, Request $request)
    {
        $this->student = $student;
        $this->request = $request;
    }

    public function index()
    {
        $students = $this->student->all();

        return $this->render('index', compact('students'));
    }

    public function create()
    {
        $student = $this->student->newInstance();

        return $this->studentForm('create', $student, 'New Student');
    }

    public function store()
    {
        $this->validate($this->request, $this->storeRules);

        $student = $this->student->create($this->request->all());

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function edit($id)
    {
        $student = $this->student->find($id);

        return $this->studentForm('edit', $student);
    }

    public function profile()
    {
        return $this->studentForm('edit', $this->guard->student());
    }

    public function studentForm($action, $student, $title = null)
    {
        $title = $title ?: 'Editing Student - ' . $student->id;

        switch ($action) {
            case 'create':
                $method = null;
                $route = route('admin.students.store');
                break;
            case 'edit':
                $method = 'put';
                $route = route('admin.students.update', $student);
        }

        return $this->render('form', compact('student', 'method', 'route'), $title);
    }

    public function update($id)
    {
        $this->validate($this->request);

        $student = $this->student->update($id, $this->request->all());

        if ($student) {
            return redirect()->route('admin.students.index')
                ->with('success', 'Student updated successfully.');
        }
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $rules
     * @return void
     */
    public function validate(Request $request, array $rules = null)
    {
        $rules = $rules ?: $this->rules;

        $validator = $this->getValidationFactory()->make($request->all(), $rules);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    /**
     * Create the response for when a request fails validation.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $errors
     * @return \Illuminate\Http\Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if ($request->ajax()) {
            return new JsonResponse($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->input())
            ->with('danger', 'The information you entered was not valid.')
            ->withErrors($errors);
    }

    public function up($id)
    {
        $this->student->moveHigher($id);

        return redirect()->back()
            ->withSuccess('Item moved!');
    }

    public function down($id)
    {
        $this->student->moveLower($id);

        return redirect()->back()
            ->withSuccess('Item moved!');
    }
}
