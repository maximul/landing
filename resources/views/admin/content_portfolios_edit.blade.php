<div class="wrapper container-fluid">

    {!! Form::open([
                        'url' => route('portfolioEdit', ['portfolio' => $data['id']]),
                        'class' => 'form-horizontal',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data'
                    ]) !!}

    <div class="form-group">

        {!! Form::hidden('id', $data['id']) !!}
        {!! Form::label('name', 'Название:', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::text('name', $data['name'], ['class' => 'form-control', 'placeholder' => 'Введите название портфолио']) !!}
        </div>

    </div>

    <div class="form-group">

        {!! Form::label('filter', 'Фильтр:', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::text('filter', $data['filter'], ['class' => 'form-control', 'placeholder' => 'Введите название фильтра']) !!}
        </div>

    </div>

    <div class="form-group">

        {!! Form::label('old_images', 'Изображение:', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-offset-2 col-xs-10">
            {!! Html::image('assets/img/'.$data['images'], '', ['class' => 'img-circle delay-03s animated wow zoomIn', 'width' => 200]) !!}
            {!! Form::hidden('old_images', $data['images']) !!}
        </div>

    </div>

    <div class="form-group">

        {!! Form::label('images', 'Изображение:', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::file('images', [
                'class' => 'filestyle',
                'data-buttonText' => 'Выберите изображение',
                'data-buttonName' => "btn-primary",
                'data-placeholder' => "Файла нет"
            ]) !!}
        </div>

    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        </div>

    </div>

    {!! Form::close() !!}

    <script>
        CKEDITOR.replace('editor')
    </script>

</div>