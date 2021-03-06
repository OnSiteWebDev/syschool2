@extends('layout/app')

@section('content')

@if(Session::has('excluir'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Atenção!</h4>

    <form action="{{ url('contratos/' . Session::get('contrato_id')) }}" method="POST">
        <div class="row">
            <div class="form-group col-md-10">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <label>
                    {{ Session::get('excluir') }}
                </label>
            </div>

            <div class="form-group col-md-2">
                <a href='{{ url('contratos') }}' class="btn btn-info">
                    <i class="fa fa-close"></i> Não
                </a>
                &nbsp;
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Sim
                </button>
            </div>
        </div>
    </form>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
    {{Session::get('success')}}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Ops! Algo não está certo.</h4>
    {{Session::get('error')}}
</div>
@endif


@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Alerta:</h4>
    {{ $error }}
</div>
@endforeach
@endif

<div class='row'>
    <div class='col-md-12'>
        <!-- Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Contratos</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($contratos) > 0)
                <table id="tabela_cadastro" class="table  table-striped" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Versão Atual</th>
                            <th>Criação</th>
                            <th>Emissão</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Versão Atual</th>
                            <th>Criação</th>
                            <th>Emissão</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($contratos as $contrato)
                        <tr>
                            <td>
                                {{ $contrato->id }}
                            </td>
                            <td>
                                <a href="usuarios/{{ $contrato->usuario_id }}" title="{{ $contrato->usuario->nome }} perfil ">{{ $contrato->usuario->nome }}</a>
                            </td>
                            <td>{{ $contrato->versao }}</td>
                            <td>{{ $contrato->criacao }}</td>
                            <td>{{ $contrato->emissao }}</td>
                            <td>
                                <a href="{{ url('contratos/' . $contrato->id) }}" title="Ver" ><i class="fa fa-eye"></i></a>
                                &nbsp;&nbsp;
                                <a href="{{ url('contratos/versoes/' . $contrato->id) }}" title="Versões" ><i class="fa fa-sort-numeric-asc"></i></a>
                                &nbsp;&nbsp;
                                <a href="{{ url('contratos/imprimir/' . $contrato->id) }}" title="Emitir" ><i class="fa fa-print"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h5>
                    Nenhum contrato cadastrado.
                </h5>
                @endif
            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('contratos/create') }}" class="btn btn-success pull-right">Novo contrato</a>
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
