<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'SystemPaulista') }} - @yield('title')</title>

    @include('layout.inc.head')

</head>

<body>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
    </div>
</div>

@include('layout.sidebar')
@include('layout.topbar')

<main class="main-container">

    @include('layout.inc.modal.change-password')

    @yield('page_modals')

    <div class="modal fade show " id="modal-show-stock">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">


                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Estoque de Produtos</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-content">

                        <div class="form-group col-md-12">
                            {!! Html::decode(Form::label('product_stock', 'Produto *', array('class' => 'col-form-label'))) !!}


                            <select class="form-control select2_single" name="product_stock" id="product_stock" required>
                            </select>

                        </div>

                        <div class="form-group col-md-12">
                            <dl class="row">
                                <dt class="col-sm-3">ID - Descrição: </dt>
                                <dd class="col-sm-9">-</dd>

                                <dt class="col-sm-3">Valor: </dt>
                                <dd class="col-sm-9">-</dd>

                                <dt class="col-sm-3">Estoque: </dt>
                                <dd class="col-sm-9">-</dd>

                            </dl>

                        </div>

                    </div>

                    @include('layout.inc.loading')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Fechar</button>
                </div>


            </div>
        </div>
    </div>

    @if($Page->has_menu)

        <header class="header bg-ui-general">

            <div class="header-info">
                <h1 class="header-title">
                    <strong>@yield('page_header-title')</strong>
                    <small>@yield('page_header-subtitle')</small>
                    @if($Page->create_option)
                        <button onclick="window.location.href='{{route($Page->entity.'.create')}}'" class="btn btn-outline btn-purple">
                            {{trans('pages.view.CREATE', [ 'name' => $Page->name ])}}
                        </button>
                    @endif
                    @if(isset($Page->import_option) && $Page->import_option)
                        <button onclick="window.location.href='{{route($Page->entity.'.import')}}'" class="btn btn-outline btn-brown">
                            {{trans('pages.view.IMPORT', [ 'name' => $Page->names ])}}
                        </button>
                    @endif
                </h1>
            </div>

            <div class="header-action">
                <nav class="nav">
                    @yield('page_header-nav')
                </nav>
            </div>

            <div class="header-action">
                <nav class="nav">
                    @yield('page_header-nav2')
                </nav>
            </div>
        </header><!--/.header -->

    @endif

    @yield('page_content')

    @include('layout.inc.footer')

</main>

<!-- Global quickview -->
<div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
    <div class="spinner-linear">
        <div class="line"></div>
    </div>
</div>
<!-- END Global quickview -->

@include('layout.inc.foot')

<script>


    //SELEÇÃO DOS PRODUTOS
    $(document).ready(function(){
        var remoteDataProducts = {
            tags: true,
            width: 'resolve',
            ajax: {
                url: "{{route('ajax.requests.products.get-select2')}}",
                type: 'GET',
                dataType: 'json',
                delay: 250,

                data: function (params) {
                    return {
                        value   : params.term, // search term
                        text   : true, // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 3,
            language: "pt-BR"
//                templateResult: formatState
        };

        $("select[name=product_stock]").select2(remoteDataProducts);


        $("select#product_stock").on("select2:select", function() {
            var $parent = $(this).parents('div.modal-body');
            // var $selected = $(this).find(":selected");
            var $selected=$(this).select2('data')[0];
            var $fields = $($parent).find('dd.col-sm-9');

            if ($selected.id != '') {

                $($fields[0]).html($selected.id + ' - ' + $selected.text);
                $($fields[1]).html($selected.price_formatted);
                $($fields[2]).html($selected.stock);

            } else {
                $($fields[0]).html('-');
                $($fields[1]).html('-');
                $($fields[2]).html('-');
            }
        });


    });

</script>
</body>
</html>
