@extends('layouts.app')
@section('title', '記録の新規作成')
@section('content')
    <div class="text-center">
        <h1>記録の新規作成</h1>
    </div>

    <div class="row mt-3">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => ['records.store']]) !!}
                <div class="form-group">
                    {!! Form::label('customer_id', '顧客') !!}
                    {!! Form::select('customer_id', $customers, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', $record->title ? $record->title : old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('start', '開始日にち') !!}
                    {!! Form::date('start', $record->start ? $record->start : old('start'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end', '終了日にち') !!}
                    {!! Form::date('end', $record->end ? $record->end : old('end'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('start_time', '開始時間') !!}
                    {!! Form::time('start_time', $record->start_time ? $record->start_time : old('start_time'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end_time', '終了時間') !!}
                    {!! Form::time('end_time', $record->end_time ? $record->end_time : old('end_time'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('color', '色') !!}
                    {!! Form::color('color', $record->color ? $record->color : old('color'), []) !!}
                </div>

                {!! Form::submit('新規記録作成', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection