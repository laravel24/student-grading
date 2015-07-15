@extends('admin.layouts.sb-wrapper')

@section('page')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $title ?></div>
                <div class="panel-body">
                    <form class="form" action="<?= $route ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?= csrf_token() ?>"/>
                        @if ($method)
                            <input type="hidden" name="_method" value="<?= $method ?>"/>
                        @endif

                        <fieldset>
                            <div class="form-group<?= $errors->first('first_name', ' has-error') ?>">

                                <label for="first_name" class="control-label">First Name</label>

                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?= old('first_name', $student->first_name) ?>">

                                <span class="help-block"><?= $errors->first('first_name') ?></span>

                            </div>
                            
                            <div class="form-group<?= $errors->first('last_name', ' has-error') ?>">

                                <label for="last_name" class="control-label">Last Name</label>

                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= old('last_name', $student->last_name) ?>">

                                <span class="help-block"><?= $errors->first('last_name') ?></span>

                            </div>
                            
                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="actions pull-right">
                                        <a class="btn btn-default" href="<?= URL::route('admin.students.index') ?>">Back</a>
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
