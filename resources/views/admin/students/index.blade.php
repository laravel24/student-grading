@extends('admin.layouts.sb-wrapper')

@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 index-actions">
                            <a class="btn btn-primary pull-right" href="<?= route('admin.students.create') ?>">Create Student <i class="fa fa-plus fa-lg"></i></a>
                        </div>
                    </div>

                    <table id="data-table" class="table table-striped table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th data-sort="first_name">First Name</th>
                                <th data-sort="last_name">Last Name</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <?= $student->position ?>
                                    <a href="<?= URL::route('admin.students.up', $student) ?>">
                                        <i class="fa fa-lg fa-sort-up"></i>
                                    </a>
                                    <a href="<?= URL::route('admin.students.down', $student) ?>">
                                        <i class="fa fa-lg fa-sort-down"></i>
                                    </a>
                                </td>
                                
                                <td><?= $student->first_name ?></td>
                                <td><?= $student->last_name ?></td>
                                
                                <td><a href="<?= URL::route('admin.students.edit', $student) ?>"><i class="fa fa-edit fa-lg"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin._partials.data-table')
