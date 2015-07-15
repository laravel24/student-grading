<?php  namespace App\Http\Controllers\Admin;

use App\Gateways\DbRoleGateway;
use App\Gateways\DbClassDayGateway;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassDaysController extends AdminController
{
    use ValidatesRequests;

    protected $viewNamespace = 'admin.class-days';

    protected $defaultTitle = 'ClassDays';

    protected $classDay;

    protected $request;

    protected $rules = [
    ];

    protected $storeRules = [
    ];

    public function __construct(DbClassDayGateway $classDay, Request $request)
    {
        $this->classDay = $classDay;
        $this->request = $request;
    }

    public function index()
    {
        $classDays = $this->classDay->all();

        return $this->render('index', compact('classDays'));
    }

    public function create()
    {
        $classDay = $this->classDay->newInstance();
        $classDay->date = Carbon::now()->format('Y-m-d');

        return $this->classDayForm('create', $classDay, 'New ClassDay');
    }

    public function store()
    {
        $this->validate($this->request, $this->storeRules);

        $classDay = $this->classDay->create($this->request->all());

        return redirect()->route('admin.class-days.index')
            ->with('success', 'ClassDay updated successfully.');
    }

    public function edit($id)
    {
        $classDay = $this->classDay->find($id);

        return $this->classDayForm('edit', $classDay);
    }

    public function profile()
    {
        return $this->classDayForm('edit', $this->guard->classDay());
    }

    public function classDayForm($action, $classDay, $title = null)
    {
        $title = $title ?: 'Editing ClassDay - ' . $classDay->id;

        switch ($action) {
            case 'create':
                $method = null;
                $route = route('admin.class-days.store');
                break;
            case 'edit':
                $method = 'put';
                $route = route('admin.class-days.update', $classDay);
        }

        return $this->render('form', compact('classDay', 'method', 'route'), $title);
    }

    public function update($id)
    {
        $this->validate($this->request);

        $classDay = $this->classDay->update($id, $this->request->all());

        if ($classDay) {
            return redirect()->route('admin.class-days.index')
                ->with('success', 'ClassDay updated successfully.');
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
        $this->classDay->moveHigher($id);

        return redirect()->back()
            ->withSuccess('Item moved!');
    }

    public function down($id)
    {
        $this->classDay->moveLower($id);

        return redirect()->back()
            ->withSuccess('Item moved!');
    }
}
