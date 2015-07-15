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
                            <div class="form-group<?= $errors->first('date', ' has-error') ?>">

                                <label for="date" class="control-label">Date</label>

                                <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?= old('date', $classDay->date) ?>">

                                <span class="help-block"><?= $errors->first('date') ?></span>

                            </div>

                            <div class="form-group<?= $errors->first('type', ' has-error') ?>">

                                <label for="type" class="control-label">Type</label>

                                <select class="form-control" name="type" id="type" placeholder="Type">
                                    <option value="Class" <?= old('type', $classDay->type) == 'Class' ? 'selected' : null ?>>Class</option>
                                    <option value="Huddle" <?= old('type', $classDay->type) == 'Huddle' ? 'selected' : null ?>>Huddle</option>
                                </select>

                                <span class="help-block"><?= $errors->first('type') ?></span>

                            </div>


                            <div class="row">
                                <div class="col-md-10">
                                    <div class="actions pull-right">
                                        <a class="btn btn-default" href="<?= URL::route('admin.class-days.index') ?>">Back</a>
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
