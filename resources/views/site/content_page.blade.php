<section>

    <div class="inner_wrapper">
        <div class="container">
            <h2>{{ $title }}</h2>
            <div class="inner_section">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">{!! Html::image('assets/img/'.$page->images, '', ['class'=>'img-circle delay-03s animated wow zoomIn']) !!}
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
                            {!! $page->text !!}
                        </div>
                    </div>
                </div>
                {!! link_to(route('home'), 'Back') !!}
            </div>
        </div>
    </div>

</section>