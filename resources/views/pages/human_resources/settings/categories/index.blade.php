@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-subtitle',  $Page->subtitle)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity])

@endsection

@section('page_content')

    <div class="main-content">

<!--
|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
| Zero configuration
|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
!-->
        <div class="card">
            <h4 class="card-title"><strong>{{count($Page->response)}}</strong> {{$Page->names}}</h4>

            <div class="card-content">
                <div class="card-body">

                    <table class="table table-striped table-bordered table-responsive-sm" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cadastrado</th> 
                            <th>Descrição</th>    
                            <th>Ações</th>                
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Cadastrado</th> 
                            <th>Descrição</th>
                            <th>Ações</th>           
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($Page->response as $sel)
                            <tr>
                                <td>{{$sel['id']}}</td>
                                <td data-order="{{$sel['created_at_time']}}">{{$sel['created_at']}}</td>
                                <td>{{$sel['name']}}</td>        
                                <td>
                                    
                                    <div class="row align-items-center">

                                        <div class="col-md-3">

                                            @include('layout.inc.buttons.edit')
                                            
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                            @include('layout.inc.buttons.delete')
                                        </div>
                                    
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layout.inc.loading')
        </div>
    </div><!--/.main-content -->

@endsection

@section('script_content')
    <!-- Sample data to populate jsGrid demo tables -->
    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

@endsection
