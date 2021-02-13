<table class="table table-sm table-borderless">
    <tbody>
        <tr>
            <td class="align-middle" ><strong>Nome: </strong>{{ $cliente['nome'] }}</td>
            <td class="align-middle" ><strong>Email: </strong>{{ $cliente['email'] }}</td>
            <td class="align-middle" >
                <strong>Tel. Residencial: </strong>{{ $cliente['tel_residencial'] }} <br />
                <strong>Tel. Comercial: </strong>{{ $cliente['tel_comercial'] }} <br />
                <strong>Celular: </strong>{{ $cliente['cel'] }} ({{ $cliente['cel_operadora'] }}) <br />
                @if (!!$cliente['nextel_id'])
                    <strong>Nextel ID: </strong>{{ $cliente['celular'] }} {{ $cliente['nextel_id'] }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>Endereço do Cliente: </strong>
                @if (!!$endereco['rua'])    
                    {{ $endereco['rua'] }}, {{ $endereco['numero'] }}, 
                    @if (!!$endereco['complemento'])
                        {{ $endereco['complemento'] }},
                    @endif
                    {{ $endereco['bairro'] }}, {{ $endereco['cidade'] }}/{{ $endereco['estado'] }}
                @endif
            </td>
        </tr>
        @if (!!$this->clienteImovel) 
        @foreach ($this->clienteImovel as $idx => $clienteImovel)
        <tr>
            <td colspan="3">
                <hr />
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>{{$clienteImovel->nome}}</strong> 
                ({{$clienteImovel->tipo->nome}}/{{$clienteImovel->subtipo->nome}}) - 
                <strong>Permuta: </strong>{{$clienteImovel->permuta == "sim" ? "Sim" : "Não"}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>Endereço Imóvel: </strong>
                @if (!!$clienteImovel->endereco['rua'])    
                    {{ $clienteImovel->endereco['rua'] }}, {{ $clienteImovel->endereco['numero'] }}, 
                    @if (!!$clienteImovel->endereco['complemento'])
                        {{ $clienteImovel->endereco['complemento'] }},
                    @endif
                    {{ $clienteImovel->endereco['bairro'] }}, {{ $clienteImovel->endereco['cidade'] }}/{{ $clienteImovel->endereco['estado'] }}
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Valor Venda: </strong>R$ {{number_format($clienteImovel->valor_venda, 2, ",", ".")}}</td>
            <td><strong>Valor Aluguel: </strong>R$ {{number_format($clienteImovel->valor_aluguel, 2, ",", ".")}}</td>
            <td><strong>Condomínio: </strong>R$ {{number_format($clienteImovel->condominio, 2, ",", ".")}}</td>
        </tr>
        <tr>
            <td><strong>IPTU: </strong>R$ {{number_format($clienteImovel->iptu, 2, ",", ".")}}</td>
            <td><strong>Área Total: </strong>{{number_format($clienteImovel->area_total, 2, ",", ".")}} m²</td>
            <td><strong>Área Útil: </strong>{{number_format($clienteImovel->area_util, 2, ",", ".")}} m²</td>
        </tr>
        <tr>
            <td><strong>Quarto(s): </strong>{{$clienteImovel->quarto}}</td>
            <td><strong>Suíte(s): </strong>{{$clienteImovel->suite}}</td>
            <td><strong>Banheiro(s): </strong>{{$clienteImovel->banheiro}}</td>
        </tr>
        <tr>
            <td><strong>Vaga(s): </strong>{{$clienteImovel->vagas}}</td>
            <td><strong>Andar: </strong>{{$clienteImovel->andar}}</td>
            <td><strong>Posição: </strong>{{ucwords($clienteImovel->posicao)}}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Chaves: </strong>{{ucwords($clienteImovel->chaves)}}</td>
        </tr>
        @endforeach 
        @endif
    </tbody>
</table>