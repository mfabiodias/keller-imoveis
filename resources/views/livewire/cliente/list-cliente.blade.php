<div class="pt-5">
    <table class="table table-sm table-striped table-bordered table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tel 1</th>
                <th>Tel 2</th>
                <th>Cel</th>
                <th>Nacionalidade</th>
                <th>Ocupação</th>
                <th>Documento</th>
                <th>Pai</th>
                <th>Mae</th>
                <th>Investidor</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($collection as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->tel_residencial }}</td>
                <td>{{ $item->tel_comercial }}</td>
                <td>{{ $item->cel." (".$item->cel_operadora.")" }}</td>
                <td>{{ $item->nacionalidade }}</td>
                <td>{{ $item->ocupacao }}</td>
                <td>{{ $item->doc_tipo." - ".$item->doc_numero."" }}</td>
                <td>{{ $item->nome_pai }}</td>
                <td>{{ $item->nome_mae }}</td>
                <td>{{ !$item->investidor ? "Não" : "Sim" }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
    {{$collection->links()}}
    </div>
</div>