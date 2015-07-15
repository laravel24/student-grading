@extends('admin.layouts.sb-wrapper')

@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $title ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 index-actions">
                            <a class="btn btn-primary pull-right" href="<?= route('admin.class-days.create') ?>">Create ClassDay <i class="fa fa-plus fa-lg"></i></a>
                        </div>
                    </div>

                    <table id="data-table" class="table table-striped table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th data-sort="date">Date</th>
                                <th data-sort="type">Type</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classDays as $classDay)
                            <tr>
                                <td>
                                    <?= $classDay->position ?>
                                    <a href="<?= URL::route('admin.class-days.up', $classDay) ?>">
                                        <i class="fa fa-lg fa-sort-up"></i>
                                    </a>
                                    <a href="<?= URL::route('admin.class-days.down', $classDay) ?>">
                                        <i class="fa fa-lg fa-sort-down"></i>
                                    </a>
                                </td>
                                
                                <td><?= $classDay->date ?></td>
                                <td><?= $classDay->type ?></td>
                                
                                <td><a href="<?= URL::route('admin.class-days.edit', $classDay) ?>"><i class="fa fa-edit fa-lg"></i></a></td>
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
